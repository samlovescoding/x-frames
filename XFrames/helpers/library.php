<?php

use XFrames\Library\Authentication;
use XFrames\Library\Configuration;
use XFrames\Library\Emitter;
use XFrames\Library\View;

function config($className = null){

    if($className == null){

        return resolve(Configuration::class);

    }

    return resolve(Configuration::class)->{$className}();

}

function component($component){

    return resolve(config("system")->getComponentNamespace() . $component);

}

function view($file, $parameters = []){

    return resolve(View::class)
            ->setFile($file)
            ->setParameters($parameters)
            ->render();

}

function import($file){

    return resolve(View::class)->import($file);

}

function layout($file){

    resolve(View::class)->setLayout($file);

}

function content(){

    resolve(View::class)->renderContent();

}

function redirect($to){

    header("Location:" . $to);

}

function emit($event, $data = null){

    if(is_string($event)){

        $event = resolve($event);

    }

    return resolve(Emitter::class)->emit($event, $data);

}

function auth(){

    return resolve(Authentication::class);

}