<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $subcategories=SubCategory::with(['category'])->get(['id','name','category_id','created_at']);
        $subcategories=SubCategory::get(['id','name','category_id','created_at']);
        $delCategories=SubCategory::onlyTrashed()->withCount('category')->get(['id','name','created_at']);
        return view('subcategory.index', compact('subcategories','delCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get(['id','name']);
        // return $categories;
        return view('subcategory.create',compact('categories'));
    }

       public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' =>'required|numeric',
            'subcategory_name'=>'required|string',
            'is_active'=>'nullable'
        ]); // dd($request->all());
        SubCategory::create([
            'category_id' =>$request->category_id,
            'name' =>$request->subcategory_name,
            'slug' =>Str::slug($request->subcategory_name)  ,
            'is_active' =>$request->filled('is_active'),

        ]);
        Session::flash('status','Subcategory created successfully');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory=SubCategory::find($id);
        return view('subcategory.show',compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $categories=Category::get(['id','name']);
         $subcategory=SubCategory::find($id);
        return view('subcategory.edit',compact('categories','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'category_id' =>'required|numeric',
            'subcategory_name'=>'required|string',
            'is_active'=>'nullable'
        ]);
        $subcategory=SubCategory::find($id);
        $subcategory->update([
            'category_id' =>$request->category_id,
            'name' =>$request->subcategory_name,
            'slug' =>Str::slug($request->subcategory_name)  ,
            'is_active' =>$request->filled('is_active'),

        ]);
        Session::flash('status','Subcategory update successfully');
        return redirect()->route('subcategory.index');
    }

    public function destroy(string $id)
    {
        // dd($id);
        SubCategory::find($id)->delete();
        Session::flash('status','Subcategory destroy successfully');
        return redirect()->route('subcategory.index');
    }

    function  restore($subcategory_id){
        SubCategory::onlyTashed()->find($subcategory_id)->restore();
        return back();
    }

    function forceDelete($subcategory_id){
        // dd($category_id);
        SubCategory::onlyTrashed()->find($subcategory_id)->forceDelete();

        Session::flash('status','Category deleted permanently');
        return back();
    }
}
