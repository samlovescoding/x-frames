<?php

use XFrames\Utility\Action;

require "../vendor/autoload.php";

class Hello{
    public function world(){
        echo "Hello World from Hello@world";
    }
    static public function universe(){
        echo "Hello Universe from Hello::universe";
    }
}

function hello_world(){
    echo "Hello World from hello_world";
}

Action::fromString("Hello@universe")->run();