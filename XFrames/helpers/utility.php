<?php

use XFrames\Library\Validator;
use XFrames\Utility\{ Collection, Request, Session, Str };

function collect($array = []){
    return (new Collection)->setArray($array);
}

function str($data){
    return resolve(Str::class)->set($data);
}

function request(){
    return resolve(Request::class);
}

function validate(){

    return resolve(Validator::class);
    
}

function session(){
    return resolve(Session::class);
}

function getClassesUnderNamespace($namespace){
    return collect(get_declared_classes())->filter(function($className) use($namespace){
        return str($className)->startsWith($namespace);
    })->all();
}

function dd($data = null){
    var_dump($data);
    die();
}