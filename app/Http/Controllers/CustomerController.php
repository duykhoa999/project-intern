<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CustomerController extends AppController
{
    protected $customerService;
    public function __construct(CustomerService $customerService) 
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.customer'));
        $this->customerService = $customerService;

        $category = DB::table('loai_ruou')->orderby('ma_lr', 'desc')->get();
        $brand_pro = DB::table('thuong_hieu')->orderby('ma_th', 'ASC')->get();

        View::share('category', $category);
        View::share('brand_pro', $brand_pro);
    }

    public function index(Request $req)
    {
        $key_search = $req->input('key_search');
        $all_customer = $this->customerService->getDataIndex($key_search);
        if ($key_search) {
            $all_customer->withPath(route('admin.customer.index') . '?key_search=' . $key_search);
        }
        return view('admin.customer.index', compact('all_customer', 'key_search'));
    }

    public function show()
    {
        $user = Session::get('user');

        $history_order = Order::with(['order_details','bills'])->orderby('id_pd', 'desc')->paginate(5);
        $user = Customer::find($user->ma_kh);
        
        return view('user.profile.index')->with('user', $user)->with('history_order', $history_order);
    }

    public function view_order_user($orderId = null)
    {
        
        $order_by_id = OrderDetail::where('id_pd',$orderId)->with(['order','products','bills'])->orderby('id_pd', 'desc')->get();
        $user = Session::get('user');

        return view('user.profile.view_order_user')->with('order_by_id', $order_by_id)->with('user', $user);
    }

    public function update_customer(Request $request)
    {
        $data = $request->all();
        $customer = Customer::find(Session::get('user')->ma_kh);
        $customer->sdt = $request->phone;
        $customer->ho_ten = $request->name;
        $customer->dia_chi = $request->address;
        $customer->save();
        Session::put('user', $customer);
        return redirect()->route('customer.index');
    }
}
