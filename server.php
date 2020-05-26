<?php

use XFrames\Library\Kernel;

require "vendor/autoload.php";

require "routes.php";

/*
 *
 * Bootstrap the Kernel. To use XFrames in a custom framework
 * you must define your own kernel. Kernel will manage the
 * how the routes are processed and the app files are
 * loaded. It basically provides a coded interface
 * for your directory structure.
 * 
 */
$kernel = new Kernel(
    __DIR__ . "/App/Configuration/",         //Configuration Folder
    "App\\Configuration\\"                      //Configuration Namespace
);

/*
 *
 * Kernel will load all the application related code and call
 * all the boot listeners.
 * 
 */
$kernel->boot(__DIR__ . "/routes.php");

/*
 *
 * Kernel will render the request into a response.
 * 
 */
$kernel->render();

