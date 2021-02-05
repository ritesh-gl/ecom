<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});

Route::post("/login","UserController@login");
Route::get("/","ProductController@index");
Route::get("detail/{id}","ProductController@detail");
Route::get("search","ProductController@search");
Route::post("add_to_cart","ProductController@addToCart");
Route::get("cartList","ProductController@cartList");
Route::get("removeCart/{id}","ProductController@removeCart");

Route::get("orderNow","ProductController@orderNow");
