<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

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
        // dd($request->all());
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
            $this->multiple_image_upload($request,$product->id);

            Toastr::success('product store successfully');
            return redirect()->route('products.index');
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
    public function edit(string $slug)
    {
        $product = Product::whereSlug($slug)->first();
        $categories = Category::select(['id','title'])->get();
        return view('backend.pages.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $slug)
    {
        $product = Product::whereSlug($slug)->first();
        $product->update([
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
        $this->multiple_image_upload($request,$product->id);

        Toastr::success('product store successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // $product = Product::whereSlug($slug)->first();
        // if($product->product_image){
        //     // $photo_location = 'uploads/product/'.$product->product_image;
        //     $photo_location = 'uploads/product/'.$product->product_image;
        //     unlink($photo_location);
        // }

        // $product->delete();

        // Toastr::success('product delete successfully');
        // return redirect()->route('products.index');



            // Find the product by slug
    $product = Product::whereSlug($slug)->first();

    // Check if the product exists
    if (!$product) {
        Toastr::error('Product not found');
        return redirect()->route('products.index');
    }

    // Check if the product has an associated image
    if ($product->product_image) {
        $photo_location = 'uploads/product/' . $product->product_image;

        // Check if the file exists before attempting deletion
        if (file_exists($photo_location)) {
            unlink($photo_location);
        } else {
            Toastr::error('Image file not found');
        }
    }

    // Delete the product
    $product->delete();

    Toastr::success('Product deleted successfully');
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
            Image::make($uploaded_photo)->resize(600,622)->save(base_path($new_photo_location),40);
            $check = $product->update([
                'product_image' => $new_photo_name,
            ]);
        }
    }

    function multiple_image_upload($request,$product_id){
        if($request->hasFile('product_multiple_image')){
            $multiple_images = ProductImage::where('product_id',$product_id)->get();
            foreach ($multiple_images as $multiple_image) {
                if($multiple_image->product_multiple_photo_name !='dafault_product.jpg'){
                    $photo_location = 'public/uploads/product';
                    $old_photo_location = $photo_location.$multiple_image->product_multiple_photo_name;
                    unlink(base_path($old_photo_location));
                }
                $multiple_image->delete();
            }
            $flag = 1;  //assing a flag variable

            foreach ($request->file('product_multiple_image') as $single_photo) {
                $photo_location = 'public/uploads/product/';
                $new_photo_name = $product_id.'-'.$flag.'.'.$single_photo->getClientOriginalExtension();
                $new_photo_location = $photo_location.$new_photo_name;
                Image::make($single_photo)->resize(600,622)->save(base_path($new_photo_location),40);
                ProductImage::create([
                    'product_id'=>$product_id,
                    'product_multiple_image'=>$new_photo_name,
                ]);
                $flag++;
            }
        }
    }
}
