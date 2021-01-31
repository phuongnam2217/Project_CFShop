<?php

namespace App\Http\Controllers;

use App\Constants\UserActiveConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormlogin(){
        return view('account.login');
    }
    public function login(Request $request){
        $credentials = [
            'username'=> $request->username,
            'password'=>$request->password,
            'active'=> UserActiveConstant::ACTIVE
        ];
        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }
        return back()->with(['error'=>'Tài khoản hoặc mật khẩu không đúng']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('showFormLogin');
    }
}
