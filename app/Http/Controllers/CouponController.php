<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponDetail;
use App\Services\CouponService;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CouponController extends AppController
{
    protected $couponService;
    protected $productService;

    public function __construct(CouponService $couponService, ProductService $productService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.coupon'));
        $this->couponService = $couponService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString('Y/m/d');
        $key_search = $req->input('key_search');

        $coupon = $this->couponService->getDataIndex($key_search);
        if ($key_search) {
            $coupon->withPath(route('admin.coupon.index') . '?key_search=' . $key_search);
        }
        return view('admin.coupon.index', compact('coupon', 'key_search', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        $coupon = Coupon::find($id);

        $query = CouponDetail::where('ma_km',$id)->with(['coupons','products']);

        $coupon_detail = $query->get();

        $session_coupon = Session::get('coupon');
        $key_search='';

        $key_search = $request->input('key_search');
        $all_product = $this->productService->getDataIndex($key_search);
        if ($key_search) {
            $all_product->withPath(route('admin.coupon.show', ['id' => $id]) . '?key_search=' . $key_search);
        }

        return view('admin.coupon.show',compact('all_product', 'session_coupon', 'coupon', 'coupon_detail', 'key_search'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function add_detail($id = null)
    {
        $coupon = Session::get('coupon');

        if (!empty($coupon)) {
            foreach($coupon as $k => $item) {
                $data_detail = [
                    'ma_km' => $id,
                    'ma_dr' => $k,
                    'so_luong' => $item['so_luong'] ?? 0,
                    'phantram_km' => $item['phantram_km'] ?? 0,
                ];
                $query = CouponDetail::where('ma_km', '=', $id)->where('ma_dr', '=', $k);
                if (empty($query->first())) {
                    CouponDetail::create($data_detail)->save();
                }
                else {
                    $query->update($data_detail);
                }
            }
        }

        Session::forget('coupon');

        return redirect()->route('admin.coupon.show', ['id' => $id])->with('message_add', 'Thêm chi tiết khuyến mãi thành công!');
    }

    public function saveSession(Request $request)
    {
        $data = Session::get('coupon');
        if (empty($data)) {
            $data = [];
        }
        $data[$request->ma_dr] = [
            'so_luong' => $request->so_luong,
            'phantram_km' => $request->phantram_km,
        ];

        Session::put('coupon', $data);
        
        return response()->json(['session successfully saved']);
    }
}
