<?php

use XFrames\Cache\Cache;
use XFrames\Library\Authentication;
use XFrames\Library\Configuration;
use XFrames\Library\Emitter;
use XFrames\Library\View;

singleton(View::class);

function config($className = null){

    if($className == null){

        return resolve(Configuration::class);

    }

    return resolve(Configuration::class)->{$className}();

}

function view($file, $parameters = []){

    return resolve(View::class)
            ->setFile($file)
            ->setParameters($parameters);

}

function import($file){

    return resolve(View::class)->import($file);

}

function layout($file){

    $view = resolve(View::class)->setLayout($file);

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

function cache($name, $timeout, $callback = null){

    if(is_callable($timeout)){

        $callback = $timeout;

        $timeout = null;

    }

    $cache = resolve(Cache::class);

    if($cache->valid($name)){

        return $cache->get($name);

    } else {

        $value = $callback();

        $cache->set($name, $value, $timeout);

        return $value;

    }

}