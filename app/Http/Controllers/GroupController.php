<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index() {
        $groups = Group::all();
        return view('managers.tables.table', compact('groups'));
    }

    public function store(GroupRequest $request) {
        $group = new Group();
        $group->name = $request->input('name');
        $group->save();
        $html = $this->view();
        $viewSelect = $this->viewSelect();
        return response()->json(['view'=>$html,'message'=>'Thêm nhóm bàn nhóm bàn thành công','viewSelect'=>$viewSelect]);
    }

    public function delete($id) {
        $group = Group::findOrFail($id);

        if(count($group->tables)){
            $html = $this->view();
            $viewSelect = $this->viewSelect();
            return response()->json(['view'=>$html,'message'=>'Bạn nên xóa các bàn trước khi xóa nhóm bàn này','viewSelect'=>$viewSelect]);
        }else{
            $html = $this->view();
            $viewSelect = $this->viewSelect();
            $group->delete();
            return response()->json(['view'=>$html,'message'=>'Xóa nhóm bàn thành công','viewSelect'=>$viewSelect]);
        }
    }

    public function show($id){
        $group = Group::findOrFail($id);
        return response()->json($group);
    }
    public function update(GroupRequest $request, $id) {
        $groups = Group::findOrFail($id);

        $groups->name = $request->input('name');

        $groups->save();
        $html = $this->view();
        $viewSelect = $this->viewSelect();
        return response()->json(['view'=>$html,'message'=>'Cập nhât nhóm bàn thành công','viewSelect'=>$viewSelect]);
    }

    public function view()
    {
        $groups = Group::all();
        $html = view('managers.view-ajax.group.group-table',compact('groups'))->render();
        return $html;
    }
    public function viewSelect(){
        $groups = Group::all();
        $select = view('managers.view-ajax.group.select-group',compact('groups'))->render();
        return $select;
    }
}
