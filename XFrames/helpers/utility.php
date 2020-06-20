<?php

use XFrames\Library\Validator;
use XFrames\Utility\{ Collection, Request, Session, Str, Redirector };
use XFrames\Exceptions\UnknownAction;
use XFrames\Exceptions\UnknownMiddleware;

function collect($array = []){

    return (new Collection)->setArray($array);

}

function str($data = ""){

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

function d($data = null){
    return var_dump($data);
    if(is_object($data)){
        foreach($data as $key => $value) {
            echo "$key => " . d($value) . "\n";
        }
    }else{
        var_dump($data);
    }
}

function dd($data = null){
    d($data);
    die();

}

function action($method, $parameters = []){

    global $_ROUTES;

    $className = null;
    $actionString = "";

    if(is_array($method)){
        $className = $method[0];
        $method = $method[1];
    }

    if($className == null){
        $actionString = $method;
    }else{
        $actionString = $className . "@" . $method;
    }

    $actionString = config("system")->getControllerNamespace() . $actionString;

    foreach ($_ROUTES as $routeMethods){

        if(is_array($routeMethods)){

            foreach ($routeMethods as $route => $routeAction){

                if($routeAction->toString() == $actionString){

                    $route = routeWithParameters($route, $parameters);

                    $parameters = collect($parameters)
                        ->map(function($index, $value){
                            return "$index=$value";
                        })
                        ->join("&")
                        ->get();

                    if($parameters == "") {
                        return $route;
                    }else{
                        return $route . "?" . $parameters;
                    }

                }

            }

        }

    }

    throw new UnknownAction("Action '$actionString' was not found in the defined routes.");

}

function routeWithParameters($route, &$parameters){
    return str($route)
        ->split("/")
        ->flatMap(function($index, $value) use(&$parameters){
            if(str($value)->startsWith(":")){

                $valueParameter = substr($value, 1);

                if(in_array($valueParameter, array_keys($parameters))){

                    $return = [$index => $parameters[$valueParameter]];

                    unset($parameters[$valueParameter]);

                    return $return;

                }

            }

            return [$index => $value];
        })
        ->join("/")
        ->get();
}

function route($name, $parameters = []){
    global $_ROUTES;
    foreach ($_ROUTES as $routeMethods){
        if(is_array($routeMethods)){
            foreach ($routeMethods as $route => $routeAction){
                if($routeAction->getName() == $name){
                    return $route;
                }
            }
        }
    }
    throw new UnknownAction("Route name '$name' was not found in the defined routes.");
}


function redirect($to = null){

    if($to == null){
        return resolve(Redirector::class);
    }
    
    return resolve(Redirector::class)->redirect($to);

}

function resolveMiddleware($middleware){
    if(!class_exists($middleware)){
        $middleware = config("middlewares")->getMap()[$middleware];
    }
    
    if(!class_exists($middleware)){
        throw new UnknownMiddleware("This route depends upon an unknown middleware '$middleware'.");
    }
    return resolve($middleware);
}