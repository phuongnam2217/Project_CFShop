<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('active', 'like', 1)->get();
        $tables = Table::where('active','1')->get();
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

    public function viewCart($id){
        $table = Table::findOrFail($id);
        if($table->order_id){
            $order = Order::findOrFail($table->order_id);
            $html = view('managers.view-ajax.order.order-ajax',compact('order','table'))->render();
            return response()->json($html);
        }

    }

    public function add(Request $request)
    {
        $table = Table::findOrFail($request->table_id);
        $product = Product::findOrFail($request->product_id);
        if($table->order_id){
           $order = Order:: findOrFail($table->order_id);
           $order_detail = DB::table('order_details')
               ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->first();
           if($order_detail){
               $quantity = $order_detail->quantity + 1;
               $total =  $order_detail->total + $product->price;
               DB::table('order_details')
                   ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->update([
                       'quantity'=>$quantity,
                       'total'=>$total
                   ]);
               $order->sub_total += $product->price;
               $order->save();
           }else{
               DB::table('order_details')->insert([
                   'order_id'=>$order->id,
                   'product_id'=>$product->id,
                   'priceEach'=>$product->price,
                   'quantity'=>1,
                   'total'=>$product->price,
               ]);
               $order->sub_total += $product->price;
               $order->save();
           }
        }else{
            $order = new Order();
            $order->table_id = $table->id;
            $order->sub_total = $product->price;
            $order->discount = 1;
            $order->total = $order->sub_total * $order->discount / 100;
            $order->save();
            DB::table('order_details')->insert([
                'order_id'=> $order->id,
                'product_id'=>$product->id,
                'priceEach'=>$product->price,
                'quantity'=>1,
                'total'=>$product->price,
            ]);

            $table->order_id = $order->id;
            $table->save();
        }
        return response()->json($request->all());
    }

}
