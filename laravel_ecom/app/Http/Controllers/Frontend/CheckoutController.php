<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Upazila;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function checkoutPage(){
        $carts = Cart::content();
        $total_price = Cart::subtotal();
        $districts = District::select('id','bn_name','name')->get();
        return view('frontend.pages.checkout',compact('carts','total_price','districts'));


    }

    function loadUpazillaAjax($district_id){
        $upazilas = Upazila::where('district_id', $district_id)->select('id','name')->get();
        return response()->json($upazilas,200);
    }

    function placeOrder(Request $request){
        dd($request->all());
    }
}
