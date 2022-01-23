<?php

namespace App\Http\Controllers;

use App\Models\FavList;
use App\Models\Like;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function toggleLike(Request $request){
        if(!($request->user || $request->product)){
            return abort(400);
        }
        $like = Like::where("user_id",$request->user)->where("product_id",$request->product);
        $isLiked = $like->first();
        if($isLiked){
                $like->delete();
                return redirect()->back()->withFragment("product-section")->with("success","unliked");
        }
        Like::create([
            "user_id"=>$request->user,
            "product_id"=>$request->product
        ]);
        return redirect()->back()->withFragment("product-section")->with("success","liked");
    }
    public function toggleFavourite(Request $request){
        if(!($request->user || $request->product)){
            return abort(400);
        }
        $favourite = FavList::where("user_id",$request->user)->where("product_id",$request->product);
        $isFavourited = $favourite->first();
        if($isFavourited){
             $favourite->delete();
             return redirect()->back()->withFragment("product-section")->with("success","removed from your favourites");
        }
        FavList::create([
             "user_id"=>$request->user,
             "product_id"=>$request->product
         ]);
         return redirect()->back()->withFragment("product-section")->with("success","added to favourites");
     }
}
