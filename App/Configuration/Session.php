<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class Session{

    use ConfigurationMapper;

    protected $config = [
        
        /*
         *
         * Driver
         * 
         * It defines the session driver to use. By default
         * we use PHP session implementation. Other
         * options are "files*" and "db*".
         * 
         */
        "driver" => "default",

        /*
         * Decay Time
         * 
         * It defines time in which decay items will decay.
         * 
         */

        "decayTime" => 5 * 60,

        /*
         * Throttler Key
         * 
         * It defines the key to use to store throttling
         * data by the Throttling Middleware
         * 
         */

        "throttlerKey" => "throttler",

        /*
         * Authentication Key
         *
         * It defines the key to use to store authenticated user.
         * For example, this will be used in the session.
         *
         */
        "authenticationKey" => "authenticatedUser",

        /*
         * Previous Route Key
         *
         * It saves the current route url. It is required to use
         * redirect()->back()
         *
         */
        "previousRouteKey" => "previousRoute"
        
    ];
}