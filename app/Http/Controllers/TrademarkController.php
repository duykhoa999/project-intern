<?php

namespace App\Http\Controllers;

use App\Models\Trademark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Services\TrademarkService;
use Illuminate\Support\Facades\DB;

session_start();

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use PDOException;

class TrademarkController extends AppController
{
    protected $trademarkService;
    public function __construct(TrademarkService $trademarkService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.trademark'));
        $this->trademarkService = $trademarkService;
    }

    // them thuong hieu
    public function create()
    {
        return view('admin.trademark.create');
    }
    // liet ke danh muc thuong hieu
    public function index(Request $req)
    {
        $key_search = $req->input('key_search');
        $all_trademark = $this->trademarkService->getDataIndex($key_search);
        if ($key_search) {
            $all_trademark->withPath(route('admin.trademark.index') . '?key_search=' . $key_search);
        }
        return view('admin.trademark.index', compact('all_trademark', 'key_search'));
    }
    // thêm  thương hiệu
    public function store(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ma_th' => ['required',new Unique('thuong_hieu', 'ma_th')],
                'ten_th' => 'required',
                'slug' => ['required',new Unique('thuong_hieu', 'slug')],
                'mo_ta' => 'required',
                'hinh_anh' => 'required',

            ],
            [
                'ma_th.required' => 'Vui lòng nhập thông tin',
                'ma_th.unique' => 'Mã bị trùng! Vui lòng nhập lại!',
                'ten_th.required' => 'Vui lòng nhập thông tin',
                'slug.required' => 'Vui lòng nhập thông tin',
                'slug.unique' => 'Slug bị trùng! Vui lòng kiểm tra lại!',
                'mo_ta.required' => 'Vui lòng nhập thông tin',
                'hinh_anh.required' => 'Vui lòng chọn 1 hình ảnh!',

            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $get_image = $request->file('hinh_anh');
            if (isset($get_image)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                // $data['product_image'] = $get_image;
                $data['hinh_anh'] = $new_image;
            }
            $trademark = $this->trademarkService->create($data);
            if (!$trademark) {
                $this->pushMessage('message', config('message.product.add.save_fail'));
                return $this->validator->validated();
            }
            $get_image->move('uploads/type/', $new_image);
            return redirect()->route('admin.trademark.create')->with('message', "Thêm thương hiệu $trademark->ten_th thành công");
        }

    }
    // sửa  thương hiệu
    public function show($id = null)
    {
        $edit_trademark = DB::table('thuong_hieu')->where('ma_th', $id)->first();
        return view('admin.trademark.show', compact('edit_trademark'));
    }
    //update
    public function update(Request $request, $id = null)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ten_th' => 'required',
                'slug' => 'required',
                'mo_ta' => 'required',
            ],
            [
                'ten_th.required' => 'Vui lòng nhập thông tin',
                'slug.required' => 'Vui lòng nhập thông tin',
                'mo_ta.required' => 'Vui lòng nhập thông tin',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $trademark = Trademark::where(['ma_th' => $id])->first();
            $old_image = $trademark->hinh_anh;
            $get_image = $request->file('hinh_anh');
            $data['hinh_anh'] = $trademark->hinh_anh;
            if (isset($get_image)) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/type/', $new_image);
                // $data['product_image'] = $get_image;
                $data['hinh_anh'] = $new_image;
            }
            $trademark = $this->trademarkService->update($trademark, $data);
            if (!$trademark) {
                $this->pushMessage('message', config('message.trademark.edit.save_fail'));
                return $this->validator->validated();
            }
            if (isset($get_image)) {
                if (file_exists(public_path('uploads/type/' . $old_image)))
                {
                    unlink(public_path('uploads/type/' . $old_image));
                }
            }
            return redirect()->route('admin.trademark.show', ['id' => $id])->with('message', "Cập nhật thương hiệu $trademark->ten_th thành công");
        }
    }
    // xóa  thương hiệu
    public function delete($id = null)
    {
        $trademark = Trademark::find($id);
        if ($trademark !== null) {
            try {
                $trademark->delete();
            } catch (PDOException $e) {
                return redirect()->route('admin.trademark.index')->with('error', "Thương hiệu đã được chọn cho sản phẩm! Không thể xoá!");
            }
            if (file_exists(public_path('uploads/type/' . $trademark->hinh_anh))) {
                unlink(public_path('uploads/type/' . $trademark->hinh_anh));
            }
            return redirect()->route('admin.trademark.index')->with('message', "Xóa thương hiệu $trademark->ten_th thành công");
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy thương hiệu này');
    }
}
