<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends AppController
{
    public function __construct(UserService $userService, CustomerService $customerService)
    {
        parent::__construct();

        $this->userService = $userService;
        $this->customerService = $customerService;
    }

    public function getLogin(Request $req)
    {
        $guard = session()->get('guard');
        
        if (Auth::guard($guard)->check()) {
            return redirect()->route('home');
        }

        $req->session()->put('url_login', url()->previous());
        return view('login.index');
    }

    public function postLogin(LoginRequest $req)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $credentials = array('email' => $req->email, 'password' => $req->password);

        if (!Auth::guard('customer')->attempt($credentials) && !Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('getLogin')->with('message', "Sai tài khoản hoặc mật khẩu! Vui lòng thử lại!");
            // return view('login.index', ['message' => 'Fail!']);//config('message.login.fail')
        }
        session()->put('guard', $this->getGuard($credentials['email']));
        return redirect()->route('home');
    }

    public function getLogout()
    {
        $guard = session()->get('guard');
        Auth::guard($guard)->logout();
        session()->forget('user');
        return redirect()->route('home');
    }

    private function getGuard($email = null)
    {
        if (Auth::guard('admin')->check()) {
            $user = $this->userService->getBymail($email);
            session()->put('user', $user);
            return "admin";
        } else if (Auth::guard('customer')->check()) {
            $user = $this->customerService->getBymail($email);
            session()->put('user', $user);
            return "customer";
        }
    }

    public function getRegister()
    {
        $guard = session()->get('guard');
        
        if (Auth::guard($guard)->check()) {
            return redirect()->route('home');
        }

        return view('login.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $data = $request->all();

        $data['ma_q'] = 'KH';
        $min = 002;
        $max = 999;
        $data['ma_kh'] =  'kh_'.mt_rand($min,$max);
        $data['password'] =  Hash::make($data['password']);

        try {
            Customer::create($data)->save();
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('getRegister')->with('error', 'Đăng kí không thành công! Vui lòng thử lại!');
        }

        return redirect()->route('getRegister')->with('success', 'Đăng kí thành công! Bạn có thể đăng nhập và mua hàng ngay bây giờ!');
    }
}
