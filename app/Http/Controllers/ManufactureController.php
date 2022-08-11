<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Services\ManufactureService;
use Illuminate\Support\Facades\DB;

session_start();

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class ManufactureController extends AppController
{
    protected $manufactureService;
    public function __construct(ManufactureService $manufactureService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.manufacture'));
        $this->manufactureService = $manufactureService;
    }
    // add sản phẩm
    public function create()
    {
        return view('admin.manufacture.create');
    }

    // liet ke sản phẩm
    public function index(Request $req)
    {
        $key_search = $req->input('key_search');
        $all_manufacture = $this->manufactureService->getDataIndex($key_search);
        if ($key_search) {
            $all_manufacture->withPath(route('admin.manufacture.index') . '?key_search=' . $key_search);
        }
        return view('admin.manufacture.index', compact('all_manufacture', 'key_search'));
    }
    // lưu  sản phẩm
    public function store(Request $request)
    {

        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ma_ncc' => ['required',new Unique('nha_cc', 'ma_ncc')],
                'ten_ncc' => 'required',
                'dia_chi' => 'required',
                'email' => ['required',new Unique('nha_cc', 'email'), 'email'],
            ],
            [
                'ma_ncc.required' => 'Vui lòng nhập thông tin',
                'ma_ncc.unique' => 'Mã Nhà cung cấp bị trùng! Vui lòng thử lại!',
                'ten_ncc.required' => 'Vui lòng nhập thông tin',
                'dia_chi.required' => 'Vui lòng nhập thông tin',
                'email.required' => 'Vui lòng nhập thông tin',
                'email.unique' => 'Email bị trùng! Vui lòng thử lại!',
                'email.email' => 'Không đúng định dạng email! Vui lòng thử lại!',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $manufacture = $this->manufactureService->create($data);
            if (!$manufacture) {
                $this->pushMessage('message', config('message.product.add.save_fail'));
                return $this->validator->validated();
            }
            return redirect()->route('admin.manufacture.create')->with('message', "Thêm nhà cung cấp $manufacture->ten_ncc thành công");
        }
    }

    public function show($id)
    {
        $data['edit_manufacture'] = DB::table('nha_cc')->where('ma_ncc', $id)->first();
        if ($data['edit_manufacture'] !== null) {
            return view('admin.manufacture.show', $data);
        }
        return redirect()->route('admin.manufacture.index')->with('error', 'Không tìm thấy nhà cung cấp này');
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ten_ncc' => 'required',
                'dia_chi' => 'required',
                'email' => 'required',
            ],
            [
                'ten_ncc.required' => 'Vui lòng nhập thông tin',
                'dia_chi.required' => 'Vui lòng nhập thông tin',
                'email.required' => 'Vui lòng nhập thông tin',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $data_update['ten_ncc'] = $request->ten_ncc;
            $data_update['dia_chi'] = $request->dia_chi;
            $data_update['email'] = $request->email;
            DB::table('nha_cc')->where('ma_ncc', $request->ma_ncc)->update($data_update);
            return redirect()->route('admin.manufacture.show', ['id' => $data['ma_ncc']])->with('message', "Cập nhật nhà cung cấp $request->ten_ncc thành công");
        }
    }
    // xóa  nhà cung cấp
    public function delete($id)
    {
        $manufacture = Manufacture::find($id);
        if ($manufacture !== null) {
            $manufacture->delete();
            return redirect()->route('admin.manufacture.index')->with('message', "Xóa nhà cung cấp $manufacture->ten_ncc thành công");
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy nhà cung cấp này');
    }

}
