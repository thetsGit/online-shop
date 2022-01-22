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
       if(!$product || !$user || !($user->id === auth()->user()->id)){
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
           "user_id"=>auth()->user()->id,
           "comment"=>$request->newComment
       ]);
       return response()->json([
           "success"=>$newComment
       ]);
    }

    public function remove(Request $request){
        if(!$request->commentId){
            return response()->json([
                'error'=>"need comment id"
            ]);
        }
        $comment = Comment::find($request->commentId);
        if(!$comment){
            return response()->json([
                "error"=>"invalid comment id"
            ]);

        }
        if($comment->user_id !== auth()->user()->id){
            return "user ids don't match";
        }
        $comment->delete();
        return response()->json([
            "success"=>"comment deleted"
        ]);
    }
}
