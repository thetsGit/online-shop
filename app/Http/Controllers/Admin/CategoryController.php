<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $orderCount = ProductOrder::where('status','pending')->count();
        $categories = Category::orderBy('updated_at','DESC')->paginate(5);

        return view('admin.category.index',compact('categories','orderCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        return view('admin.category.create',compact('orderCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'bail|required|min:3|unique:categories,name'
        ]);
        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name)
        ]);
        $successMsg = "\"$request->name\" is added";
        return redirect('/admin/categories')->with('success',$successMsg);
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
    public function edit(Category $category)
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        return view('admin.category.edit',compact('category','orderCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name'=>"bail|required|min:3|unique:categories,name,$category->id"
        ]);
        Category::find($category->id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name)
        ]);
        $successMsg = "\"$category->name\" is updated to \"$request->name\"";
        return redirect('/admin/categories')->with('success',$successMsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();
        $successMsg = "\"$name\" is deleted";
        return redirect('/admin/categories')->with('success',$successMsg);
    }
}
