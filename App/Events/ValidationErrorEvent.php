<?php

namespace App\Events;

use XFrames\Blueprints\Event;

class ValidationErrorEvent implements Event{

    public function emit($validationError){

        if(! session()->has("validationError")){
            session()->set("validationError", []);
        }

        session()->set("validationError", array_merge(
            session()->get("validationError"),
            [ $validationError ]
        ));

        // This event does not call any other listeners.
        // You can definitely do that.
        
    }

}