<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends AppController
{
    public function __construct()
	{
        View::share('controller', config('define.controller.admin.dashboard'));
		parent::__construct();
	}

    public function index() {
        $total_product = DB::table('dong_ruou')->sum('sL_ton');
        
        $order1 = DB::table('phieu_dat')->where('trang_thai', '0')->count();
        $order2 = DB::table('phieu_dat')->where('trang_thai', 1)->count();
        $order3 = DB::table('phieu_dat')->where('trang_thai', 2)->count();
        $order4 = DB::table('phieu_dat')->where('trang_thai', 3)->count();
        $order5 = DB::table('phieu_dat')->where('trang_thai', 4)->count();

        return view('admin.index')->with(compact('order1', 'order2', 'order3', 'order4', 'order5', 'total_product'));
    }

    public function filter_by_date(Request $request)
    {

        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = DB::table('phieu_dat')
                    ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
                    ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
                    ->whereBetween('ngay_dat', [$from_date, $to_date])->where('phieu_dat.trang_thai', 3)
                    ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))
                    ->groupBy('order_date')
                    ->orderBy('order_date','ASC')->get();
        // $get = Carts::whereBetween('ngay_dat', [$from_date, $to_date])->where('trang_thai', 3)
        //     ->select(\DB::raw('sum(order_total) as order_total'), \DB::raw('DATE(ngay_dat) as ngay_dat'))->groupBy('ngay_dat')->get()->toArray();

        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->order_date,
                'sales' => $val->order_total,
                'quantity' =>$val->quantity,
                'order' => $val->total,
            );
        }
        if(!empty($chart_data))
        {
            echo $data = json_encode($chart_data);
        }
        else{
            $chart_data[] = array(

                'period' => '',
                'order' => 0,
                'sales' => 0,
                'quantity' => 0
            );
            echo $data = json_encode($chart_data);
        }
    }

    public function days_order()
    {

        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $get = DB::table('phieu_dat')
            ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
            ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
            ->whereBetween('ngay_dat', [$sub30days, $now])->where('trang_thai', 3)
            ->select(DB::raw('sum(tong_tien) as order_total'),
                     DB::raw('DATE(ngay_dat) as order_date'),
                     DB::raw('sum(so_luong) as quantity'),
                     DB::raw('count(ma_hd) as total'))
            ->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();


        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->order_date,
                'sales' => $val->order_total,
                'quantity' =>$val->quantity,
                'order' => $val->total,
            );
        }
        if(!empty($chart_data))
        {
            echo $data = json_encode($chart_data);
        }
        else{
            $chart_data[] = array(

                'period' => '',
                'order' => 0,
                'sales' => 0,
                'quantity' => 0
            );
            echo $data = json_encode($chart_data);
        }
    }

    public function dashboard_filter(Request $request)
    {

        $data = $request->all();

        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        // $tomorrow = Carbon::now('Asia/Ho_Chi_Minh')->addDay()->format('d-m-Y H:i:s');
        // $lastWeek = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->format('d-m-Y H:i:s');
        // $sub15days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(15)->format('d-m-Y H:i:s');
        // $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('d-m-Y H:i:s');

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();



        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub90days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();


        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
           $get = DB::table('phieu_dat')
                ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
                ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
                ->whereBetween('ngay_dat', [$sub7days, $now])->where('trang_thai', 3)
                ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get =DB::table('phieu_dat')
                ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
                ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
                ->whereBetween('ngay_dat', [$dau_thangtruoc, $cuoi_thangtruoc])->where('trang_thai', 3)
                ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get =DB::table('phieu_dat')
            ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
            ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
            ->whereBetween('ngay_dat', [$dauthangnay, $now])->where('trang_thai', 3)
            ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();
        } elseif ($data['dashboard_value'] == 'homnay') {
            $get =DB::table('phieu_dat')
            ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
            ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
            ->whereBetween('ngay_dat', [$now, $now])->where('trang_thai', 3)
            ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();
        }
        elseif ($data['dashboard_value'] == 'quy') {
            $get =DB::table('phieu_dat')
            ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
            ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
            ->whereBetween('ngay_dat', [$sub90days, $now])->where('trang_thai', 3)
            ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();
        } else {
            $get = DB::table('phieu_dat')
            ->join('hoa_don', 'phieu_dat.id_pd', '=', 'hoa_don.id_pd')
            ->join('chi_tiet_pd', 'phieu_dat.id_pd', '=', 'chi_tiet_pd.id_pd')
            ->whereBetween('ngay_dat', [$sub365days, $now])->where('trang_thai', 3)
            ->select(DB::raw('sum(tong_tien) as order_total'), DB::raw('DATE(ngay_dat) as order_date'),DB::raw('sum(so_luong) as quantity'),DB::raw('count(ma_hd) as total'))->groupBy('order_date')->orderBy('order_date','ASC')->get()->toArray();
        }


        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'sales' => $val->order_total,
                'quantity' =>$val->quantity,
                'order' => $val->total,
            );
        }
        if(!empty($chart_data))
        {
            echo $data = json_encode($chart_data);
        }
        else{
            $chart_data[] = array(

                'period' => '',
                'order' => 0,
                'sales' => 0,
                'quantity' => 0
            );
            echo $data = json_encode($chart_data);
        }
    }
}
