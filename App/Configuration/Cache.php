<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

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
        "driver" => "default",

        /*
         *
         * Save Directory
         * 
         * It defines the directory under which all cache is 
         * saved.Please note the trailing slash.
         * 
         */
        "directory" => "cache/",
    ];
}