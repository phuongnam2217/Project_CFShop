<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() {
        $categories = Category::all();
        $products   = Product::paginate(10);
        $menus      = Menu::all();
        return view('managers.products.product', compact('categories', 'products', 'menus'));
    }

    public function store(ProductRequest $request) {
        $this->productService->add($request);
        return $this->returnView();
    }

    public function show($id){
        $product = Product::findOrFail($id);
        $categoryProduct = Product::findOrFail($id)->category;
        return response()->json(['product'=>$product,'category'=>$categoryProduct]);
    }

    public function delete($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return $this->returnView();
    }

    public function update(ProductRequest $request, $id) {
        $product  = $this->productService->findById($id);
        $this->productService->update($request, $product);
        return $this->returnView();
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $products = Product::where('name', 'LIKE', '%'.$search.'%')->paginate(10);

        $html = view('managers.products.product-table-form', compact('products'))->render();
        return response()->json(['view'=>$html]);
    }

    public function changeActive($id){
        $product = Product::findOrFail($id);
        $product->active = !$product->active;
        $product->save();
        return $this->returnView();
    }

    public function returnView() {
        $products = Product::paginate(10);
        $html = view('managers.products.product-table-form', compact('products'))->render();
        return response()->json(['view'=>$html]);
    }

    public function showActive($id) {
        if($id == 2){
            return $this->returnView();
        }
        $products = Product::where('active', 'like', $id)->paginate(10);
        $html = view('managers.products.product-table-form', compact('products'))->render();
        return response()->json(['view'=>$html]);
    }
}
