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
           return response()->json([
               "error" => "bad request"
           ]);
       }
       $product = Product::find($request->productId);
    //    $successMsg = $product->name." is added";
       if(!$product){
           return response()->json([
               "error" => "bad request"
           ]);
       }
       $successMsg = $product->name." is added";
       $isInCart = ProductCart::where("user_id",auth()->user()->id)->where("product_id",$request->productId)->first();
       if($isInCart){
           $isInCart->update([
               "quantity"=>DB::raw("quantity+1")
           ]);
           return response()->json([
               "success" => $successMsg
           ]);
       }
       ProductCart::create([
           "user_id" => auth()->user()->id,
           "product_id" => $request->productId,
           "quantity" => 1
       ]);
       return response()->json([
           "success"=>$successMsg
       ]);
    }
    public function removeOne(Request $request){
        if(!$request->productId){
            return response()->json([
                "success" => "bad request"
            ]);
        }
        $product = Product::find($request->productId);
        // $successMsg = $product->name." is removed";
        if(!$product){
            return response()->json([
                "success"=>"bad request"
            ]);
        }
        $successMsg = $product->name." is removed";
        $isInCart = ProductCart::where("user_id",auth()->user()->id)->where("product_id",$request->productId)->first();
        if($isInCart && $isInCart->quantity>1){
            $isInCart->update([
                "quantity"=>DB::raw("quantity-1")
            ]);
            return response()->json([
                "success"=>$successMsg
            ]);
        }
        ProductCart::find($isInCart->id)->delete();
        return response()->json([
            "success"=>$successMsg
        ]);
    }
}
