<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\FavList;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

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
       if(!auth()->guard("web")->attempt($request->only("email","password"))){
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
       $file->move(public_path("image"),$file_name);
    //    $file_name = uniqid().$file->getClientOriginalName();
    //    Storage::disk("image")->put($file_name,file_get_contents($file));
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

    public function profile(){
        $user = User::where("id",auth()->user()->id)->withCount("likes")->withCount("comments")->withCount("favourites")->first();
        $pending = ProductOrder::where("user_id",auth()->user()->id)->where("status","pending")->with("product");
        $pendingOrders = $pending->get();
        $pendingOrderCount = $pending->count();
        $completed = ProductOrder::where("user_id",auth()->user()->id)->where("status","complete")->with("product");
        $completedOrderCount = $completed->count();
        $completedOrders = $completed->paginate(5);
        return view("profile",compact("user","pendingOrders","pendingOrderCount","completedOrders","completedOrderCount"));
    }

    public function uploadProfileImage(Request $request){
        $image = $request->image;
        $imageName = uniqid().$image->getClientOriginalName();
        $user = User::find(auth()->user()->id);
        // Storage::disk("image")->put($imageName,file_get_contents($request->image));
        // Storage::disk("image")->delete($user->image);
        $image->move(public_path("image"),$imageName);
        File::delete(public_path("/image/").$user->image);
        $user->update([
            "image"=>$imageName
        ]);

      return asset("/image/".$imageName);
    }
    public function showFavourites(){
        $favourites = FavList::where("user_id",auth()->user()->id)->with("product.category","product.ageGroup")->paginate(12)->fragment("product-section");
        return view("favourites",compact("favourites"));
    }
}
