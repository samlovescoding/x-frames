<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class Language{

    use ConfigurationMapper;

    protected $config = [

        /*
         *
         * Default Language
         * 
         * It define the default language set to use in when
         * in production mode.
         * 
         */
        "default" => "English",

        /*
         *
         * Language Definitions
         * 
         * All custom language sets must be registered here 
         * to use them in the app.
         * 
         */
        "definitions" => [
            "English" => "App\\Language\\English",
        ],
    ];
}