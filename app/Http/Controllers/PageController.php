<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(){
        $categories = Category::withCount("product")->get();
        $ageGroups = AgeGroup::all();
        $products = Product::with("ageGroup","category")->withCount("likes")->latest()->get();
        return view("index",compact('products','categories','ageGroups'));
    }

    public function signinShow(){
        return view("auth.signin");
    }

    public function signinStore(Request $request){
       if(!auth()->attempt($request->only("email","password"))){
          return redirect()->back()->with("error","Wrong credentials");
       }
       $welcomeMessage = "Welcome ".auth()->user()->name;
       return redirect("/")->with("success",$welcomeMessage);
    }

    public function registerShow(){
       return view("auth.register");
    }

    public function registerStore(Request $request){
       $request->validate([
           "name"=>"bail|required|unique:users,name",
           "email"=>"bail|required|unique:users,email",
           "password"=>"bail|required|min:5",
           "image"=>"bail|required|mimetypes:image/jpg,image/jpeg,image/png"
       ]);
       $file = $request->file("image");
       $file_name = uniqid().$file->getClientOriginalName();
       Storage::disk("image")->put($file_name,file_get_contents($file));
       User::create([
           "name"=>$request->name,
           "email"=>$request->email,
           "password"=>Hash::make($request->password),
           "image"=>$file_name
       ]);
       return redirect("/signin")->with("success","You've registered successfully");
    }

    public function signout(){
        auth()->logout();
        return redirect("/");
     }

    public function productDetail($slug){
       $product = Product::where("slug",$slug)->first();
       if(!$product){
           return redirect()->back()->with("error","Not supported route");
       }
       $product->update([
        "view_count"=>DB::raw("view_count+1")
       ]);
       $product = Product::where("slug",$slug)->with("category","ageGroup","favourites")->with(["comments"=>function($q){$q->with("user")->latest()->get();}])->withCount("likes")->first();
       return view("productDetail",compact("product"));
    }
}
