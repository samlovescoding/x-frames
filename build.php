<?php

/*
 *
 * This file builds your javascript and stylesheets. You can
 * configure settings below. Please call this file via
 * console or npm via `npm run build`
 * 
 */

die("This file is yet to be coded. Please wait.");

use XFrames\Library\Kernel;

$config = (new Kernel)->loadConfiguration();

$publicPath = $config->fileSystem->getPublicPath();



$commands = [
    /*
     *
     * Build Your SASS Stylesheets
     * 
     */
    "sass ?:?" => [],

    /*
     *
     * Build your JavaScript
     * 
     */
    "webpack ? ?" => []
];

