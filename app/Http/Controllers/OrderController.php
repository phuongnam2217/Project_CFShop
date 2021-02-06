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
        $products = Product::where('active', 'like', 1)->get();
        $tables = Table::all();
        $groups = Group::all();
        $categories = Category::all();
        return view('cashier.index',compact('tables','products','groups','categories'));
    }

    public function showProduct($id) {
        if($id == 1){
            $products = Product::where('active', 'like', 1)->get();
            $html = view('cashier.view.menu-detail-group', compact('products'))->render();
            return response()->json(['view'=>$html]);
        }
        $products = Product::where('category_id', 'like', $id)->where('active', 'like', 1)->get();

        $html = view('cashier.view.menu-detail-group', compact('products'))->render();
        return response()->json(['view'=>$html]);
    }

    public function search(Request $request) {
        $search = $request->input('searcher');
        $products = Product::where('name', 'LIKE', '%'.$search.'%')->get();

        $html = view('cashier.view.menu-detail-group', compact('products'))->render();
        return response()->json(['view'=>$html]);
    }
}
