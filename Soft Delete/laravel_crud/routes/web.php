<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;



Route::resource('/category',CategoryController::class);
Route::resource('/subcategory',SubCategoryController::class);
Route::get('/category/{category_id}/restore',[CategoryController::class,'restore'])->name('category.restore');
Route::post('/category/{category_id}/forceDelete',[CategoryController::class,'forceDelete'])->name('category.forceDelete');


Route::get('/subcategory/{subcategory_id}/restore',[SubCategoryController::class,'restore'])->name('subcategory.restore');
Route::post('/subcategory/{subcategory_id}/forceDelete',[SubCategoryController::class,'forceDelete'])->name('subcategory.forceDelete');
