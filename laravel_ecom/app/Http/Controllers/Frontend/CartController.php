<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Cupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        // // dd($cart_id);
        Cart::remove($cart_id);
        Toastr::info('Product removed from cart successfully');
        return back();
        // return $cart_id;
    }


    public function couponApply(Request $request)
    {

        if(!Auth::check()){
            Toastr::error('You must need to login first!!!');
            return redirect()->route('login.page');
        }

        //dd($request->all());
        $check = Cupon::where('coupon_name', $request->coupon_name)->first();

        // dd($check);
        // check coupon validity

        //if session got existing coupon, then don't allow double coupon
        if(Session::get('coupon')){
            Toastr::error('Already applied coupon!!!', 'Info!!!');
            return redirect()->back();
        }

        //if valid coupon found
        if($check !=null){
            // Check coupon validity
            $check_validity =  $check->validity_till > Carbon::now()->format('Y-m-d');
            // if coupon date is not expried
            if($check_validity){
               // check coupon discount type
                Session::put('coupon', [
                    'name' => $check->coupon_name,
                    'discount_amount' => round((Cart::subtotalFloat() * $check->discount_amount)/100),
                    'cart_total' => Cart::subtotalFloat(),
                    'balance' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $check->discount_amount)/100)
                ]);
                Toastr::success('Coupon Percentage Applied!!', 'Successfully!!');
                return redirect()->back();
            }else{
                Toastr::error('Coupon Date Expire!!!', 'Info!!!');
                return redirect()->back();
            }
        }else{
            Toastr::error('Invalid Action/Coupon! Check, Empty Cart');
            return redirect()->back();
        }
    }

    function removeCupon($coupon_name){
        Session::forget('coupon');
        Toastr::success('Coupon Removed!!', 'Successfully !!');
        return redirect()->back();
    }

}
