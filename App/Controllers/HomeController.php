<?php

namespace App\Controllers;

use XFrames\Library\Authentication;

class HomeController{
    
    public function welcome(){

        return view("welcome");

    }

    public function dashboard(){

        Authentication::require();

        echo "You are in dashboard mode.";

        echo "You are logged in as " . auth()->user()->name;

    }

}