<?php

use XFrames\Library\Authentication;
use XFrames\Utility\Route;

Route::get("/", "HomeController@welcome")->name("home");

Route::get("/dashboard", "HomeController@dashboard");

Route::get("/users/:id", "HomeController@user");

// Authentication Routes
Route::get("/logout", "Authentication\\LogoutController@handle");
Route::get("/login", "Authentication\\LoginController@form");
Route::post("/login", "Authentication\\LoginController@handle");
Route::get("/register", "Authentication\\RegisterController@form");
Route::post("/register", "Authentication\\RegisterController@handle");

// Error Handling Routes
Route::error("ErrorController@fileNotFound");
Authentication::setUnauthorizedRoute("/unauthorized");
Route::get("/unauthorized", "ErrorController@unauthorizedAction");
