<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(){
        return redirect('/admin');
    }
    public function loginShow(){
       return view("admin.auth.login");
    }
    public function loginCheck(Request $request){
       if(!auth()->attempt($request->only("email","password"))){
          return redirect("admin/login")->with("error","Wrong credentials");
       }
       if(auth()->user()->role !== "admin"){
           return redirect("admin/login")->with("error","You are not admin");
       }
       $username = Auth::user()->name;
       return redirect("admin")->with("success","Welcome back $username");
    }
    public function logout(){
       auth()->logout();
       return redirect("admin/login");
    }
}
