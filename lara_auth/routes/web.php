<?php

use App\Http\Controllers\CustomAuth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register',[RegisterController::class,'registerFormShow'])->name('register');
Route::post('/register',[RegisterController::class,'registerUser'])->name('register.store');
Route::post('/logout',[RegisterController::class,'logout'])->name('logout');



Route::get('/login',[LoginController::class,'loginFormShow'])->name('login');
Route::post('/login',[LoginController::class,'loginUser'])->name('login.store');

