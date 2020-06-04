<?php

namespace App\Events;

use XFrames\Blueprints\Event;

class ValidationErrorEvent implements Event{

    public function emit($validationError){

        session()->set("error", $validationError);
        
    }

}