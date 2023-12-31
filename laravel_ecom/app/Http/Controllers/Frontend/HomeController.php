<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function home(){
        $testimonials = Testimonial::where('is_active',1)->latest('id')->limit(3)->select(['id','client_name','client_designation','client_message','client_image'])->get();

        $categories = Category::where('is_active',1)->latest('id')->limit(5)->select(['id','title','category_image','slug'])->get();

        $products = Product::where('is_active',1)->latest('id')->select('id','name','slug','product_image','product_price','product_stock','product_rating')->paginate(6);

        return view('frontend.pages.home',compact('testimonials','categories','products'));
    }


    function shopPage(){
        $allProducts = Product::where('is_active',1)->latest('id')
        ->select('id','name','slug','product_image','product_price','product_stock','product_rating')
        ->paginate(4);

        $categories = Category::where('is_active',1)
        ->with('products')->
        latest('id')->limit(5)->select(['id','title','slug'])->get();

        return view('frontend.pages.shop',compact('allProducts','categories'));
    }


    function productDetails($product_slug){
        $product = Product::whereSlug($product_slug)->with('category','productImages')->first();

        $related_products = Product::whereNot('slug',$product->slug)->select('id','name','slug','product_price','product_image')->limit(4)->get();
        return view('frontend.pages.single-product',compact('product','related_products'));
    }
}
