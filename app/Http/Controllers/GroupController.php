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
        $groups = new Group();

        $groups->name = $request->input('name');

        $groups->save();
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
