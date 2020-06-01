<?php

namespace App\Configuration;

use XFrames\Blueprints\ConfigurationMapper;
use XFrames\Database\Drivers\MySQLDriver;

class Database{

    use ConfigurationMapper;

    protected $config = [

        /*
         *
         * Database Driver
         * 
         * Driver implements the raw database queries. It can
         * be switched to a custom driver for different
         * databases. Out of the box we support MySQL
         * 
         */
        "driver" => MySQLDriver::class,
       
        /*
         *
         * Database Host
         * 
         * This is URL/IP Address of your MySQL server.
         * 
         */
        "host" => "localhost",

        /*
         *
         * Database User
         * 
         * It defines the username that is used to access the
         * database server.
         * 
         */
        "username" => "root",
        
        /*
         *
         * Database Password
         * 
         * It defines the password to use when authenticating
         * the username with database server.
         * 
         */
        "password" => "",

        /*
         *
         * Database Name
         * 
         * It defines the name of the database to access when
         * connected to the database server.
         * 
         */
        "database" => "test"
    ];
}