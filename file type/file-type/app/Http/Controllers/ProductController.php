<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select(['id','name'])->get();
        $subcategories = SubCategory::select(['id','name'])->get();
        // dd($category,$subcategory);
        return view('product.create',compact('categories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
             'category_id'=>'required|numeric',
             'subcategory_id'=>'required|numeric',
             'name'=>'required|string|max:255',
             'price'=>'required|numeric|min:0',
             'description'=>'nullable|string',
            //  'image'=>'bail|required|image|mines:png,jpg,jepg|max:1024',
             'image'=>'bail|required|image|max:1024',
        ]);
        // dd($request->hasFile('image'));
        $file_exits=$request->hasFile('image');
        if($file_exits){
            $file= $request->file('image');
            $file_type=$file->getClientMimeType();
            $file_ext=$file->getClientOriginalExtension();
            $file_ore_name= $file->getClientOriginalName();

            // dd($file,$file_type,$file_ext,$file_ore_name);
            // dump($file->store('image'));
            // dump(Storage::disk('public')->put('image',$file));
            dump(Storage::putFileAs('product_image',$file,'new_product_1'.'.'.$file->getClientOriginalExtension()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
