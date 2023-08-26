<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CategoryCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::get(['name','updated_at','id']);
        $delCategories=Category::onlyTrashed()->withCount('subcategories')->get(['id','name','created_at']);
        return view('category.index', compact('categories','delCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'category_name' =>'required|string',  //category_name from input
            // 'category_slug' =>'required|string',
            'is_active' =>'nullable',
        ]);
      $category = Category::create([
            'name' => $request->category_name,
            'slug' =>Str::slug($request->category_name),
            'is_active'=>$request->filled('is_active')
        ]);


        //mail send command
        $user = User::find(1);
        Mail::to($user)->send(
            new CategoryCreated($category)
        );
        Session::flash('status','Category created successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories=Category::find($id);
        return view('category.show',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Category::find($id);

        return view('category.edit',compact('categories'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' =>'required|string',
            'is_active' =>'nullable',
        ]);
        $categories=Category::find($id);
        $categories->update([
            'name' => $request->category_name,
            'slug' =>Str::slug($request->category_name),
            'is_active'=>$request->filled('is_active')
        ]);
        Session::flash('status','Category update successfully');
        return redirect()->route('category.index');
    }


    public function destroy(string $id)
    {
        Category::find($id)->delete();
        Session::flash('status','Category destroy successfully');
        return redirect()->route('category.index');
    }

    function restore($category_id){
        // dd($category_id);
        Category::onlyTrashed()->find($category_id)->restore();

        Session::flash('status','Category restore successfully');
        return back();
    }



    function forceDelete($category_id){
        // dd($category_id);
        Category::onlyTrashed()->find($category_id)->forceDelete();

        Session::flash('status','Category deleted permanently');
        return back();
    }
}
