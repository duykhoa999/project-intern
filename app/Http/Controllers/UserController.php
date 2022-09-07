<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Slider;

use App\Models\Products;
use App\Models\OrderDetails;
use Carbon\Carbon;
use App\CatePost;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Cart_details;
use App\Models\Carts;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Unique;
use PDOException;

class UserController extends AppController
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        parent::__construct();
        View::share('controller', config('define.controller.admin.user'));
        $this->userService = $userService;
    }

    public function index(Request $req)
    {
        $key_search = $req->input('key_search');
        $all_user = $this->userService->getDataIndex($key_search);
        if ($key_search) {
            $all_user->withPath(route('admin.user.index') . '?key_search=' . $key_search);
        }

        return view('admin.user.index', compact('all_user'));
    }

    // them user
    public function create()
    {
        return view('admin.user.create');
    }
    
    // thêm  user
    public function store(UserRequest $request)
    {
        $data = $request->all();
        
        $user = $this->userService->create($data);
        if (!$user) {
            $this->pushMessage('message', 'Thêm nhân viên không thành công! Vui lòng kiểm tra lại!');
            return $this->validator->validated();
        }
        return redirect()->route('admin.user.create')->with('message', "Thêm nhân viên $user->ho_ten thành công");
    }
    // sửa nhân viên
    public function show($id = null)
    {
        $user = DB::table('nhan_vien')->where('ma_nv', $id)->first();
        return view('admin.user.show', compact('user'));
    }
    //update
    public function update(UserUpdateRequest $request, $id = null)
    {
        $data = $request->all();
       
        $user = User::where(['ma_nv' => $id])->first();
        $user = $this->userService->update($user, $data);
        if (!$user) {
            $this->pushMessage('message', config('Chỉnh sửa thông tin nhân viên thất bại! Vui lòng thử lại sau'));
            return $this->validator->validated();
        }
        return redirect()->route('admin.user.show', ['id' => $id])->with('message', "Cập nhật thông tin nhân viên $user->ho_ten thành công");
    }
    // xóa  nhân viên
    public function delete($id = null)
    {
        $user = User::find($id);
        if ($user !== null) {
            try {
                $user->delete();
            } catch (PDOException $e) {
                return redirect()->route('admin.user.index')->with('error', "Nhân viên đã lập phiếu hoặc được phân công giao hàng! Không thể xoá!");
            }
            return redirect()->route('admin.user.index')->with('message', "Xóa nhân viên $user->ho_ten thành công");
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy nhân viên này');
    }
}
