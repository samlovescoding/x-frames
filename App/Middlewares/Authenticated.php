<?php

namespace App\Middlewares;

use XFrames\Library\Authentication;

class Authenticated
{

    public function handle(){

        if( ! Authentication::check() ){
            
            return redirect("/login");
        
        }

    }

}