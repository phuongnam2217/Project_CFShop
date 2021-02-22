<?php

namespace App\Http\Controllers;

use App\Models\ImportProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function index() {
        $products = Product::where('isPortable','1')->get();
        $importProducts = ImportProduct::paginate(10);
        return view('managers.resources.importProduct', compact('importProducts','products'));
    }

    public function store(Request $request) {
        $importProduct = new ImportProduct();

        $importProduct->product_id = $request->product_id;
        $importProduct->unit_price = $request->unit_price;
        $importProduct->quantity   = $request->quantity;
        $importProduct->total_buy  = $request->unit_price*$request->quantity;
        $importProduct->note       = $request->note;

        $importProduct->save();

        $id = $request->product_id;
        $product = Product::find($id);
        $product->stock += $request->quantity;
        $product->save();

        $importProducts = ImportProduct::all();
        $html = view('managers.resources.importProduct-table-form', compact('importProducts'))->render();
        return response()->json(['view'=>$html]);
    }

    public function delete(Request $request,$id) {
        $importProduct = ImportProduct::find($id);
        $importProduct->delete();

        $id = $request->product_id;
        $product = Product::find($id);
        $product->stock -= $request->qty;
        $product->save();

        $importProducts = ImportProduct::all();
        $html = view('managers.resources.importProduct-table-form', compact('importProducts'))->render();
        return response()->json(['view'=>$html]);
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $importProducts = ImportProduct::where('id','like', '%'.$search.'%')->paginate(10);

        $html = view('managers.resources.importProduct-table-form', compact('importProducts'))->render();
        return response()->json(['view'=>$html]);
    }
}
