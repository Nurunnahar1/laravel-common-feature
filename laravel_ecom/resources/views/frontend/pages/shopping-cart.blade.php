@extends('frontend.layouts.master')
@section('frontend-title')
    Cart Page
@endsection
@section('frontend-content')
    @include('frontend.layouts.inc.breadcumb', ['pagename' => 'Cart'])

    {{-- cart-arta-start --}}
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="http://themepresss.com/tf/html/tohoney/cart">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <pre>
                                @php

                                    print_r($carts)

                                @endphp
                                </pre> --}}
                                @foreach ($carts as $cartitem)
                                    <tr>
                                        <td class="images"><img
                                                src="{{ asset('uploads/product') }}/{{ $cartitem->options->product_image }}"
                                                alt=""></td>
                                        <td class="product"><a href="single-product.html">{{ $cartitem->name }}</a>
                                        </td>
                                        <td class="ptice">৳{{ $cartitem->price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" value="{{ $cartitem->qty }}">
                                            <div class="dec qtybutton">-</div>
                                            <div class="inc qtybutton">+</div>
                                        </td>
                                        <td class="total">৳{{ $cartitem->price * $cartitem->qty }}</td>
                                        <td class="remove">

                                            <a href="{{ route('removefrom.cart', ['cart_id' => $cartitem->rowId]) }}">
                                                <i class="fa fa-times"></i>
                                            </a>

                                            {{-- <a href="{{ route('removefrom.cart',  $cartitem->rowId) }}">
                                                <i class="fa fa-times"></i>
                                            </a> --}}

                                            {{-- <a href="{{ url('/remove-from-cart/'. $cartitem->rowId) }}">
                                                <i class="fa fa-times"></i>
                                            </a> --}}





                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        {{-- <li>
                                            <button>Update Cart</button>
                                        </li> --}}
                                        <li><a href="{{ route('shop.page') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <form action="{{ route('customer.couponapply') }}" method="post">
                                            @csrf
                                            <input type="text" name="coupon_name" placeholder="Cupon Code" class="form-control">
                                            <button type="submit" class="btn btn-danger">Apply Coupon</button>
                                            {{-- <a href="{{ route('customer.couponapply') }}" class="btn btn-danger">Apply Coupon</a> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>

                                    <p>
                                        @if (Session::has('coupon'))
                                            <a class="p-1" href="{{ route('customer.cuponremove', 'coupon_name') }}"><i
                                                    class="fa fa-times"></i></a>
                                            <b>{{ Session::get('coupon')['name'] }}</b> is Applied
                                        @endif

                                    </p>




                                    <ul>

                                        @if (Session::has('coupon'))
                                            <li><span class="pull-left">Discount Amount:
                                                </span>৳{{ Session::get('coupon')['discount_amount'] }}</li>
                                            <li><span class="pull-left">Total: </span>৳
                                                {{ Session::get('coupon')['balance'] }} <del class="text-danger">৳
                                                    {{ Session::get('coupon')['cart_total'] }}</del></li>
                                        @else
                                            <li><span class="pull-left">Subtotal: </span>${{ $total_price }}</li>
                                            <li><span class="pull-left"> Total: </span> ${{ $total_price }}</li>
                                        @endif
                                    </ul>
                                    <a href="{{ route('customer.checkoutPage') }}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- cart-arta-end --}}
@endsection
