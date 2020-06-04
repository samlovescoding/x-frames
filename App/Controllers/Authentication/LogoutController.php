<?php

namespace App\Controllers\Authentication;

use XFrames\Library\Authentication;

class LogoutController{

    public function handle(){

        Authentication::forget();

        redirect("/dashboard");

    }

}