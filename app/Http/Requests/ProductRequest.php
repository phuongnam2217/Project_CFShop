<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required',
            'price'=>'required|numeric',
//            'stock'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '* Tên sản phẩm không được trống !',
            'price.required' => '* Giá sản phẩm không được để trống !',
            'price.numeric' => '* Giá sản phẩm phải là chữ số !',
//            'stock.required' => '* Tồn kho không được để trống !',
//            'stock.numeric' => '* Tồn kho sản phẩm phải là chữ số !',
        ];
    }
}
