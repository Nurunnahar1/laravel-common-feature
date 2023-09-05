<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\HomeController;

// Route::get('/', function () {
//     return view('frontend.pages.home');
// });

Route::prefix('')->group(function(){
    Route::get('/', [HomeController::class,'home'])->name('home');
});

//============ Admin Auth route==============
Route::prefix('admin/')->group(function(){
    Route::get('login',[LoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('login',[LoginController::class, 'login'])->name('admin.login');
    Route::get('logout',[LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    });
    //  Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');


    //======Resource Controller======
    Route::resource('category', CategoryController::class);
    Route::resource('testimonial', TestimonialController::class);

});
