<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgeGroup;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        $ageGroups = AgeGroup::orderBy('updated_at','DESC')->paginate(5);
        return view('admin.age_group.index',compact('ageGroups','orderCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        return view('admin.age_group.create',compact('orderCount'));
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
            'name'=>'bail|required|min:3|unique:age_groups,name'
        ]);
        AgeGroup::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name)
        ]);
        $successMsg = "\"$request->name\" is added";
        return redirect('/admin/ageGroups')->with('success',$successMsg);
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
    public function edit(AgeGroup $ageGroup)
    {
        $orderCount = ProductOrder::where('status','pending')->count();
        return view('admin.age_group.edit',compact('ageGroup','orderCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgeGroup $ageGroup)
    {
        $request->validate([
            'name'=>"bail|required|min:3|unique:age_groups,name,$ageGroup->id"
        ]);
        AgeGroup::find($ageGroup->id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name)
        ]);
        $successMsg = "\"$ageGroup->name\" is updated to \"$request->name\"";
        return redirect('/admin/ageGroups')->with('success',$successMsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgeGroup $ageGroup)
    {
        $name = $ageGroup->name;
        $ageGroup->delete();
        $successMsg = "\"$name\" is deleted";
        return redirect('/admin/ageGroups')->with('success',$successMsg);
    }
}
