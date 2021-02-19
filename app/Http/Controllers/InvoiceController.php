<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index() {
        $orders = Order::paginate(10);
        $tables = Table::all();
        $products   = Product::all();
        return view('managers.invoices.invoice', compact('orders','tables','products'));
    }

    public function show($id){
        $order = Order::findOrFail($id);
        $products   = Product::all();
        return response()->json(['order'=>$order,'products'=>$products]);
    }
}
