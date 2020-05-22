<?php

use XFrames\Library\Configuration;

function config($className = null){
    if($className == null){
        return resolve(Configuration::class);
    }
    return resolve(Configuration::class)->{$className}();
}