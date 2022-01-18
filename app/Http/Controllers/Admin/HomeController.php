<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products = [];
        foreach (Product::with('productOrders')->get() as $product) {
            $totalQty = 0;
           foreach ($product->productOrders as $order) {
               $totalQty += $order->quantity;
           }
           $products[$product->name] = $product->price*$totalQty;
        }
        arsort($products);
        $highDemandProducts = array_slice($products,0,5);
        $latestOrders = ProductOrder::latest()->limit(5)->with('user','product')->get();
        $totalViewCount = Product::sum('view_count');
        $totalUsers= User::where('role','user')->count();
        $orderCount = ProductOrder::where('status','pending')->count();
        return view('admin.home.index',compact('orderCount','highDemandProducts','latestOrders','totalViewCount','totalUsers'));
    }
}
