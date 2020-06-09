<?php

namespace App\Controllers;

use XFrames\Library\Authentication;

class HomeController{

    public function welcome(){

        dd(memory_get_usage());

        view("welcome");

    }

    public function dashboard(){

        Authentication::require();

        echo "You are in dashboard mode.";

        echo "You are logged in as " . auth()->user()->name;

    }

    public function error(){

        echo "404 - File does not exist.";

    }

}