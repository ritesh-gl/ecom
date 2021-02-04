<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () {
    return view('login');
});

Route::post("/login","UserController@login");
Route::get("/","ProductController@index");