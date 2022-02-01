<?php

namespace App\Http\Controllers;

use App\Models\FavList;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function toggleLike(Request $request){
        if(!$request->product){
            return response()->json([
                "error"=>"bad request"
            ]);
        }
        $like = Like::where("user_id",auth()->user()->id)->where("product_id",$request->product);
        $product = Product::find($request->product);
        $isLiked = $like->first();
        if($isLiked){
                $like->delete();
                $successMsg = "unliked ".$product->name;
                return response()->json([
                    "success"=>$successMsg
                ]);
        }
        Like::create([
            "user_id"=>auth()->user()->id,
            "product_id"=>$request->product
        ]);
        $successMsg = "liked ".$product->name;
        return response()->json([
            "success"=>$successMsg
        ]);
    }
    public function toggleFavourite(Request $request){
        if(! $request->product){
            return response()->json([
                "error"=>"bad request"
            ]);
        }
        $favourite = FavList::where("user_id",auth()->guard("web")->id())->where("product_id",$request->product);
        $product = Product::find($request->product);
        $isFavourited = $favourite->first();
        if($isFavourited){
             $favourite->delete();
             $successMsg = "removed ".$product->name." from your favourites";
             return response()->json([
                 "success"=>$successMsg
             ]);
        }
        FavList::create([
             "user_id"=>auth()->guard("web")->id(),
             "product_id"=>$request->product
         ]);
         $successMsg = "added ".$product->name." to your favourites";
         return response()->json([
             "success"=>$successMsg
         ]);
     }
}
