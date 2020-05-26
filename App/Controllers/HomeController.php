<?php

namespace App\Controllers;

use XFrames\Database\QueryBuilder;

class HomeController{
    public function index(){
        // onUserLoggedInSuccessfully
    }

    public function guest(){
        redirect("/blog");
    }

    public function error(){
        echo "404 Page Not Found";
    }
}
