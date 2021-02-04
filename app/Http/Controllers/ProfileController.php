<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $role = User::findOrFail($id)->role;
        return response()->json(['user'=>$user,'role'=>$role]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $id = Auth::user()->id;

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return response()->json('Cập nhật thông tin thành công');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json("Đổi mật khẩu thành công");
    }
}
