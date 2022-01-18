<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function pending(){
       $pendingOrders = ProductOrder::where('status','pending')->latest('updated_at')->with('user','product')->paginate(5);
       return view('admin.order.pending',compact('pendingOrders'));
   }
   public function complete(Request $request){
    $orderCount = ProductOrder::where('status','pending')->count();
    if(isset($request->start_date)){
        $completeOrders = ProductOrder::whereBetween('created_at',[$request->start_date,$request->end_date])->where('status','complete')->latest('updated_at')->with('user','product')->paginate(5)->appends($request->all());
    }else{
        $completeOrders = ProductOrder::where('status','complete')->latest('updated_at')->with('user','product')->paginate(5);
    }

    return view('admin.order.complete',compact('completeOrders','orderCount'));
}
   public function makeComplete(ProductOrder $order){
    //    return $order;
       $order->update([
           'status'=>'complete'
       ]);
       return redirect('/admin/orders/pending')->with('success','Order is confirmed');
   }
}
