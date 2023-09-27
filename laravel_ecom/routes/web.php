<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CuponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\Auth\RegisterController;

// Route::get('/', function () {
//     return view('frontend.pages.home');
// });

Route::prefix('')->group(function(){
    Route::get('/', [HomeController::class,'home'])->name('home');
    Route::get('/shop', [HomeController::class,'shopPage'])->name('shop.page');
    Route::get('/single-product/{product_slug}', [HomeController::class,'productDetails'])->name('productdetails.page');
    Route::get('/shopping-cart',[CartController::class,'cartPage'])->name('cart.page');
    Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('add-to.cart');
    // Route::get('/add-to-cart/{product_slug}',[CartController::class,'addToCart'])->name('add-to.cart');
    Route::get('/remove-from-cart/{cart_id}', [CartController::class, 'removeFromCart'])->name('removefrom.cart');



    //Authorization routes for Customer/Guest
    Route::get('/register',[RegisterController::class,'registerPage'])->name('register.page');
    Route::post('/register',[RegisterController::class,'registerStore'])->name('register.store');
    Route::get('/login',[RegisterController::class,'loginPage'])->name('login.page');
    Route::post('/login',[RegisterController::class,'loginStore'])->name('login.store');


    /* AJAX CALL  */
    Route::get('/upzilla/ajax/{district_id}', [CheckoutController::class, 'loadUpazillaAjax'])->name('loadupazila.ajax');

    Route::prefix('customer/')->middleware(['auth','is_customer'])->group(function(){
        Route::get('dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');
        Route::get('logout',[RegisterController::class,'logout'])->name('customer.logout');

        /*Coupon apply & remove */
        Route::get('cart/apply-coupon', [CartController::class, 'couponApply'])->name('customer.couponapply');
        Route::get('cart/remove-coupon/{coupon_name}', [CartController::class, 'removeCoupon'])->name('customer.couponremove');

        /*Checkout page */
        Route::get('checkout', [CheckoutController::class, 'checkoutPage'])->name('customer.checkoutPage');
        Route::post('placeorder', [CheckoutController::class, 'placeorder'])->name('customer.placeorder');



        Route::get('email', function(){
            $order = Order::whereId(1)->with(['billing', 'orderdetails'])->get();
            return view('frontend.mail.purchaseconfirm', [
                'order_details' => $order
            ]);
        });


    });
});

//============ Admin Auth route==============
Route::prefix('admin/')->group(function(){
    Route::get('login',[LoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('login',[LoginController::class, 'login'])->name('admin.login');


    Route::middleware(['auth','is_admin'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
    //  Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');


    //======Resource Controller======
    Route::resource('category', CategoryController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('products', ProductController::class);
    Route::resource('cupon', CuponController::class);

});
