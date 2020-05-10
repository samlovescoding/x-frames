<?php

use XFrames\Library\ServiceContainer;

function app(){
    global $_APP;
    if(!isset($_APP)){
        $_APP = new ServiceContainer;
    }
    return $_APP;
}

function resolve($resolvable){
    return app()->resolve($resolvable);
}

function bind($resolvable, $to){
    return app()->bind($resolvable, $to);
}

function singleton($resolvable){
    return app()->singleton($resolvable, $resolvable);
}