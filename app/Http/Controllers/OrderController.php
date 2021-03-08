<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Carbon\Carbon;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if (!$this->userCan('cashier') & !$this->userCan('admin')) {
            return redirect()->back()->with('alert', 'Chỉ có ADMIN hoặc thu ngân mới được quyền truy cập!');
        }
        $products = Product::where('active', '=', 1)->get();
        $tables = Table::where('active','1')->get();
        $groups = Group::all();
        $categories = Category::all();
        return view('cashier.index',compact('tables','products','groups','categories'));
    }

    public function showProduct($id) {
        if($id == 0){
            $products = Product::where('active', '=', 1)->get();
            $html = view('cashier.view.menu-detail-group', compact('products'))->render();
            return response()->json(['view'=>$html]);
        }
        $products = Product::where('category_id', '=', $id)->where('active', '=', 1)->get();

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
                       'total'=>$total,
                       'updated_at'=>Carbon::now(),
                       'isMaking'=> false,
                   ]);
               $order->sub_total += $product->price;
               $order->status = "2";
               $order->save();
           }else{
               DB::table('order_details')->insert([
                   'order_id'=>$order->id,
                   'product_id'=>$product->id,
                   'priceEach'=>$product->price,
                   'quantity'=>1,
                   'total'=>$product->price,
                   'created_at'=>Carbon::now(),
                   'updated_at'=>Carbon::now(),
                   'isMaking'=> false,
               ]);
               $order->sub_total += $product->price;
               $order->status = "2";
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
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            $table->order_id = $order->id;
            $table->save();
        }
        $tables = Table::all();

        $html = view('managers.view-ajax.table.table-ajax', compact('tables'))->render();
        return response()->json(['view'=>$html]);
    }

    public function delete(Request $request,$productId){
        $table = Table::findOrFail($request->table_id);
        $order = Order::findOrFail($table->order_id);
        $product = Product::findOrFail($productId);
        $order_detail = DB::table('order_details')
            ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->first();
        $quantity = $order_detail->quantity - 1;
        $total =  $order_detail->total - $product->price;
        if(!$quantity == 0){
            DB::table('order_details')
                ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->update([
                    'quantity'=> $quantity,
                    'total'=> $total
                ]);
            $order->sub_total -= $product->price;
            $order->save();

        }else{
            DB::table('order_details')
                ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->delete();
            $order->sub_total -= $product->price;
            $order->save();
            if(count($order->products) == 0){
                $order->delete();
                $table->order_id = null;
                $table->save();
            }
        }

    }

    public function remove(Request $request,$productId)
    {
        $table = Table::findOrFail($request->table_id);
        $order = Order::findOrFail($table->order_id);
        $product = Product::findOrFail($productId);
        $order_detail = DB::table('order_details')
            ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->first();
        $order->sub_total -= $order_detail->total;
        $order_detail = DB::table('order_details')
            ->where([['order_id','=',$order->id],['product_id','=',$product->id]])->delete();
        $order->save();
        if(count($order->products) == 0){
            $order->delete();
            $table->order_id = null;
            $table->save();
            $tables = Table::all();
            $html = view('managers.view-ajax.table.table-ajax', compact('tables'))->render();
            return response()->json(['view'=>$html]);
        }
    }

    public function changeStatusOrderDetail(Request $request,$product_id)
    {
        $table = Table::findOrFail($request->table_id);
        if($request->isMaking){
            $order = Order::findOrFail($table->order_id);
            $order->status = "2";
            $order->save();
            DB::table('order_details')
                ->where([['order_id','=',$table->order_id],['product_id','=',$product_id]])->update([
                    'isMaking'=> false,
                'release_at'=>null
            ]);
            $order = Order::findOrFail($table->order_id);
            return response()->json($order);
         }else{
            DB::table('order_details')
                ->where([['order_id','=',$table->order_id],['product_id','=',$product_id]])->update([
                    'isMaking'=> true,
                    'release_at'=>Carbon::now()
                ]);
        }
        $order_details = DB::table('order_details')
            ->where('order_id',$table->order_id)->get();
        $statusOrder = true;
        foreach ($order_details as $item){
            if(!$item->isMaking){
                $statusOrder = false;
            }
        }
        if($statusOrder){
            $order = Order::findOrFail($table->order_id);
            $order->status = "1";
            $order->save();
        }
        return response()->json($statusOrder);
    }

    public function viewPayment($order_id,Request $request)
    {
        $table = Table::find($request->table_id);
        $order = Order::findOrFail($order_id);
        $html = view('managers.view-ajax.order.payment-ajax',compact('order','table'))->render();
        return response()->json($html);
    }

    public function payment(Request $request,$id){
        $table = Table::findOrFail($request->table_id);
        $order = Order::findOrFail($id);
        if($request->discount == 0){
            $order->discount = null;
            $order->total = $order->sub_total;
            $order->check_out = Carbon::now();
            $order->status = "0";
            $order->save();
        }else{
            $order->discount = $request->discount;
            $order->total = $order->sub_total*(1-$request->discount/100);
            $order->check_out = Carbon::now();
            $order->status = "0";
            $order->save();
        }
        $table->order_id = null;
        $table->save();
        foreach ($order->products as $item) {
            $productID = $item->pivot->product_id;
            $product = Product::findOrFail($productID);
            if($product->isPortable == 1) {
                $product->stock -= $item->pivot->quantity;
                $product->save();
            }
        }
    }

    public function print(Request $request, $id) {
        $table = Table::findOrFail($request->table_id);
        $order = Order::findOrFail($id);
        if($request->discount == 0){
            $order->discount = null;
            $order->total = $order->sub_total;
            $order->check_out = Carbon::now();
            $order->status = "0";
            $order->save();
        }else{
            $order->discount = $request->discount;
            $order->total = $order->sub_total*(1-$request->discount/100);
            $order->check_out = Carbon::now();
            $order->status = "0";
            $order->save();
        }
        $table->order_id = null;
        $table->save();
        foreach ($order->products as $item) {
            $productID = $item->pivot->product_id;
            $product = Product::findOrFail($productID);
            if($product->isPortable == 1) {
                $product->stock -= $item->pivot->quantity;
                $product->save();
            }
        }
//        return view('cashier.print',compact('order'));
        $html = view('cashier.print',compact('order'))->render();
        return response()->json($html);
    }
}
