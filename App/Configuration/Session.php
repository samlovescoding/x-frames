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
         *
         * Save Directory
         * 
         * It defines the directory name under the files
         * FileSystem. Please note the trailing slash.
         * 
         */
        "directory" => "sessions/",

        /*
         *
         * Time To Live
         * 
         * How long the session data is stored for. By
         * default, it is 3 days. 
         * 
         */
        "ttl" => 3 * 24 * 60 * 60,
        
    ];
}