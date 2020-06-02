<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;

class FileSystem{

    use ConfigurationMapper;

    protected $config = [
        
        /*
         *
         * Public Path
         * 
         * It defines the publicly accessible folder of your 
         * application. Dont expose XFramework, vendor or
         * node_modules on your production website.
         * 
         */
        "publicPath" => "public_html/",

        /*
         *
         * Storage Path
         * 
         * It defines the path that is used when working with
         * file uploads and handling other file related
         * tasks. It should be publicly accessible as
         * dependent on your application needs.
         * 
         */
        "storagePath" => "public_html/storage/",

        "systems" => [

            "st"

        ]

    ];
}