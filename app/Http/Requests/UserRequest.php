<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ma_nv' => [
                'required',
                Rule::unique('nhan_vien')->where('ma_nv', '!=', $this->ma_nv),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('nhan_vien')->where('email', '!=', $this->email),
            ],
            'sdt' => [
                'required',
                Rule::unique('nhan_vien')->where('sdt', '!=', $this->sdt),
            ],
            'ngay_sinh' => [
                'required',
            ],
            'dia_chi' => [
                'required',
            ],
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'ma_nv.required' => 'Vui lòng nhập mã nhân viên!',
            'ma_nv.unique' => 'Mã này đã trùng! Vui lòng nhập lại!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Vui lòng nhập đúng định dạng email!',
            'email.unique' => 'Email này đã trùng! Vui lòng nhập lại!',
            'sdt.required' => 'Vui lòng nhập số điện thoại!',
            'sdt.unique' => 'Số điện thoại đã trùng! Vui lòng nhập lại!',
            'ngay_sinh.required' => 'Vui lòng chọn ngày sinh!',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ!',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp!',
        ];
    }
}