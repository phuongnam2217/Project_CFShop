<?php

namespace App\Http\Controllers;

use App\Models\ImportProduct;
use App\Models\ImportResource;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
            $invoices = Order::all();
            $count = count($invoices);
            $total = 0;
            $countProduct = 0;
            foreach ($invoices as $invoice) {
                $total += $invoice->sub_total;
                foreach ($invoice->products as $product) {
                    $countProduct += $product->pivot->quantity;
                }
            }

            $totalBuyProduct = 0;
            $totalBuyResource = 0;
            $importProducts = ImportProduct::all();
            $importResources = ImportResource::all();
            foreach ($importProducts as $importProduct) {
                $totalBuyProduct += $importProduct->total_buy;
            }
            foreach ($importResources as $importResource) {
                $totalBuyResource += $importResource->total_buy;
            }

            return view('managers.reports.report', compact('count', 'countProduct', 'total', 'totalBuyProduct', 'totalBuyResource'));
    }

    public function showTime($id) {
        if ($id == 1) {
            $startDay = Carbon::now()->startOfDay();
            $endDay = Carbon::now()->endOfDay();

            $invoices = Order::whereBetween('check_in', [$startDay, $endDay])->get();
            $count = count($invoices);
            $total = 0;
            $countProduct = 0;
            foreach ($invoices as $invoice) {
                $total += $invoice->sub_total;
                foreach ($invoice->products as $product) {
                    $countProduct += $product->pivot->quantity;
                }
            }

            $totalBuyProduct = 0;
            $totalBuyResource = 0;
            $importProducts = ImportProduct::whereBetween('created_at', [$startDay, $endDay])->get();
            $importResources = ImportResource::whereBetween('created_at', [$startDay, $endDay])->get();
            foreach ($importProducts as $importProduct) {
                $totalBuyProduct += $importProduct->total_buy;
            }
            foreach ($importResources as $importResource) {
                $totalBuyResource += $importResource->total_buy;
            }

            $html = view('managers.reports.report-view-ajax', compact('count', 'countProduct', 'total', 'totalBuyProduct', 'totalBuyResource'))->render();
            return response()->json(['view'=>$html]);
        }

        if ($id == 2) {
            $startWeek = Carbon::now()->startOfWeek();
            $endWeek = Carbon::now()->endOfWeek();

            $invoices = Order::whereBetween('check_in', [$startWeek, $endWeek])->get();
            $count = count($invoices);
            $total = 0;
            $countProduct = 0;
            foreach ($invoices as $invoice) {
                $total += $invoice->sub_total;
                foreach ($invoice->products as $product) {
                    $countProduct += $product->pivot->quantity;
                }
            }

            $totalBuyProduct = 0;
            $totalBuyResource = 0;
            $importProducts = ImportProduct::whereBetween('created_at', [$startWeek, $endWeek])->get();
            $importResources = ImportResource::whereBetween('created_at', [$startWeek, $endWeek])->get();
            foreach ($importProducts as $importProduct) {
                $totalBuyProduct += $importProduct->total_buy;
            }
            foreach ($importResources as $importResource) {
                $totalBuyResource += $importResource->total_buy;
            }

            $html = view('managers.reports.report-view-ajax', compact('count', 'countProduct', 'total', 'totalBuyProduct', 'totalBuyResource'))->render();
            return response()->json(['view'=>$html]);
        }

        if ($id == 3) {
            $startMonth = Carbon::now()->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            $invoices = Order::whereBetween('check_in', [$startMonth, $endMonth])->get();
            $count = count($invoices);
            $total = 0;
            $countProduct = 0;
            foreach ($invoices as $invoice) {
                $total += $invoice->sub_total;
                foreach ($invoice->products as $product) {
                    $countProduct += $product->pivot->quantity;
                }
            }

            $totalBuyProduct = 0;
            $totalBuyResource = 0;
            $importProducts = ImportProduct::whereBetween('created_at', [$startMonth, $endMonth])->get();
            $importResources = ImportResource::whereBetween('created_at', [$startMonth, $endMonth])->get();
            foreach ($importProducts as $importProduct) {
                $totalBuyProduct += $importProduct->total_buy;
            }
            foreach ($importResources as $importResource) {
                $totalBuyResource += $importResource->total_buy;
            }

            $html = view('managers.reports.report-view-ajax', compact('count', 'countProduct', 'total', 'totalBuyProduct', 'totalBuyResource'))->render();
            return response()->json(['view'=>$html]);
        }


        if ($id == 0) {
            $invoices = Order::all();
            $count = count($invoices);
            $total = 0;
            $countProduct = 0;
            foreach ($invoices as $invoice) {
                $total += $invoice->sub_total;
                foreach ($invoice->products as $product) {
                    $countProduct += $product->pivot->quantity;
                }
            }

            $totalBuyProduct = 0;
            $totalBuyResource = 0;
            $importProducts = ImportProduct::all();
            $importResources = ImportResource::all();
            foreach ($importProducts as $importProduct) {
                $totalBuyProduct += $importProduct->total_buy;
            }
            foreach ($importResources as $importResource) {
                $totalBuyResource += $importResource->total_buy;
            }

            $html = view('managers.reports.report-view-ajax', compact('count', 'countProduct', 'total', 'totalBuyProduct', 'totalBuyResource'))->render();
            return response()->json(['view'=>$html]);
        }
    }
}
