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

        "storage" => [

            "images" => "Files/images/"

        ]

    ];
}