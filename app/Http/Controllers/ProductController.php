<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::all();
        $menus = Menu::all();
        return view('managers.products.product', compact('categories', 'products', 'menus'));
    }

    public function store(Request $request) {
        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->active = 1;
        $product->isPortable = $request->isPortable;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->menu_id = $request->menu_id;

        $product->save();
    }

    public function delete($id) {
        $products = Product::find($id);
        $products->delete();
        return $products;
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->active = 1;
        $product->isPortable = $request->isPortable;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->menu_id = $request->menu_id;

        $product->save();
    }
}
