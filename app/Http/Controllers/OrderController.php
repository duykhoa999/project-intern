<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\CouponDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

    public function show($orderId = null)
    {
        $ho_ten_nv = '';
        $order_by_id = OrderDetail::where('id_pd',$orderId)->with(['order','products','bills'])->orderby('id_pd', 'desc')->get();

        if(isset($order_by_id['0']['order']['0']->ma_nv))
        {
            $employee = DB::table('nhan_vien')->where('ma_nv',$order_by_id['0']['order']['0']->ma_nv)->first();
            $ho_ten_nv = $employee->ho_ten;
        }
        $all_user = DB::table('khach_hang')->get();

        return view('admin.order.show')->with('order_by_id', $order_by_id)->with('all_user', $all_user)->with('ho_ten_nv', $ho_ten_nv);
    }

    public function update_order_status(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['id_pd']);
        if($order->trang_thai == 4)
        {
            Session::put('message', 'Đơn hàng đã được khách hàng hủy, không thể xác nhận đơn');
            return redirect()->route('admin.order.index');
        }
        $order->trang_thai = $data['order_status'];
        $order->save();
    }

    // khách hàng Hủy Đơn hàng
    public function huy_don_hang(Request $Request)
    {
        $data = $Request->all();
        $order = Order::where('id_pd', $data['order_id'])->first();
        if($order->trang_thai !=0)
        {
            Session::put('message', 'Đơn hàng đã được nhân viên xác nhận, không thể hủy đơn');
            return redirect()->route('customer.index');
        }
        $order_details = OrderDetail::where('id_pd', $data['order_id'])->get();

        foreach ($order_details as $key => $details) {
            $product_details = Product::where('ma_dr', $details->ma_dr)->first();
            $coupon = CouponDetail::where('ma_dr', $details->ma_dr)->first();

            $new_quantity =  $product_details->sl_ton + $details->so_luong;
            $product_details->sl_ton = $new_quantity;
            if (!empty($coupon)) {
                $coupon->so_luong++;

                $coupon->save();
            }
            $product_details->save();
        }
        $order->trang_thai = 4;

        $order->save();
    }
}
