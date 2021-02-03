<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Table;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TableController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Table::select('*');
            return DataTables::of($data)
                ->addColumn('status',function ($row){
                    $active = '<span data-id="'.$row->id.'" class="changeActive badge '.($row->active ? 'bg-success': 'bg-danger').'">' . ($row->active ? 'Đang hoạt động': 'Ngưng hoạt động') . '</span>';
                    return $active;
                })
                ->addColumn('group_id',function ($row){
                    $role = '<span class="">' . $row->group->name . '</span>';
                    return $role;
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit edit-table"><i class="fas fa-pencil-alt"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete-table"><i class="fas fa-trash-alt"></i></a>';

                    return $btn;
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('name')) {
                        $query->where('name', 'like', "%{$request->get('name')}%");
                    }
                    if ($request->has('active')) {
                        $query->where('active','=',"{$request->get('active')}");
                    }
                    if ($request->has('group_id')) {
                        $query->where('group_id','=',"{$request->get('group_id')}");
                    }
                })
                ->rawColumns(['group_id','status','action'])
                ->make(true);
        }

        $groups = Group::all();
        $tables = Table::all();
        return view('managers.tables.table', compact('groups', 'tables'));
    }

    public function store(Request $request){
        $table = new Table();
        $table->name = $request->name;
        $table->note = $request->note;
        $table->chair = $request->chair;
        $table->group_id = $request->group_id;
        $table->save();
        return response()->json("Thêm bàn thành công");
    }


    public function show($id){
        $table = Table::findOrFail($id);
        return response()->json($table);
    }

    public function update(Request $request,$id){
        $table = Table::findOrFail($id);
        $table->name = $request->name;
        $table->note = $request->note;
        $table->chair = $request->chair;
        $table->group_id = $request->group_id;
        $table->save();
        return response()->json("Thêm bàn thành công");
    }

    public function delete($id){
        $table = Table::findOrFail($id);
        $table->delete();
        return response()->json("Xóa bàn thành công");
    }

    public function changeActive($id){
        $table = Table::findOrFail($id);
        $table->active = !$table->active;
        $table->save();
        return response()->json("Thay đổi trạng thái thành công");
    }

}
