<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Models\Group;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TableController extends Controller
{
    public function index(Request $request) {
        if (!$this->userCan('admin')) {
            return redirect()->back()->with('alert', 'Chỉ có ADMIN mới được quyền truy cập!');
        }
        if($request->ajax()){
            $tables = Table::select('*');
            $tables =  $tables->where(function ($query) use ($request) {
                    if ($request->has('name')) {
                        $query->where('name', 'like', "%{$request->get('name')}%");
                    }
                    if ($request->has('group_id')) {
                        $query->whereIn('group_id',$request->get('group_id'));
                    }
                    if ($request->has('active')) {
                        if($request->get('active') == '2'){
                            $query->whereIn('active',[0,1]);
                        }else{
                            $query->where('active','=',"{$request->get('active')}");
                        }
                    }
                })->get();
            $html = view('managers.view-ajax.table.table-form',compact('tables'))->render();
            return response()->json(['view'=>$html]);
        }
        $groups = Group::all();
        $tables = Table::all();
        return view('managers.tables.table', compact('groups', 'tables'));
    }

    public function store(TableRequest $request){
        $table = new Table();
        $table->name = $request->name;
        $table->note = $request->note;
        $table->chair = $request->chair;
        $table->group_id = $request->group_id;
        $table->save();
        return response()->json(['view' => $this->getViewTableAdmin(), 'status'=>'Thêm bàn thành công']);
    }


    public function show($id){
        $table = Table::findOrFail($id);
        return response()->json($table);
    }

    public function update(TableRequest $request,$id){
        $table = Table::findOrFail($id);
        $table->name = $request->name;
        $table->note = $request->note;
        $table->chair = $request->chair;
        $table->group_id = $request->group_id;
        $table->save();
        return response()->json(['view' => $this->getViewTableAdmin(), 'status'=>'Cập nhật bàn thành công']);
    }

    public function delete($id){
        if (!$this->userCan('admin')) {
            return redirect()->back()->with('alert', 'Chỉ có ADMIN mới được quyền truy cập!');
        }
        $table = Table::findOrFail($id);
        $table->delete();
        return response()->json(['view' => $this->getViewTableAdmin(), 'status'=>'Cập nhật bàn thành công']);
    }

    public function changeActive($id){
        $table = Table::findOrFail($id);
        $table->active = !$table->active;
        $table->save();
        return response()->json(['view' => $this->getViewTableAdmin(), 'status'=>'Thay đổi trạng thái thành công']);
    }

    public function getViewTable($group_id){
        if($group_id == 0){
            $tables = Table::where('active','1')->get();
            $html = view('managers.view-ajax.table.table-ajax',compact('tables'))->render();
            return response()->json($html);
        }
        $tables = Table::where('group_id',$group_id)->where('active','1')->get();
        $html = view('managers.view-ajax.table.table-ajax',compact('tables'))->render();
        return response()->json($html);
    }

    public function getViewTableAdmin(){
        $tables = Table::all();
        $html = view('managers.view-ajax.table.table-form',compact('tables'))->render();
        return $html;
    }
}
