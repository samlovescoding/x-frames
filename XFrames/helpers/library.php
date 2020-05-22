<?php

use XFrames\Library\Configuration;
use XFrames\Library\View;

function config($className = null){
    if($className == null){
        return resolve(Configuration::class);
    }
    return resolve(Configuration::class)->{$className}();
}

function view($file, $viewParams = []){
    return (new View($file, $viewParams));
}

function redirect($to){
    header("Location:" . $to);
}