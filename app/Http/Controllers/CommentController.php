<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request){
        // return $request;
       if(!$request->user || !$request->product || !$request->newComment){
           return response()->json([
              "error"=>"insufficient request data"
           ]);
       }
       $product = Product::find($request->product);
       $user = User::find($request->user);
       if(!($product || $user)){
        return response()->json([
            "error"=>"invalid user or product"
         ]);
       }
       if($request->newComment === ""){
        return response()->json([
            "error"=>"comment not found"
         ]);
       }
       $newComment = Comment::create([
           "product_id"=>$product->id,
           "user_id"=>$user->id,
           "comment"=>$request->newComment
       ]);
       return response()->json([
           "success"=>$newComment
       ]);
    }
}
