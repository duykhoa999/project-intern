<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'unique:nhan_vien,email,' . $this->email . ',email',
            ],
            'sdt' => [
                'required',
                'unique:nhan_vien,email,' . $this->sdt. ',sdt',
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