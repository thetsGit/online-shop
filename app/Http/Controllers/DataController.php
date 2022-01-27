<?php

namespace App\Http\Controllers;

use App\Models\FavList;
use App\Models\Like;
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
        $isLiked = $like->first();
        if($isLiked){
                $like->delete();
                return response()->json([
                    "success"=>"unliked"
                ]);
        }
        Like::create([
            "user_id"=>auth()->user()->id,
            "product_id"=>$request->product
        ]);
        return response()->json([
            "success"=>"liked"
        ]);
    }
    public function toggleFavourite(Request $request){
        if(! $request->product){
            return response()->json([
                "error"=>"bad request"
            ]);
        }
        $favourite = FavList::where("user_id",auth()->guard("web")->id())->where("product_id",$request->product);
        $isFavourited = $favourite->first();
        if($isFavourited){
             $favourite->delete();
             return response()->json([
                 "success"=>"removed"
             ]);
        }
        FavList::create([
             "user_id"=>auth()->guard("web")->id(),
             "product_id"=>$request->product
         ]);
         return response()->json([
             "success"=>"added"
         ]);
     }
}
