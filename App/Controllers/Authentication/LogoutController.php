<?php

namespace App\Controllers\Authentication;

use App\Models\User;
use XFrames\Library\Authentication;

class LogoutController{

    public function handle(){
        Authentication::forget();
        redirect("/dashboard");
    }

}