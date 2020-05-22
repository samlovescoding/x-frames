<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class System{

    use ConfigurationMapper;

    protected $config = [
        
        /*
         *
         * Base URL
         * 
         * It defines the base url to use for generating 
         * hyper-links.
         * 
         */
        "baseURL" => "http://localhost:8008/",

        /*
         *
         * Controller Namespace
         * 
         * It defines the namespace used for controllers. It
         * is required by the router to prefix all routes.
         * Please note the trailling backslashes.
         * 
         */
        "controllerNamespace" => "App\\Controllers\\",
        
    ];
}