<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class OrderController extends AppController
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.order'));
        $this->orderService = $orderService;
    }

    public function index(Request $req)
    {
        $arr_filter = $this->getArrayFilter();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $key_search = $req->input('key_search');
        $all_order = $this->orderService->getDataIndex($key_search,$arr_filter);
        $key_search='';
        if($key_search && !$arr_filter)
        {
            $all_order->withPath(route('admin.order.index').'?key_search='.$key_search);
        }
        $employee =DB::table('nhan_vien')->get();
        if($arr_filter && !$key_search) $all_order->withPath(route('admin.order.index').'?trang_thai_dh='.$arr_filter['trang_thai_dh']);
        if($arr_filter && $key_search) $all_order->withPath(route('admin.order.index').'?trang_thai_dh='.$arr_filter.'&key_search='.$key_search);

        return view('admin.order.index')->with('all_order', $all_order)->with('key_search', $key_search)->with('arr_filter', $arr_filter)->with('employee', $employee);
    }
    function getArrayFilter()
    {
        $arr = array();

        if (isset($_GET['trang_thai_dh']) && is_numeric($_GET['trang_thai_dh'])) {
            $arr['trang_thai_dh'] = trim($_GET['trang_thai_dh']);
            return $arr;
        }
        return null;
    }

    public function set_employee_order(Request $request)
    {
        $status = true;
        $data = $request->all();

        $order = Order::find($data['order_id']);
        $order->trang_thai = 2;
        $order->ma_nv =$data['ma_nv'];
        $order->save();

        $bill = Bill::find($data['ma_hd']);
        $bill->ma_nv =$data['ma_nv'];
        $bill->save();

        $message ="Phân công nhân viên thành công!";
        return response()->json(['message'=>$message,'status'=>$status]);
    }
}
