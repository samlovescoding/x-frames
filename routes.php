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

// Articles

Route::get("/blog", "ArticleController@index");
Route::get("/blog/create", "ArticleController@create");
Route::post("/blog/create", "ArticleController@store");
Route::get("/blog/:article", "ArticleController@view");
Route::get("/blog/:article/edit", "ArticleController@edit");
Route::post("/blog/:article/edit", "ArticleController@update");
Route::get("/blog/:article/delete", "ArticleController@destroy");

