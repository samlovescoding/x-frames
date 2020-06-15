<?php

namespace App\Middlewares;

use XFrames\Library\Authentication;

class Guest
{

    public function handle(){

        if( Authentication::check() ){
            
            return redirect("/home");
        
        }

    }

}