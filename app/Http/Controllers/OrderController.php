<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $tables = Table::all();
        $groups = Group::all();
        $categories = Category::all();
        return view('cashier.index',compact('tables','products','groups','categories'));
    }
}
