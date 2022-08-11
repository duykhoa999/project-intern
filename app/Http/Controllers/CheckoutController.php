<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        $cart = Session::get('cart')[$user->email ?? []];

        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        $all_product = DB::table('dong_ruou')->orderby('ma_dr', 'desc')->get();
        return view('user.checkout.index')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('user', $user)->with('cart', $cart);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'shipping_email' => 'required|email',
                'shipping_address' => 'required',
                'shipping_name' => 'required',
                'shipping_phone' => 'required|min:10|max:10'
            ],
            [
                'shipping_email.required' => 'Vui lòng nhập email',
                'shipping_email.email' => 'Không đúng định dạng email',
                'shipping_address.required' => 'Vui lòng nhập địa chỉ',
                'shipping_name.required' => 'Vui lòng nhập tên người nhận',
                'shipping_phone.required' => 'Vui lòng nhập số điện thoại',
                'shipping_phone.max' => 'Số điện thoại gồm 10 số',
                'shipping_phone.min' => 'Số điện thoại gồm 10 số',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $user = Session::get('user');
        $data = array();
        // $data['shipping_email'] = $request->shipping_email;
        $data['ho_ten_nn'] = $request->shipping_name;
        $data['sdt_nn'] = $request->shipping_phone;
        $data['dia_chi_nn'] = $request->shipping_address;
        $data['ghi_chu'] = $request->shipping_note;
        $data['trang_thai'] = 0;
        $data['ngay_dat'] = Carbon::now();
        // $data['id_users'] = $user_shiping;
        $data['ma_kh'] = $user->ma_kh;
        Session::put('total', $request->tong_tien);

        $shipping_id = DB::table('phieu_dat')->insertGetId($data);
        Session::put('id_shipping', $shipping_id);
        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $data['id_shipping'] = Session::get('id_shipping');
        $user = Session::get('user');
        $cart = Session::get('cart')[$user->email] ?? [];

        $id_shipping = DB::table('phieu_dat')->where('id_pd', $data['id_shipping'])->first();
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        return view('user.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product)->with('shipping', $id_shipping)->with('cart', $cart);
    }

    public function place_order(Request $request)
    {
        //        insert payment

        //insert order
        $id_pd = Session::get('id_shipping');
        $data = $request->all();
        $total = Session::get('total') ?? 0;
        $user = Session::get('user');
        $cart = Session::get('cart')[$user->email] ?? [];

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);

        $order = Order::where(['id_pd' => $id_pd])->first();
        $order->kich_hoat = config('define.active.active');
        $order->hinh_thuc_thanh_toan = (isset($request->payment_option) && $request->payment_option == 1) ? 0 : 1;
        $order->save();

        $bill = new Bill();
        $bill->ma_hd = $checkout_code;
        $bill->ngay = Carbon::now();
        $bill->tong_tien = $total ?? 0;
        $bill->id_pd =$order->id_pd ?? 0;
        $bill->save();

        //insert order_details
        if ($cart == true) {
            foreach ($cart as $key => $cart) {
                $product = Product::where('ma_dr', $cart['id_products'])->first();
                if($product->sl_ton < $cart['product_qty'])
                {
                    Session::put('message', 'Vui lòng chọn số lượng ít hơn'.$product->sl_ton);
                    return redirect()->route('checkout.payment');
                }
                $order_detail = new OrderDetail();
                $order_detail->id_pd = $id_pd;
                $order_detail->ma_dr = $cart['id_products'];
                $order_detail->so_luong = $cart['product_qty'];
                $order_detail->gia = $cart['product_price'];
                if($order_detail->save())
                {
                    $product->sl_ton = $product->sl_ton - $cart['product_qty'];
                    $product->save();
                }
            }
        }
        if(isset($data['data']['orderID']))
        {
            $status = true;
            Session::forget(['cart','id_shipping','total']);
            Session::put('success', 'Đặt hàng thành công, cám ơn quý khách đã tin tưởng!');
            return response()->json(['status'=>$status]);
        }
        else
        {
            if ($request->payment_option == 0) {
                Session::put('message', 'Vui Lòng chọn phương thức thanh toán');
                return redirect()->route('checkout.payment');
            } else {
                Session::forget(['cart','id_shipping','total']);
                $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
                $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
                return view('user.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
            }
        }

    }
}
