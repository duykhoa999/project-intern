<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyOrderRequest;
use App\Models\CompanyOrder;
use App\Models\CompanyOrderDetail;
use App\Models\COrder;
use App\Models\Manufacture;
use App\Models\Product;
use App\Services\CompanyOrderService;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CompanyOrderController extends AppController
{
    protected $companyOrderService;
    protected $productService;

    public function __construct(CompanyOrderService $companyOrderService, ProductService $productService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.company_order'));
        $this->companyOrderService = $companyOrderService;
        $this->productService = $productService;
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
    public function show(Request $request,$id = null)
    {//Session::forget('company_order');
        $company_order = CompanyOrder::find($id);

        $query = CompanyOrderDetail::where('ma_ddh',$id)->with(['company_order','products'])->orderby('ma_ddh', 'desc');

        $company_order_detail = $query->get();

        $session_order = Session::get('company_order');
        $key_search='';

        $key_search = $request->input('key_search');
        $all_product = $this->productService->getDataIndex($key_search);
        if ($key_search) {
            $all_product->withPath(route('admin.company_order.show', ['id' => $id]) . '?key_search=' . $key_search);
        }

        return view('admin.company_order.show',compact('all_product', 'session_order', 'company_order', 'company_order_detail'));
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

    public function add_detail($id = null)
    {
        $company_order = Session::get('company_order');

        if (!empty($company_order)) {
            foreach($company_order as $k => $item) {
                $data_detail = [
                    'ma_ddh' => $id,
                    'ma_dr' => $k,
                    'so_luong' => $item['so_luong'] ?? 0,
                    'gia' => $item['gia'] ?? 0,
                ];
                $query = CompanyOrderDetail::where('ma_ddh', '=', $id)->where('ma_dr', '=', $k);
                if (empty($query->first())) {
                    CompanyOrderDetail::create($data_detail)->save();
                }
                else {
                    $query->update($data_detail);
                }
            }
        }

        Session::forget('company_order');

        return redirect()->route('admin.company_order.show', ['id' => $id])->with('message_add', 'Thêm chi tiết đơn đặt hàng thành công!');
    }

    public function saveSession(Request $request)
    {
        $data = Session::get('company_order');
        if (empty($data)) {
            $data = [];
        }
        $data[$request->ma_dr] = [
            'so_luong' => $request->so_luong,
            'gia' => $request->gia
        ];

        Session::put('company_order', $data);
        
        return response()->json(['session successfully saved']);
    }
}
