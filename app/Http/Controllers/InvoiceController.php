<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        if (!$this->userCan('admin') & !$this->userCan('cashier')) {
            return redirect()->back()->with('alert', 'Chỉ có ADMIN hoặc thu ngân mới được quyền truy cập!');
        }
        $orders = Order::where('status','0')->paginate(10);
        $tables = Table::all();
        $products   = Product::all();
        return view('managers.invoices.invoice', compact('orders','tables','products'));
    }

    public function show($id){
        $order = Order::findOrFail($id);
        $html = view('managers.invoices.order-detail-ajax', compact('order'))->render();
        return response()->json(['view'=>$html]);
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $tables = Table::all();
        $orders = Order::where('id', 'LIKE', '%'.$search.'%')->paginate(10);

        $html = view('managers.invoices.table-order', compact('orders','tables'))->render();
        return response()->json(['view'=>$html]);
    }

    public function showTime($id){
        if($id == 0) {
            $tables = Table::all();
            $orders = Order::where('status','0')->paginate(10);
            
            $html = view('managers.invoices.table-order', compact('orders','tables'))->render();
            return response()->json(['view'=>$html]);
        }
        if($id == 1) {
            $startDay = Carbon::now()->startOfDay();
            $endDay = Carbon::now()->endOfDay();
            $tables = Table::all();
            $orders = Order::whereBetween('check_out',[$startDay,$endDay])->get();

            $html = view('managers.invoices.table-order', compact('orders','tables'))->render();
            return response()->json(['view'=>$html]);
        }
        if($id == 2){
            $startWeek = Carbon::now()->startOfWeek();
            $endWeek = Carbon::now()->endOfWeek();
            $tables = Table::all();
            $orders = Order::whereBetween('check_out',[$startWeek,$endWeek])->get();

            $html = view('managers.invoices.table-order', compact('orders','tables'))->render();
            return response()->json(['view'=>$html]);
        }
        if($id == 3){
            $startMonth = Carbon::now()->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();
            $tables = Table::all();
            $orders = Order::whereBetween('check_out',[$startMonth,$endMonth])->get();

            $html = view('managers.invoices.table-order', compact('orders','tables'))->render();
            return response()->json(['view'=>$html]);
        }
    }
}
