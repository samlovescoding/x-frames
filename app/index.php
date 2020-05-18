<?php

use XFrames\Blueprints\RouteParam;
use XFrames\Library\Router;
use XFrames\Utility\Route;
use XFrames\Utility\Str;

require "../vendor/autoload.php";

class Hello{
    public function world(Str $id){
        
        echo "$id from Hello@world";

    }
    public function edit(Str $id){
        echo "Edited " . $id;
    }
    static public function universe(){
        echo "Hello Universe from Hello::universe";
    }
}

function root(){
    echo "Root";
}

function some_error(){
    echo "404 File Not Found";
}

function anything(Str $anything){
    echo $anything;
}

Route::get("/", "root");

Route::get("/hi/:id/edit", "Hello@world");

Route::post("/hi/:id/edit", "Hello@edit");

Route::get("/:anything", "anything");

Route::error("some_error");
 
new Router;