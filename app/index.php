<?php

use XFrames\Utility\Str;

require "../vendor/autoload.php";

echo str("please_convert_this_to_camel")->camelCase();

echo " ";

echo str("pleaseConvertThisToSnake")->snakeCase();

class ComponentHelper{
    public static function __callStatic($name, $parameters){
        return resolve("XFrames\\Components\\" . ucfirst($name));
    }
}

function component(){
    return resolve(ComponentHelper::class);
}

singleton(ComponentHelper::class);

echo component()::fragment();