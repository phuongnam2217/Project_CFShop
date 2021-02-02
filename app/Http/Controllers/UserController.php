<?php

namespace App\Http\Controllers;

use App\Constants\UserActiveConstant;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                ->addColumn('status',function ($row){
                    $active = '<span data-id="'.$row->id.'" class="changeActive badge '.($row->active ? 'bg-success': 'bg-danger').'">' . ($row->active ? 'Đang hoạt động': 'Ngưng hoạt động') . '</span>';
                    return $active;
                })
                ->addColumn('role_id',function ($row){
                    $role = '<span class="badge bg-success">' . $row->role->name . '</span>';
                  return $role;
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit edit-user"><i class="fas fa-pencil-alt"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete-user"><i class="fas fa-trash-alt"></i></a>';

                    return $btn;
                })
                ->editColumn('active','{{$active == 1 ? "Đang hoạt động": "Không hoạt động"}}')
                ->filter(function ($query) use ($request) {
                    if ($request->has('name')) {
                        $query->where('name', 'like', "%{$request->get('name')}%");
                    }
                })
                ->rawColumns(['role_id','status','action'])
                ->make(true);
        }
        $roles = Roles::all();
        return view('managers.users.users',compact('roles'));
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
