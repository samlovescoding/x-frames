<?php

use XFrames\Utility\{ Collection, Request, Str };

function collect($array = []){
    return (new Collection)->setArray($array);
}

function str($data){
    return resolve(Str::class)->set($data);
}

function request(){
    return resolve(Request::class);
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