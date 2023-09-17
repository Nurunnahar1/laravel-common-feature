<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    function cartPage(){

     $carts= Cart::content();
     $total_price= Cart::subtotal();

    //    return $carts;
        return view('frontend.pages.shopping-cart',compact('carts','total_price'));
    }

    function addToCart(Request $request){
        // dd($request->all());
        $product_slug = $request->product_slug;
        $order_qty = $request->order_qty;
        $product = Product::whereSlug($product_slug)->first();

        Cart::add([
            'id' => $product->id,
            'qty' => $order_qty,
            'name' => $product->name,
            'price' => $product->product_price,
            'weight' =>0,
            'product_stock'=>$product->product_stock,
            'options'=>[
                'product_image'=>$product->product_image
            ]
        ]);

        Toastr::success('Product added successfully');
        return back();
    }

    function removeFromCart($cart_id){
        dd($cart_id);
        Cart::remove($cart_id);
        Toastr::info('Product removed from cart successfully');
        return back();
    }

}
