<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/logout', function () {
    Session::forget('user');
    Session::forget('pgn');
    
    return redirect('login');
});
//Route::view('/register','register');
Route::post("/login","UserController@login");
Route::post("/register","UserController@register");

Route::get("/","ProductController@index");
Route::get("detail/{id}","ProductController@detail");
Route::get("search","ProductController@search");
Route::post("add_to_cart","ProductController@addToCart");
Route::get("cartList","ProductController@cartList");
Route::get("removeCart/{id}","ProductController@removeCart");

Route::get("orderNow","ProductController@orderNow");
Route::post("orderPlace","ProductController@orderPlace");
Route::get("myOrders","ProductController@myOrders");
Route::get("products","ProductController@allProduct");
Route::get("productCat","ProductController@proCat");
Route::post("buyNow","ProductController@buyNow");
Route::post("buyPlace","ProductController@buyPlace");
