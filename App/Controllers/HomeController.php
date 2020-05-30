<?php

namespace App\Controllers;

use App\Models\User;
use XFrames\Library\Authentication;

class HomeController{

    public function guest(){
        echo "You are in guest mode.";
    }

    public function dashboard(){
        Authentication::require();
        echo "You are in dashboard mode.";
    }

    public function unauthorized(){
        echo "403 - You dont have permissions to view this file.";
    }

    public function error(){
        echo "404 - File does not exist.";
    }
}