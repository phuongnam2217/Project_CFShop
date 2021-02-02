<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username'=>'required|min:6',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required',
            'password'=>'required|min:6',
            'passwordConfirm'=>'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng không được trống',
            'username.required' => 'Tên đăng nhập không được trống',
            'username.min'=>'Tên đăng nhập tối thiểu phải 6 kí tự',
            'email.required'=>'Email không được trống',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã tồn tại',
            'phone.required'=>'Số điện thoại không được để trống',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu tối thiêu phải 6 kí tự',
            'passwordConfirm.required'=>'Nhập lại mật khẩu không được để trống',
            'passwordConfirm.same'=>'Nhập lại mật khẩu không trùng khớp'
        ];
    }
}
