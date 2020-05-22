<?php

use XFrames\Utility\Route;

Route::get("/", "HomeController@guest");

Route::get("/home", "HomeController@index");

Route::get("/login", "Authentication\\LoginController@index");
Route::post("/login", "Authentication\\LoginController@store");

Route::get("/register", "Authentication\\RegisterController@index");
Route::post("/register", "Authentication\\RegisterController@store");

Route::post("/logout", "Authentication\\LogoutController@index");

Route::error("HomeController@error");