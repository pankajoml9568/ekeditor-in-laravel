<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('manage-menus/{id?}',[MenuController::class,'index']);
Route::post('create-menu',[MenuController::class,'store']);

Route::get('ckeditor',[MenuController::class,'ckeditor']);

