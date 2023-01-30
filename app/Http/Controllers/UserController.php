<?php

namespace App\Http\Controllers;

use App\Constants\UserActiveConstant;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Roles;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (!$this->userCan('admin')) {
            return redirect()->back()->with('alert', 'Chỉ có ADMIN mới được quyền truy cập!');
        }
        if ($request->ajax()) {
            $users = User::select('*');
            $users =  $users->where(function ($query) use ($request) {
                if ($request->has('name')) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('active')) {
                    if($request->get('active') == '2'){
                        $query->whereIn('active',[0,1]);
                    }else{
                        $query->where('active','=',"{$request->get('active')}");
                    }
                }
            })->get();
            $html = view('managers.users.user-table',compact('users'))->render();
            return response()->json(['view'=>$html]);
        }
        $roles = Roles::all();
        $users = User::all();
        return view('managers.users.users',compact('roles','users'));
    }


    public function create()
    {
        //
    }


    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json('Thêm mới người dùng thành công');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        if($request->has('password') && $request->has('passwordConfirm')){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json('Cập nhật thông tin người dùng thành công');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('Xóa người dùng thành công');
    }

    public function changeActive($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();
        return response()->json("Thay đổi trạng thái người dùng thành công");
    }
}
