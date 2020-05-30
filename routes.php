<?php

use XFrames\Library\Authentication;
use XFrames\Utility\Route;

Authentication::setUnauthorizedRoute("/login");

Route::get("/dashboard", "HomeController@dashboard");
Route::get("/unauthorized", "HomeController@unauthorized");
Route::error("HomeController@error");

// Authentication Routes
Route::get("/logout", "Authentication\\LogoutController@handle");
Route::get("/login", "Authentication\\LoginController@form");
Route::post("/login", "Authentication\\LoginController@handle");
Route::get("/register", "Authentication\\RegisterController@form");
Route::post("/register", "Authentication\\RegisterController@handle");

// ArticleController Routes
Route::get("/", "ArticleController@index");
Route::get("/articles/create", "ArticleController@create");
Route::post("/articles/create", "ArticleController@store");
Route::get("/articles/:article", "ArticleController@view");
Route::get("/articles/:article/edit", "ArticleController@edit");
Route::post("/articles/:article/edit", "ArticleController@update");
Route::get("/articles/:article/delete", "ArticleController@destroy");
