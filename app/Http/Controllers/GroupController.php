<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index() {
        $groups = Group::all();
        return view('managers.tables.table', compact('groups'));
    }

    public function store(Request $request) {
        $group = new Group();
        $group->name = $request->input('name');
        $group->save();
        $groups = Group::all();
        $html = view('managers.view-ajax.group-table',compact('groups'))->render();
        return response()->json($html);
    }

    public function delete($id) {
        $groups = Group::find($id);
        $groups->delete();
        return $groups;
    }

    public function update(Request $request, $id) {
        $groups = Group::find($id);

        $groups->name = $request->input('name');

        $groups->save();
    }
}
