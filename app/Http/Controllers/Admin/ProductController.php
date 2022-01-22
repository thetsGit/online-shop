<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        $products = Product::with('category','ageGroup')->latest()->paginate(5);
        return view('admin.product.index',compact('products','orderCount'));
    }

/*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        $categories = Category::all();
        $ageGroups = AgeGroup::all();
        return view('admin.product.create',compact('categories','ageGroups','orderCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('image');
        $request->validate([
            'name'=>'bail|unique:products,name',
            'price'=>'bail|numeric',
            'description'=>'bail|min:20',
        ]);
        $image = $request->file('image');
        $imageName = uniqid().$image->getClientOriginalName();
        Storage::disk('image')->put($imageName,file_get_contents($image));
        Product::create([
        'name'=>$request->name,
        'slug'=>Str::slug(uniqid().$request->name),
        'price'=>$request->price,
        'image'=>$imageName,
        'description'=>$request->description,
        'category_id'=>$request->category,
        'age_group_id'=>$request->ageGroup,
        'view_count'=>0
        ]);
        return redirect('/admin/products')->with('success',"$request->name is added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        $categories = Category::all();
        $ageGroups = AgeGroup::all();
        $product = Product::where("id",$id)->with('category','ageGroup')->first();
        return view('admin.product.edit',compact('categories','ageGroups','product','orderCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price'=>'bail|numeric',
            'description'=>'bail|min:20',
        ]);
        $product = Product::find($id);
        $preProductName = $product->name;
        $imageName = $product->image;
        if ($request->file('image')) {
            Storage::disk('image')->delete($imageName);
            Storage::disk('image')->put($imageName,file_get_contents($request->file('image')));
            $filename = $request->file('image')->getClientOriginalName();
        }
        $product->update([
        'name'=>$request->name,
        'slug'=>Str::slug(uniqid().$request->name),
        'price'=>$request->price,
        'image'=>$imageName,
        'description'=>$request->description,
        'category_id'=>$request->category,
        'age_group_id'=>$request->ageGroup
        ]);
        return redirect('/admin/products')->with('success',"$preProductName is updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $preProductName = $product->name;
        $product->delete();
        return redirect('/admin/products')->with('success',"$preProductName is deleted");
    }
}
