<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ma_ddh' => [
                'required',
                Rule::unique('don_dh')->where('ma_ddh', '!=', $this->ma_ddh),
            ],
            'ma_ncc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ma_ddh.required' => 'Vui lòng nhập mã đơn đặt hàng!',
            'ma_ddh.unique' => 'Mã này đã trùng! Vui lòng nhập lại!',
            'ma_ncc.required' => 'Vui lòng chọn nhà cung cấp!'
        ];
    }
}