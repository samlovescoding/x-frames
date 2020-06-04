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

function make($resolvable){

    return resolve($resolvable);

}

function bind($resolvable, $to){

    return app()->bind($resolvable, $to);

}

function singleton($resolvable){

    return app()->singleton($resolvable, $resolvable);

}

function bindAndResolve($resolvable, $to){

    bind($resolvable, $to);

    return resolve($resolvable);

}

function singletonAndResolve($resolvable){

    singleton($resolvable);

    return resolve($resolvable);

}

function run($resolvable){

    return resolve($resolvable)->run();

}