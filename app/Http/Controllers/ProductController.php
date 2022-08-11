<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Products;
use App\Services\ProductService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Unique;

class ProductController extends AppController
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.product'));
        $this->productService = $productService;
    }
    // public function send_comment(Request $request)
    // {

    //     $product_id = $request->product_id;
    //     $comment_name = $request->comment_name;
    //     $comment_content = $request->comment_content;
    //     $comment = new Comment();
    //     $comment->comment = $comment_content;
    //     $comment->comment_name = $comment_name;
    //     $comment->id_products = $product_id;
    //     // $comment->comment_status = 1;
    //     // $comment->comment_parent_comment = 0;
    //     $comment->save();
    // }
    // // load bình luận
    // public function load_comment(Request $request)
    // {
    //     $product_id = $request->product_id;
    //     $comment = Comment::where('id_products', $product_id)->get();
    //     $output = '';
    //     foreach ($comment as $key => $comm) {
    //         $output .= '
    //         <div class="row style_comment flex">
    //             <div class="col-md-2" style="margin: 0.5rem 0;">

    //                 <img src="' . url('/frontend/img/usercomment.png') . '" class="img img-responsive img-thumbnail" alt="">
    //             </div>
    //             <div class="col-md-8 comment-cart">
    //                 <p class="name-user"> <i class="fas fa-user"></i>: ' . $comm->comment_name . ' </p>
    //                 <p class="date"><i class="far fa-clock"></i>: ' . $comm->comment_date . '</p>
    //                 <p class="comment"> <b>Bình luận :</b>
    //                 ' . $comm->comment . '
    //                 </p>

    //             </div>
    //         </div>
    //         ';
    //     }
    //     echo $output;
    // }
    // add sản phẩm
    public function create()
    {
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        $manufacture_product = DB::table('nha_cc')->orderby('ma_ncc', 'ASC')->get();
        return view('admin.product.create',compact('cate_product','brand_product','manufacture_product'));
    }
    // liet ke sản phẩm
    public function index(Request $req)
    {
        $arr_filter = $this->getArrayFilter();
        $key_search='';
        $arr = array();
        if(isset($arr_filter['lr'])) $arr['lr'] = $arr_filter['lr'];
        if(isset($arr_filter['th'])) $arr['th'] = $arr_filter['th'];
        if(isset($arr_filter['ncc'])) $arr['ncc'] = $arr_filter['ncc'];
        if(isset($arr_filter['sp_moi'])) $arr['sp_moi'] = $arr_filter['sp_moi'];
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        $manufacture_product = DB::table('nha_cc')->orderby('ma_ncc', 'ASC')->get();
        $key_search = $req->input('key_search');
        $all_product = $this->productService->getDataIndex($key_search,$arr);
        if ($key_search && empty($arr)) {
            $all_product->withPath(route('admin.product.index') . '?key_search=' . $key_search);
        }
        
        return view('admin.product.index', compact('all_product', 'key_search','cate_product','brand_product','manufacture_product','arr'));
    }
    function getArrayFilter()
    {
        $arr = array();

        if (isset($_GET['loc_lr']) && !empty($_GET['loc_lr'])) {
            $arr['lr'] = $_GET['loc_lr'];
        }
        if (isset($_GET['loc_th']) && !empty($_GET['loc_th'])) {
            $arr['th'] = $_GET['loc_th'];
        }
        if (isset($_GET['loc_nhacc']) && !empty($_GET['loc_nhacc'])) {
            $arr['ncc'] = $_GET['loc_nhacc'];
        }
        if (isset($_GET['loc_sp_moi']) && !empty($_GET['loc_sp_moi'])) {
            $arr['sp_moi'] = $_GET['loc_sp_moi'];
        }
        return $arr;
    }
    // lưu  sản phẩm
    public function store(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ma_dr' => ['required',new Unique('dong_ruou', 'ma_dr')],
                'ten_dr' => 'required',
                'sl_ton' => 'required',
                'slug' => 'required',
                'gia' => 'required',
                'mo_ta' => 'required',
                'noi_dung' => 'required',
                'hinh_anh' => 'required',
            ],
            [
                'ma_dr.required' => 'Vui lòng nhập thông tin',
                'ma_dr.unique' => 'Mã bị trùng! Vui lòng nhập lại!',
                'ten_dr.required' => 'Vui lòng nhập thông tin',
                'sl_ton.required' => 'Vui lòng nhập thông tin',
                'slug.required' => 'Vui lòng nhập thông tin',
                'gia.required' => 'Vui lòng nhập thông tin',
                'mo_ta.required' => 'Vui lòng nhập thông tin',
                'noi_dung.required' => 'Vui lòng nhập thông tin',
                'hinh_anh.required' => 'Vui lòng nhập thông tin',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $get_image = $request->file('hinh_anh');
            if (isset($get_image)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                // $data['product_image'] = $get_image;
                $data['hinh_anh'] = $new_image;
            }
            $product = $this->productService->create($data);
            if (!$product) {
                $this->pushMessage('message', config('message.product.add.save_fail'));
                return $this->validator->validated();
            }
            $get_image->move('uploads/product/', $new_image);
            return redirect()->route('admin.product.create')->with('message', "Thêm sản phẩm $product->ten_dr thành công");
        }
    }
    // sửa  sản phẩm
    public function show($id = null)
    {
        $cate_product = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_product = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        $manufacture_product = DB::table('nha_cc')->orderby('ma_ncc', 'ASC')->get();
        $product =  Product::where('ma_dr',$id)->with(['thuong_hieu','loai_ruou','nha_cc'])->orderby('ma_dr', 'ASC')->first();//'cart_details',
        return view('admin.product.show', compact('product','cate_product','brand_product','manufacture_product'));
    }
    //update
    public function update(Request $request, $id = null)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ma_dr' =>'required',
                'ten_dr' => 'required',
                'sl_ton' => 'required',
                'slug' => 'required',
                'gia' => 'required',
                'mo_ta' => 'required',
                'noi_dung' => 'required',
            ],
            [
                'ma_dr.required' => 'Vui lòng nhập thông tin',
                'ten_dr.required' => 'Vui lòng nhập thông tin',
                'sl_ton.required' => 'Vui lòng nhập thông tin',
                'slug.required' => 'Vui lòng nhập thông tin',
                'gia.required' => 'Vui lòng nhập thông tin',
                'mo_ta.required' => 'Vui lòng nhập thông tin',
                'noi_dung.required' => 'Vui lòng nhập thông tin',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $product = Product::where(['ma_dr' => $id])->first();
            $old_image = $product->hinh_anh;
            $get_image = $request->file('hinh_anh');
            $data['hinh_anh'] = $product->hinh_anh;
            if (isset($get_image)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/product/', $new_image);
                // $data['product_image'] = $get_image;
                $data['hinh_anh'] = $new_image;
            }
            $product = $this->productService->update($product, $data);
            if (!$product) {
                $this->pushMessage('message', config('message.product.edit.save_fail'));
                return $this->validator->validated();
            }
            if (isset($get_image)) {
                if (file_exists(public_path('uploads/product/' . $old_image)))
                {
                    unlink(public_path('uploads/product/' . $old_image));
                }
            }
            return redirect()->route('admin.product.show', ['id' => $id])->with('message', "Cập nhật sản phẩm $product->ten_dr thành công");
        }
        $data['ten_dr'] = $request->ten_dr;
        $data['sl_ton'] = $request->sl_ton;
        $data['slug'] = $request->slug;
        $data['gia'] = $request->gia;
        $data['mo_ta'] = $request->mo_ta;
        $data['noi_dung_dr'] = $request->noi_dung;
        $data['ma_lr'] = $request->ma_lr;
        $data['ma_th'] = $request->ma_th;
        $data['ma_ncc'] = $request->ma_ncc;
        $get_image = $request->file('hinh_anh');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product/', $new_image);
            // $data['product_image'] = $get_image;
            $data['hinh_anh'] = $new_image;
            DB::table('dong_ruou')->where('ma_dr', $request->ma_dr)->update($data);
            Session::put('message', 'Cập Nhập Sản Phẩm Thành Công');
            return Redirect::to('all-product');
        }
        // $data['product_image'] = ;
        DB::table('dong_ruou')->where('ma_dr', $request->ma_dr)->update($data);
        Session::put('message', 'Cập Nhập Sản Phẩm Thành Công');
        return Redirect::to('all-product');
    }
    // xóa  sản phẩm
    public function delete($id = null)
    {
        $product = Product::find($id);
        if ($product !== null) {
            if (file_exists(public_path('uploads/product/' . $product->hinh_anh))) {
                unlink(public_path('uploads/product/' . $product->hinh_anh));
            }
            $product->delete();
            return redirect()->route('admin.product.index')->with('message', "Xóa sản phẩm $product->ten_dr thành công");
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy sản phẩm này');
    }
    public function trending($ma_dr)
    {
        $product = Product::find($ma_dr);
        $data = array();
        if ($product !== null && $product->check_sp_moi == 0) {
            $data['check_sp_moi'] = 1;
            DB::table('dong_ruou')->where('ma_dr',$ma_dr)->update($data);
            Session::put('message','Set sản phẩm lên sản phẩm mới thành công!');
            return Redirect::to('all-product');
        }
        if ($product !== null && $product->check_sp_moi == 1) {
            $data['check_sp_moi'] = 0;
            DB::table('dong_ruou')->where('ma_dr',$ma_dr)->update($data);
            Session::put('message','Hủy set sản phẩm lên sản phẩm mới thành công!');
            return Redirect::to('all-product');
        }

    }
    // END ADmin Page
    // chi tiết sản phẩm home page
    public function details_product($id = null)
    {
        $category = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_pro = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();
        // $comment_product = DB::table('comment')->where('id_Product', $product_id)->orderby('id_comment', 'desc')->get();

        $product = Product::where('ma_dr',$id)->with(['loai_ruou','thuong_hieu'])->orderby('ma_dr', 'desc')->first();//,'coupon_details'

        return view('user.show_detail_product', compact('category', 'brand_pro', 'product'));
    }
}
