<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class Events{

    use ConfigurationMapper;

    protected $config = [
        
        /*
         *
         * Event Map
         * 
         * Register your events to their respective listeners
         * in this map.
         * 
         */
        "map" => [
            \App\Events\MountEvent::class => [
                \App\Listeners\BindingsListener::class,
            ]
        ],

        /*
         *
         * Mount Event
         * 
         * This event gets fired when application has mounted
         * and just before the controller gets fired up.
         * 
         */
        "applicationMount" => \App\Events\MountEvent::class,


        /*
         * 
         * Validation Error Event
         * 
         * This event gets fired when an input fails to be
         * validated
         * 
         */
        "validationError" => \App\Events\ValidationErrorEvent::class,

    ];
}