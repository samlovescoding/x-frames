<?php

use XFrames\Library\Authentication;
use XFrames\Utility\Route;

Authentication::setUnauthorizedRoute("/login");

//Route::get("/", "HomeController@welcome");
Route::get("/dashboard", "HomeController@dashboard");
Route::error("HomeController@error");

// Authentication Routes
Route::get("/logout", "Authentication\\LogoutController@handle");
Route::get("/login", "Authentication\\LoginController@form");
Route::post("/login", "Authentication\\LoginController@handle");
Route::get("/register", "Authentication\\RegisterController@form");
Route::post("/register", "Authentication\\RegisterController@handle");

Route::get("/", "TestController@form");
Route::post("/", "TestController@handle");