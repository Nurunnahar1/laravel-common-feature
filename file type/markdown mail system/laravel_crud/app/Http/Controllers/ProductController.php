<?php

namespace App\Http\Controllers;

use GdImage;
use App\Models\Product;
use App\Models\Category;

use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProductRequest;

// use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use Intervention\Image\Facades\Image;

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
                                        // // dd($request->hasFile('image'));
                                        // $file_exits=$request->hasFile('image');
                                        // if($file_exits){
                                        //     $file= $request->file('image');
                                        //     $file_type=$file->getClientMimeType();
                                        //     $file_ext=$file->getClientOriginalExtension();
                                        //     $file_ore_name= $file->getClientOriginalName();

                                        //     // dd($file,$file_type,$file_ext,$file_ore_name);
                                        //     // dump($file->store('image'));
                                        //     // dump(Storage::disk('public')->put('image',$file));
                                        //     // dump(Storage::putFileAs('product_image',$file,'new_product_1'.'.'.$file->getClientOriginalExtension()));

                                        //     $product_image1= $file->storeAs('product_image','new_product_1'.'.'.$file->getClientOriginalExtension());


                                        //     dump(Storage::url($product_image1));
                                        // }



        // dd($request->all());
        $product = Product::create([
            'category_id' =>$request->category_id,
            'subcategory_id' =>$request->subcategory_id,
            'name' =>$request->name,
            'slug' =>Str::slug($request->slug),
            'price' =>$request->price,
            'description' =>$request->description,

        ]);
        $this->image_upload($request, $product->id);
        return back();
    }


    public function image_upload($request , $product_id){
        if($request->hasFile('image')){
            $photo_location = 'public/uploads/product-images/';
            $uploaded_photo =  $request->file('image');
            $photo_name = $product_id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location.$photo_name; //public/uploads/product-images/1.jpg
            Image::make($uploaded_photo)->resize(600,600)->save(base_path($new_photo_location));



            //upload the product image field

            $product =  Product::find($product_id);
            $product->update([
                'image'=>$photo_name
            ]);


        }
        else{
            return back();
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
