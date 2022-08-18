<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ho_ten' => 'required',
            'sdt' => 'required',
            'dia_chi' => 'required',
            'ngay_sinh' => 'required',
            'email' => 'required|email|unique:khach_hang,email',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'ho_ten.required' => 'Vui lòng nhập họ và tên!',
            'sdt.required' => 'Vui lòng nhập số điện thoại!',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ!',
            'ngay_sinh.required' => 'Vui lòng chọn ngày tháng năm sinh!',
            'email.required' => 'Vui lòng nhập email!',
            'email.unique' => 'Email đã trùng. Vui lòng chọn email khác!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp!',
        ];
    }
}