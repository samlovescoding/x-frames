<?php

use XFrames\Blueprints\RouteParam;
use XFrames\Library\Router;
use XFrames\Utility\Route;

require "../vendor/autoload.php";

class Hello{
    public function world($id){
        
        echo "$id from Hello@world";

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

Route::get("/", "root");

Route::get("/hi/:id/edit", "Hello@world");

Route::error("some_error");

echo "<form method='post'><button name='hello' value='world'>Click Me</button></form>";
 
$router = new Router(false);

$router->dispatch();