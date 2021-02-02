<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index() {
        $groups = Group::all();
        $tables = Table::all();
        return view('managers.tables.table', compact('groups', 'tables'));
    }
}
