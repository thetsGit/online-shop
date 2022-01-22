<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::with("ageGroup","category")->latest();
        $categories = Category::all();
        $ageGroups = AgeGroup::all();
        if($request){
            if($request->search || $request->category || $request->ageGroup)
            {
                if($request->search){
                    $requestedCategory = false;
                    $requestedAgeGroup = false;
                    $searchQuery = $request->search;
                    $products = $products->where("name","LIKE","%$searchQuery%")->with("likes","favourites")->withCount("likes")->paginate(12)->withQueryString()->fragment("product-section");
                    return view("product.index",compact("products","searchQuery","requestedCategory","requestedAgeGroup","ageGroups","categories"));
                }
                if($request->category && $request->ageGroup){
                    $requestedCategory = Category::where("slug",$request->category)->first();
                    $requestedAgeGroup = AgeGroup::where("slug",$request->ageGroup)->first();
                    if(!($requestedAgeGroup || $requestedCategory)){
                        return redirect()->back()->with("errror","Invalid parameters");
                    }
                    $searchQuery = false;
                    $products = $products->where("category_id",$requestedCategory->id)->where("age_group_id",$requestedAgeGroup->id)->with("likes","favourites")->withCount("likes")->paginate(12)->withQueryString()->fragment("product-section");
                    return view("product.index",compact("products","searchQuery","requestedCategory","requestedAgeGroup","categories","ageGroups"));

                }

            }
        }
            $products = $products->with("likes","favourites")->withCount("likes")->paginate(12)->fragment("product-section");
            $searchQuery = false;
            $requestedCategory = false;
            $requestedAgeGroup = false;
            return view("product.index",compact("products","searchQuery","requestedCategory","requestedAgeGroup","categories","ageGroups"));
    }

    public function ageGroupShow(Request $request,$slug){
        $ageGroup = AgeGroup::where("slug",$slug)->first();
        $ageGroups = AgeGroup::all();
        if(!$ageGroup){
            return redirect()->back()->with("error","Not supported route");
        }
        $categories = Category::withCount(["product"=>function($q)use($ageGroup){$q->where("age_group_id",$ageGroup->id);}])->get();
        if($request->category){
            $requestedCategory = Category::where("slug",$request->category)->first();
        if(!$requestedCategory){
            return redirect()->back()->with("error","Invalid parameters");
        }
        else
        {
            $products = Product::where("age_group_id",$ageGroup->id)->where("category_id",$requestedCategory->id)->with("ageGroup","category","favourites","likes")->withCount("likes")->paginate(12)->withQueryString()->fragment("product-section");
            if(!count($products)>0){
                $errorMessage = "No ".$requestedCategory->name." for".$ageGroup->name;
                return redirect()->back()->with("error",$errorMessage);
            }
            return view("product.ageGroup",compact("categories","ageGroup","ageGroups","products","requestedCategory"));
        }

        }
        $products = Product::where("age_group_id",$ageGroup->id)->with("ageGroup","category","likes","favourites")->withCount("likes")->paginate(12)->fragment("product-section");
        $requestedCategory = false;
        return view("product.ageGroup",compact("categories","ageGroups","ageGroup","products","requestedCategory"));
    }

    public function categoryShow(Request $request,$slug){
        $category = Category::where("slug",$slug)->first();
        $categories = Category::all();
        if(!$category){
            return redirect()->back()->with("error","Not supported route");
        }
        $ageGroups = AgeGroup::withCount(["product"=>function($q)use($category){$q->where("category_id",$category->id);}])->get();
        if($request->ageGroup){
        $requestedAgeGroup = AgeGroup::where("slug",$request->ageGroup)->first();
            if(!$requestedAgeGroup){
                return redirect()->back()->with("error","Invalid parameters");
            }
            else
            {
                $products = Product::where("category_id",$category->id)->where("age_group_id",$requestedAgeGroup->id)->with("ageGroup","category","likes","favourites")->withCount("likes")->paginate(12)->withQueryString()->fragment("product-section");
                if(!count($products)>0){
                    $errorMessage = "No ".$category->name." for".$requestedAgeGroup->name;
                    return redirect()->back()->with("error",$errorMessage);
                }
                return view("product.category",compact("ageGroups","category","categories","products","requestedAgeGroup"));
            }

        }
        $products = Product::where("category_id",$category->id)->with("ageGroup","category","likes","favourites")->withCount("likes")->paginate(12)->fragment("product-section");
        $requestedAgeGroup = false;
        return view("product.category",compact("ageGroups","category","categories","products","requestedAgeGroup"));
    }
}
