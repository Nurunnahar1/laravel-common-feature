<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\District;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Mail\PurchaseConfirm;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreOrderRequest;
use Gloudemans\Shoppingcart\Facades\Cart;


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

    function placeOrder(StoreOrderRequest $request){
        // dd($request->all());
        $billing = Billing::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'order_notes' => $request->order_notes,
        ]);

            // Order Table data insert
            $order = Order::create([
                'user_id' => Auth::id(),
                'billing_id' => $billing->id,
                // 'sub_total' => Session::get('coupon')['cart_total'] ?? Cart::subtotal(),
                // 'sub_total' => number_format(Session::get('coupon')['cart_total'] ?? Cart::subtotal(), 2, '.', ''),
                'sub_total' => number_format(floatval(Session::get('coupon')['cart_total'] ?? Cart::subtotal()), 2, '.', ''),


                'discount_amount' => Session::get('coupon')['discount_amount'] ?? 0,
                'coupon_name' => Session::get('coupon')['name'] ?? '',
                // 'total' => Session::get('coupon')['balance'] ?? Cart::subtotal(),
                'total' =>number_format(floatval(Session::get('coupon')['balance'] ?? Cart::subtotal()), 2, '.', '')
            ]);


             //Order details table data insert using cart_items helpers
            foreach (Cart::content() as $cart_item) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'user_id' => Auth::id(),
                    'product_id' => $cart_item->id,
                    'product_qty' => $cart_item->qty,
                    'product_price' => $cart_item->price,
                ]);

                // Update product table with decrement quantity
                Product::findOrFail($cart_item->id)->decrement('product_stock', $cart_item->qty);
            }
            // forceDelete from cart table
            Cart::destroy();
            Session::forget('coupon');


            //Noew get order with details information to send mail
            $order =  Order::whereId($order->id)->with(['billing', 'orderdetails'])->get();

            //Now Send Mail
            Mail::to($request->email)->send(new PurchaseConfirm($order));


        Toastr::success('Your order placed successfully!!!','success');
        return redirect()->route('cart.page');
    }
}
