<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreCuponRequest;
use App\Http\Requests\UpdateCuponRequest;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Cupon::latest('id')->paginate(10);
        return view('backend.pages.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCuponRequest $request)
    {
        // dd($request->all());
        Cupon::create([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_till'=>$request->validity_till
        ]);

        Toastr::success('Coupon create successfully');
        return redirect()->route('cupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coupon = Cupon::find($id);
        return view('backend.pages.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCuponRequest $request,$id)
    {
        // dd($request->all());
        $coupon = Cupon::find($id);
        $coupon->update([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_till'=>$request->validity_till,
            'is_active'=>$request->filled('is_active'),
        ]);

        Toastr::success('coupon Update Successfull');
        return redirect()->route('cupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Cupon::find($id)->delete();
        Toastr::success('coupon Delete Successfull');
        return redirect()->route('cupon.index');
    }
}
