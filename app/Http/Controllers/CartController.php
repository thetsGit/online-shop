<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cartController extends Controller
{
    public function showAll(){
       $productsInCart = ProductCart::where("user_id",auth()->user()->id)->with(["product"=>function($q){$q->with("category","ageGroup");}])->get();
       return view("cart",compact("productsInCart"));
    }
    public function addOne(Request $request){
       if(!$request->productId){
           return redirect()->back()->with("error","product id is required")->withFragment("product-section");
       }
       $product = Product::find($request->productId);
       $successMsg = $product->name." is added";
       if(!$product){
           return redirect()->back()->with("error","invalid product")->withFragment("product-section");
       }
       $isInCart = ProductCart::where("user_id",auth()->user()->id)->where("product_id",$request->productId)->first();
       if($isInCart){
           $isInCart->update([
               "quantity"=>DB::raw("quantity+1")
           ]);
           return redirect()->back()->with("success",$successMsg)->withFragment("product-section");
       }
       ProductCart::create([
           "user_id" => auth()->user()->id,
           "product_id" => $request->productId,
           "quantity" => 1
       ]);
       return redirect()->back()->with("success",$successMsg)->withFragment("product-section");
    }
    public function removeOne(Request $request){
        if(!$request->productId){
            return redirect()->back()->with("error","product id is required")->withFragment("product-section");
        }
        $product = Product::find($request->productId);
        $successMsg = $product->name." is removed";
        if(!$product){
            return redirect()->back()->with("error","invalid product")->withFragment("product-section");
        }
        $isInCart = ProductCart::where("user_id",auth()->user()->id)->where("product_id",$request->productId)->first();
        if($isInCart && $isInCart->quantity>1){
            $isInCart->update([
                "quantity"=>DB::raw("quantity-1")
            ]);
            return redirect()->back()->with("success",$successMsg)->withFragment("product-section");
        }
        ProductCart::find($isInCart->id)->delete();
        return redirect()->back()->with("success",$successMsg)->withFragment("product-section");
    }
}
