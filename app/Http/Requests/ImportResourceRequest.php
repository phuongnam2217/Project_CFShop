<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unit_price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'unit_price.required' => '* Giá nhập không được trống !',
            'unit_price.numeric' => '* Giá nhập phải là chữ số !',
            'quantity.required' => '* Số lượng nguyên liệu không được để trống !',
            'quantity.numeric' => '* Số lượng nguyên liệu phải là chữ số !',
        ];
    }
}
