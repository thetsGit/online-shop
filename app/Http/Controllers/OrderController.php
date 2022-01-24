<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder(){
        $cartProducts = ProductCart::where("user_id",auth()->user()->id)->get();
        foreach ($cartProducts as $cartProduct) {
            ProductOrder::create([
                "user_id"=>$cartProduct->user_id,
                "product_id"=>$cartProduct->product_id,
                "quantity"=>$cartProduct->quantity,
                "status"=>"pending"
            ]);
            ProductCart::find($cartProduct->id)->delete();
        }
        return redirect("/")->withFragment("product-section")->with("success","Your made an order successfully");
    }
}
