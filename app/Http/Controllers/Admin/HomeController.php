<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Carbon\Carbon;
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
        $totalViewCount = Product::sum('view_count');


        //
        $totalUsers = User::where("role","user")->count();
        // $usersObj = $userOrm->selectRaw("name")->get();
        // $users = [];
        // foreach ($usersObj as $user) {
        //     $users[] = $user->name;
        // }

        // $userOrderCount = $userOrm->withCount("orders");
        $dates = [];
        $dateOrders = [];
        for ($i=0; $i < 10; $i++) {
            $dates[] = Carbon::now()->subDays($i)->toDateString();
            $dateOrders[] = intval(ProductOrder::whereDate("created_at",$dates[$i])->sum("quantity"));
        }
        // return $dates;
        // return $highDemandProducts;
        // $highDemandProducts = [];
        // $totalRevenues = [];
        // foreach ($highDemandProductsObj as $highDemandProduct => $totalRevenue) {
        //     $highDemandProducts[] = $highDemandProduct;
        //     $totalRevenues[] = $totalRevenue;
        // }
        $orderCount = ProductOrder::where('status','pending')->count();
        return view('admin.home.index',compact('orderCount','highDemandProducts','totalViewCount','totalUsers','dates','dateOrders'));
    }
}
