<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ma_pn' => [
                'required',
                Rule::unique('phieu_nhap')->where('ma_pn', '!=', $this->ma_pn),
            ],
            'ma_ddh' => [
                'required',
                Rule::unique('phieu_nhap')->where('ma_ddh', '!=', $this->ma_ddh),
            ]
        ];
    }

    public function messages()
    {
        return [
            'ma_pn.required' => 'Vui lòng nhập mã phiếu nhập!',
            'ma_pn.unique' => 'Mã này đã trùng! Vui lòng nhập lại!',
            'ma_ddh.required' => 'Vui lòng chọn đơn đặt hàng!',
            'ma_ddh.unique' => 'Đơn đặt hàng này đã có phiếu nhập! Vui lòng chọn lại!'
        ];
    }
}