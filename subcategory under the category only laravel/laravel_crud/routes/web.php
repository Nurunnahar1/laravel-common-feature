<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;



Route::resource('/category',CategoryController::class);
Route::resource('/subcategory',SubCategoryController::class);
