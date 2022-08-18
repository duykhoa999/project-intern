<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyOrderRequest;
use App\Models\CompanyOrder;
use App\Models\COrder;
use App\Models\Manufacture;
use App\Services\CompanyOrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CompanyOrderController extends AppController
{
    protected $companyOrderService;

    public function __construct(CompanyOrderService $companyOrderService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.company_order'));
        $this->companyOrderService = $companyOrderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        // $arr_filter = $this->getArrayFilter();
        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        // $key_search = $req->input('key_search');
        $all_order = CompanyOrder::paginate(config('define.paginate.company_order_index'));
        // $key_search='';
        // if($key_search && !$arr_filter)
        // {
        //     $all_order->withPath(route('admin.order.index').'?key_search='.$key_search);
        // }
        // $employee =DB::table('nhan_vien')->get();
        // if($arr_filter && !$key_search) $all_order->withPath(route('admin.order.index').'?trang_thai_dh='.$arr_filter['trang_thai_dh']);
        // if($arr_filter && $key_search) $all_order->withPath(route('admin.order.index').'?trang_thai_dh='.$arr_filter.'&key_search='.$key_search);

        return view('admin.company_order.index')->with('all_order', $all_order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufactures = Manufacture::all();

        return view('admin.company_order.create', compact('manufactures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyOrderRequest $request)
    {
        $user = Session::get('user');

        $data = $request->all();

        $data['ngay_dat'] = Carbon::now();
        $data['ma_nv'] = $user->ma_nv;

        if (!$this->companyOrderService->create($data)) {
            return redirect()->back()->with('error', 'Không thể lập đơn đặt hàng! Vui lòng kiểm tra lại!');
        }

        return redirect()->back()->with('success', 'Lập đơn đặt hàng thành công!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\COrder  $cOrder
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\COrder  $cOrder
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\COrder  $cOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\COrder  $cOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function add_detail(Request $request)
    {
        $data = $request->all();

        if (!empty($data)) {
            foreach($data as $k => $item) {
                
            }
        }
    }
}
