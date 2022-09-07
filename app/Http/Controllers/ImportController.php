<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Models\CompanyOrder;
use App\Models\CompanyOrderDetail;
use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Product;
use App\Services\ImportService;
use App\Services\ProductService;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ImportController extends AppController
{
    protected $importService;
    protected $productService;

    public function __construct(ImportService $importService, ProductService $productService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.import'));
        $this->importService = $importService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_imports = Import::paginate(config('define.paginate.import_index'));

        return view('admin.import.index')->with('all_imports', $all_imports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = CompanyOrder::all();

        return view('admin.import.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportRequest $request)
    {
        $user = Session::get('user');

        $data = $request->all();

        $data['ngay_tao_pn'] = Carbon::now();
        $data['ma_nv'] = $user->ma_nv;

        if (!$this->importService->create($data)) {
            return redirect()->back()->with('error', 'Không thể lập phiếu nhập! Vui lòng kiểm tra lại!');
        }

        return redirect()->back()->with('message', 'Lập phiếu nhập thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        $import = Import::find($id);

        $query = ImportDetail::where('ma_pn',$id)->orderby('ma_pn', 'desc');

        $import_detail = $query->get();

        $session_import = Session::get('import');
        $key_search='';

        $company_order = CompanyOrder::where('ma_ddh',$import->ma_ddh)->first();

        $list_product = [];
        foreach($company_order->order_details as $item) {
            $list_product[] = $item->ma_dr;
        }

        $all_product = [];

        $key_search = $request->input('key_search');
        if (!empty($list_product))
            $all_product = $this->productService->getDataIndex($key_search, $list_product);

        if ($key_search) {
            $all_product->withPath(route('admin.import.show', ['id' => $id]) . '?key_search=' . $key_search);
        }

        return view('admin.import.show',compact('all_product', 'session_import', 'import', 'import_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function edit(Import $import)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Import $import)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function destroy(Import $import)
    {
        //
    }

    public function add_detail($id = null)
    {
        $import_session = Session::get('import');
        $error = '';
        
        $import = Import::find($id);
        if (!empty($import_session)) {
            foreach($import_session as $k => $item) {
                $data_detail = [
                    'ma_pn' => $id,
                    'ma_dr' => $k,
                    'so_luong' => $item['so_luong'] ?? 0,
                    'gia' => $item['gia'] ?? 0,
                ];
                $query = ImportDetail::where('ma_pn', '=', $id)->where('ma_dr', '=', $k);
                $detail = $query->first();

                $order_detail = CompanyOrderDetail::where('ma_ddh', '=', $import->ma_ddh)->where('ma_dr', '=', $k)->first();

                if ($order_detail->so_luong >= $data_detail['so_luong']) {    
                    if (empty($detail)) {
                        $product = Product::find($data_detail['ma_dr']);
                        $product->sl_ton += $data_detail['so_luong'];
                        $product->save();

                        ImportDetail::create($data_detail)->save();
                    }
                    else {
                        $product = Product::find($data_detail['ma_dr']);

                        if ($detail->so_luong > $data_detail['so_luong']) {
                            $product->sl_ton -= ($detail->so_luong - $data_detail['so_luong']);
                        }
                        else if ($detail->so_luong < $data_detail['so_luong']) {
                            $product->sl_ton += ($data_detail['so_luong'] - $detail->so_luong);
                        }

                        $product->save();
                        $query->update($data_detail);
                    }
                    $message = 'Thêm chi tiết phiếu nhập thành công!';
                }
                else {
                    $product = Product::find($k);
                    $error .= '<div class="alert alert-danger">Vui lòng nhập vào số lượng cho sản phẩm ' . $product->ten_dr . ' nhỏ hơn hoặc bằng ' . $order_detail->so_luong . '!</div>';
                }
            }
        }

        Session::forget('import');

        return redirect()->route('admin.import.show', ['id' => $id])->with('message_add', $message ?? '')->with('error_add', $error ?? '');
    }

    public function saveSession(Request $request)
    {
        $data = Session::get('import');
        if (empty($data)) {
            $data = [];
        }
        $gia = (double)preg_replace('/[^0-9.-]+/', "", $request->gia);
        $data[$request->ma_dr] = [
            'so_luong' => $request->so_luong,
            'gia' => $gia
        ];

        Session::put('import', $data);
        
        return response()->json(['session successfully saved']);
    }
}
