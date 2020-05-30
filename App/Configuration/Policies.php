<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class Policies{

    use ConfigurationMapper;

    protected $config = [
        
        /*
         *
         * Policy Map
         * 
         * Register your models to their respective policies.
         * All policies must be registered.
         * 
         */
        "map" => [
            // \App\Models\Model::class => \App\Policies\ModelPolicy::class
        ],

    ];
}