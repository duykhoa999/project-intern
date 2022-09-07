<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Slider;
use App\Product;
use Carbon\Carbon;
use App\CatePost;
use App\Models\Product as ModelsProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use Cart;
use Illuminate\Support\Facades\DB;

session_start();

use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    // gio hang
    public function gio_hang()
    {
        $user = session()->get('user');
        $cart = Session::get('cart')[$user->email] ?? [];
        
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        return view('user.cart.cart_ajax')->with('category', $cate_product)->with('brand', $brand_product)->with('cart', $cart)->with('user', $user);
    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        $user = Session::get('user');
        if ($cart !== null && !empty($cart[$user->email])) {
            $is_avaiable = 0;
            foreach ($cart[$user->email] as $key => $val) {
                if ($val['id_products'] == $data['cart_product_id']) {
                    $is_avaiable++;
                    $cart[$user->email][$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'id_products' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_quantity' => $data['cart_product_quantity'],
                        'product_qty' => $val['product_qty'] + $data['cart_product_qty'],
                        'product_price' => $data['cart_product_price'],
                    );
                    if ($cart[$user->email][$key]['product_quantity'] >= $cart[$user->email][$key]['product_qty']) {
                        Session::put('cart', $cart);
                    } else {
                        alert('Làm ơn đặt nhỏ hơn hoặc bằng ' + $cart[$user->email][$key]['product_quantity']);
                    }
                }
            }
            if ($is_avaiable == 0) {
                $cart[$user->email][] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'id_products' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[$user->email][] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'id_products' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
        }
        Session::put('cart', $cart);
        
        Session::save();
    }
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hiden;
        $quantity = $request->qty;
        $product_info = DB::table('products')->where('id_products', $productId)->first();
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id'] = $product_info->id_products;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }

    //show cart
    public function show_cart()
    {
        $cart = Session::get('cart');
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)->with('cart', $cart);
    }
    // xóa sản phẩm
    public function del_cart($session_id = null)
    {
        $user = Session::get('user');
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart[$user->email] as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$user->email][$key]);
                    break;
                }
            }
            Session::put('cart', $cart);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    // update sản phâm giỏ hàng
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        $user = Session::get('user');
        if ($cart == true) {
            $message = '';

            foreach ($data['cart_qty'] as $key => $qty) {
                $i = 0;
                foreach ($cart[$user->email] as $session => $val) {
                    $i++;
                    $product = $this->getProduct($cart[$user->email][$session]['id_products']);
                    if ($product) {
                        if ($val['session_id'] == $key && $qty <= $product->sl_ton) {

                            $cart[$user->email][$session]['product_qty'] = $qty;
                            $message .= '<div class="alert alert-success">Cập nhật số lượng sản phẩm: ' . $cart[$user->email][$session]['product_name'] . ' thành công.</div>';
                        } elseif ($val['session_id'] == $key && $qty >= $product->sl_ton) {
                            $message .= '<div class="alert alert-danger">Cập nhật số lượng sản phẩm: ' . $cart[$user->email][$session]['product_name'] . ' thất bại. Số lượng tồn không đủ.</br>Vui lòng nhập số lượng nhỏ hơn hoặc bằng ' . $product->sl_ton . '!</div>';
                        }
                    }
                }
            }

            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back();
        }
    }

    private function getProduct($productId = null) {
        $product = ModelsProduct::find($productId);
        if (!$product)
            return false;
        return $product;
    }
}
