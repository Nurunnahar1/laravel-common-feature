<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->select(['id','title','slug','updated_at'])->paginate(5);
        // return $categories;
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title'=>'required|string|max:255|unique:categories,title',

        ]);

        Category::create([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
        ]);
        // return back()->with('success','Category created successfully');
        Toastr::success('Category created successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        // $category = Category::findOrFail($id);  //if work with id
        // $category = Category::where( 'slug',$id)->first();
        $category = Category::whereSlug($slug)->first();
        // return $category;
        return view('backend.pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title'=>'required|string|max:255',

        ]);
        $category = Category::whereSlug($slug)->first();

        $category->update([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'is_active'=>$request->filled('is_active')
        ]);
        // return back()->with('success','Category created successfully');
        Toastr::success('Category update successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $category = Category::whereSlug($slug)->first()->delete();
        Toastr::success('Category delete successfully');
        return redirect()->route('category.index');
    }
}