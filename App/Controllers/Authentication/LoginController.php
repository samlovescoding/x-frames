<?php

namespace App\Controllers\Authentication;

use App\Models\User;
use XFrames\Library\Authentication;

class LoginController{

    public function handle(){

        $user = new User;

        $userAttempt = $user->attempt(

            request()->username,

            request()->password

        );

        if($userAttempt != false){

            Authentication::remember($userAttempt);

            redirect("/dashboard");

        }else{

            redirect("/login");

        }

    }

    public function form(){

        return view("authentication/login");

    }
}