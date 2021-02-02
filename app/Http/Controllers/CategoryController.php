<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('managers.products.product', compact('categories'));
    }

    public function store(Request $request) {
        $categories = new Category;

        $categories->name = $request->input('name');

        $categories->save();
    }

    public function delete($id) {
        $categories = Category::find($id);
        $categories->delete();
        return $categories;
    }

    public function update(Request $request, $id) {
        $categories = Category::find($id);

        $categories->name = $request->input('name');

        $categories->save();
    }
}
