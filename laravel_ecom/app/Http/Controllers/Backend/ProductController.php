<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('is_active',1)->with('category')->latest('id')
        ->select('id','category_id','name','slug','product_price','product_stock','alert_quantity','product_image','product_rating','updated_at')->paginate(15);
        // return $products;
        return view('backend.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select(['id','title'])->get();
        return view('backend.pages.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

            $product = Product::create([
                'category_id'=>$request->category_id ,
                'name'=>$request->name,
                'slug'=>Str::slug($request->name)  ,
                'product_code'=>$request->product_code  ,
                'product_price'=>$request->product_price ,
                'product_stock'=>$request->product_stock ,
                'alert_quantity'=>$request->alert_quantity ,
                'short_description'=>$request->short_description ,
                'long_description'=>$request->long_description ,
                'additional_info'=>$request->additional_info ,
            ]);

            $this->image_upload($request, $product->id);
            Toastr::success('product store successfully');
            return redirect()->route('products.index');
    }

    function image_upload($request, $item_id){
        $product = Product::findorFail($item_id);

        if($request->hasFile('product_image')){
            // dd($request->all());
            if($product->product_image !='dafault_product.jpg'){
                $photo_location = 'public/uploads/product/';
                $old_photo_location = $photo_location.$product->product_image;
                unlink(base_path($old_photo_location));

            }
            $photo_location = 'public/uploads/product/';
            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $product->id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location.$new_photo_name;
            Image::make($uploaded_photo)->resize(105,105)->save(base_path($new_photo_location),40);
            $check = $product->update([
                'product_image' => $new_photo_name,
            ]);
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
