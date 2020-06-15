<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class Middlewares{

    use ConfigurationMapper;

    protected $config = [

        /*
         *
         * Middleware Map
         * 
         * Register nicknames for your middleware classes here.
         * 
         */
        "map" => [
            "auth" => \App\Middlewares\Authenticated::class,
            "guest" => \App\Middlewares\Guest::class,
            "throttle" => \App\Middlewares\ThrottleRequests::class,
        ],

        /*
         * Throttle Pages
         * 
         * How many page requests to serve in 1 minute
         * 
         */

         "throttlePages" => 60

    ];
}