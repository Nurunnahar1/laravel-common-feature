@extends('frontend.layouts.master')
@section('frontend-title') Customer Dashboard Page @endsection
@section('frontend-content')
    @include('frontend.layouts.inc.breadcumb', ['pagename' => 'Customer Dashboard'])
    <div class="checkout-area ptb-100">
        <div class="container">
            <form action="{{ route('customer.placeorder') }}" method="POST">
                <div class="row">
                    @csrf
                    <div class="col-lg-8">
                        <div class="checkout-form form-style">
                            <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <p>Full Name *</p>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <p>Email Address *</p>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <p>Phone No. *</p>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-12 mb-3">
                                        <p>District *</p>
                                        <select id="district_id" name="district_id" class="form-select js-example-basic-single">
                                            <option value="0">Select a district</option>
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12 mb-3">
                                        <p>Town/Upazila *</p>
                                        <select id="upazila_id" name="upazila_id" class="form-select js-example-basic-single">
                                            <option value="">Select a Upazila</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p>Your Address *</p>
                                        <input type="text" name="address" placeholder="Enter Your Address">
                                    </div>

                                    <div class="col-12">
                                        <p>Order Notes </p>
                                        <textarea name="order_note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                @foreach ($carts as $item)
                                <li>{{ $item->name }} X {{ $item->qty }} <span class="pull-right">৳ {{ $item->price*$item->qty }}</span></li>
                                @endforeach

                                @if (Session::has('coupon'))
                                    <li>Discount <span class="pull-right"><strong> (-) ৳ {{ Session::get('coupon')['discount_amount'] }}</strong></span></li>
                                    <li>Total<span class="pull-right">৳ {{ Session::get('coupon')['balance'] }} <del class="text-danger">৳ {{ Session::get('coupon')['cart_total'] }}</del></span></li>
                                @else
                                    <li>Subtotal <span class="pull-right"><strong>৳ {{ $total_price }}</strong></span></li>
                                    <li>Total<span class="pull-right">৳ {{ $total_price }}</span></li>
                                @endif
                            </ul>
                            <ul class="payment-method">
                                <li>
                                    <input id="delivery" type="checkbox">
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <button>Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
