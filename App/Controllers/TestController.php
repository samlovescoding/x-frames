<?php

namespace App\Controllers;

use XFrames\FileSystem\File;
use XFrames\FileSystem\Folder;
use XFrames\FileSystem\Storage;

class TestController{

    public function test($file){

        $file = File::create("hello.txt", "Content");

        $file->store("images");

    }

}