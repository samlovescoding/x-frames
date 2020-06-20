<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;
use XFrames\Cache\FileDriver;

class Cache{

    use ConfigurationMapper;

    protected $config = [
        
        /*
         *
         * Driver
         * 
         * It defines the driver that is used for caching. By
         * default it is file system. Options are database
         * files and default.
         * 
         */
        "driver" => FileDriver::class,

        /*
         *
         * Time To Live
         * 
         * It defines the default time to live for a cache key
         * in seconds.
         * 
         */
        "timeToLive" => 10 * 60,
    ];
}