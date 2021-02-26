<?php

namespace App\Http\Controllers;

use App\Models\ImportProduct;
use App\Models\ImportResource;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $startDay = Carbon::now()->startOfDay();
        $endDay = Carbon::now()->endOfDay();
        $invoices = Order::whereBetween('check_out',[$startDay,$endDay])->where('status','0')->get();
        $count = count($invoices);
        $total = 0;
        $totalBuy = 0;
        foreach ($invoices as $invoice){
            $total += $invoice->sub_total;
        }

        $importProducts = ImportProduct::whereBetween('created_at',[$startDay,$endDay])->get();
        $importResources = ImportResource::whereBetween('created_at',[$startDay,$endDay])->get();
        foreach ($importProducts as $importProduct) {
            $totalBuy += $importProduct->total_buy;
        }
        foreach ($importResources as $importResource) {
            $totalBuy += $importResource->total_buy;
        }

        $hotProducts = DB::table('order_details')
            ->select('product_id',DB::raw('SUM(quantity) as qty'))
            ->whereBetween('updated_at',[$startDay,$endDay])
            ->groupBy('product_id')->orderBy('qty', 'DESC')
            ->limit(3)->get();
        $products = Product::all();

        $stockProducts = Product::where('stock','<',5)->get();

        return view('managers.home.home', compact('invoices','count','total','totalBuy','hotProducts','products','stockProducts'));
    }
}
