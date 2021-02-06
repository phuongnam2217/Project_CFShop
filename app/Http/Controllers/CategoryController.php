<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('managers.products.product', compact('categories'));
    }

    public function store(Request $request) {
        $categorie = new Category;

        $categorie->name = $request->input('name');

        $categorie->save();

        $categories = Category::all();
        $html = view('managers.products.category-table-form', compact('categories'))->render();
        $select = view('managers.products.select-category', compact('categories'))->render();
        return response()->json(['view'=>$html, 'select'=>$select]);
    }

    public function delete($id) {
        $category = Category::find($id);
        if(count($category->products)){
            return response()->json(['message'=>"Bạn nên xóa tất cả các sản phẩm trong nhóm hàng này"]);
        }
        $category->delete();
        $categories = Category::all();
        $html = view('managers.products.category-table-form', compact('categories'))->render();
        $select = view('managers.products.select-category', compact('categories'))->render();
        return response()->json(['view'=>$html, 'select'=>$select]);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);

        $category->name = $request->input('name');

        $category->save();

        $categories = Category::all();
        $products   = Product::paginate(10);
        $html = view('managers.products.category-table-form', compact('categories'))->render();
        $select = view('managers.products.select-category', compact('categories'))->render();
        $html_table = view('managers.products.product-table-form', compact('products'))->render();
        return response()->json(['view'=>$html, 'select'=>$select, 'products'=>$html_table]);
    }
}
