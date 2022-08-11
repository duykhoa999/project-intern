<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Unique;
use PDOException;

class CategoryController extends AppController
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.category'));
        $this->categoryService = $categoryService;
    }

    // them thuong hieu
    public function create()
    {
        return view('admin.category.create');
    }
    // liet ke danh muc san pham
    public function index(Request $req)
    {
        $key_search = $req->input('key_search');
        $all_category = $this->categoryService->getDataIndex($key_search);
        if ($key_search) {
            $all_category->withPath(route('admin.category.index') . '?key_search=' . $key_search);
        }
        return view('admin.category.index', compact('all_category', 'key_search'));
    }
    // thêm  thương hiệu
    public function store(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ma_lr' => ['required',new Unique('loai_ruou', 'ma_lr')],
                'ten_lr' => 'required',
                'slug' => ['required',new Unique('loai_ruou', 'slug')]
            ],
            [
                'ma_lr.required' => 'Vui lòng nhập thông tin',
                'ma_lr.unique' => 'Mã bị trùng! Vui lòng nhập lại!',
                'ten_lr.required' => 'Vui lòng nhập thông tin',
                'slug.required' => 'Vui lòng nhập thông tin'
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $category = $this->categoryService->create($data);
            if (!$category) {
                $this->pushMessage('message', config('message.category.add.save_fail'));
                return $this->validator->validated();
            }
            return redirect()->route('admin.category.create')->with('message', "Thêm loại rượu $category->ten_lr thành công");
        }
    }
    // sửa  thương hiệu
    public function show($id = null)
    {
        $edit_category = DB::table('loai_ruou')->where('ma_lr', $id)->first();
        return view('admin.category.show', compact('edit_category'));
    }
    //update
    public function update(Request $request, $id = null)
    {
        $data = $request->all();
        $valid = Validator::make(
            $data,
            [
                'ten_lr' => 'required',
                'slug' => 'required',
            ],
            [
                'ten_lr.required' => 'Vui lòng nhập thông tin',
                'slug.required' => 'Vui lòng nhập thông tin',
            ]
        );
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $category = Category::where(['ma_lr' => $id])->first();
            $category = $this->categoryService->update($category, $data);
            if (!$category) {
                $this->pushMessage('message', config('message.category.edit.save_fail'));
                return $this->validator->validated();
            }
            return redirect()->route('admin.category.show', ['id' => $id])->with('message', "Cập nhật loại rượu $category->ten_lr thành công");
        }
    }
    // xóa  loại rượu
    public function delete($id = null)
    {
        $category = Category::find($id);
        if ($category !== null) {
            try {
                $category->delete();
            } catch (PDOException $e) {
                return redirect()->route('admin.category.index')->with('error', "Loại rượu đã được chọn cho sản phẩm! Không thể xoá!");
            }
            return redirect()->route('admin.category.index')->with('message', "Xóa loại rượu $category->ten_lr thành công");
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy loại rượu này');
    }
}
