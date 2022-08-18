<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends AppController
{
    public function __construct()
	{
		parent::__construct();
        $category = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_pro = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();

        View::share('category', $category);
        View::share('brand_pro', $brand_pro);
	}

    public function index() 
    {
        $products_new = Product::where('check_sp_moi','1')->with(['loai_ruou','thuong_hieu'])->orderby('ma_dr', 'desc')->limit(12)->get();//,'coupon_details'

        // $all_product_highlights = DB::table('v_sp_noibat')->get();
        // $sale = DB::table('khuyen_mai')->get();

        return view('user.home', compact('products_new'));
    }

    public function show_brand($brand_id = null)
    {
        $show_brand_id = Product::where('ma_th',$brand_id)->with(['loai_ruou','thuong_hieu'])->orderby('ma_dr', 'desc')->get();//,'coupon_details'
        $brand_name = DB::table('thuong_hieu')->where('ma_th', $brand_id)->first();
        return view('user.show_brand', compact('brand_name', 'show_brand_id'));
    }

    public function show_category($category_id = null)
    {
        $category_by_id = Product::where('ma_lr',$category_id)->with(['loai_ruou','thuong_hieu'])->orderby('ma_dr', 'desc')->get();//,'coupon_details'
        $category_name = DB::table('loai_ruou')->where('ma_lr', $category_id)->first();
        return view('user.show_category', compact('category_name', 'category_by_id'));
    }

    // tìm kiếm trang chủ
    public function search_product(request $request)
    {
        $keywords = $request->ten_san_pham;
        $keywords = preg_replace('/\s\s+/', ' ', $keywords);
       
        $search_product = DB::table('dong_ruou')->where('ten_dr', 'like', '%' . $keywords . '%')->orderby('dong_ruou.ma_dr', 'desc')->simplePaginate(config('define.paginate.product_view'));
        return view('user.search.search_product')->with('search_product', $search_product);
    }
}
