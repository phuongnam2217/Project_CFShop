<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
        $user = User::find(Auth::user()->id);
        return [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('Mật khẩu hiên tại của bạn không đúng.'));
                }
            }],
            'password' => 'required|confirmed|min:6'
        ];
    }
    public function messages()
    {
        return [
            'password.required'=>'* Mật khẩu không được để trống',
            'password.min'=>'* Mật khẩu không được nhở hơn 6 kí tự',
            'password.confirmed'=>'* Mật khẩu không giống nhau',
            'current_password.required'=>'* Mật khẩu hiện tại không được để trống'
        ];
    }
}
