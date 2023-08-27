<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerifyTokenMiddleware;




Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([TokenVerifyTokenMiddleware::class]);
//user profile method
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([TokenVerifyTokenMiddleware::class]);

// Page Routes
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage']);

Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerifyTokenMiddleware::class]);
//user profile page
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerifyTokenMiddleware::class])->name('user.Profile');

// User Logout
Route::get('/logout',[UserController::class,'UserLogout']);



// Customer API
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware([TokenVerifyTokenMiddleware::class]);


// Category API
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware([TokenVerifyTokenMiddleware::class]);


// Product API
Route::post("/create-product",[ProductController::class,'CreateProduct'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post("/delete-product",[ProductController::class,'DeleteProduct'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::post("/update-product",[ProductController::class,'UpdateProduct'])->middleware([TokenVerifyTokenMiddleware::class]);
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware([TokenVerifyTokenMiddleware::class]);












