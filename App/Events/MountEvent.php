<?php

namespace App\Events;

use XFrames\Blueprints\Event;

class MountEvent implements Event{

    public function emit($currentAction = null){
        $this->currentAction = $currentAction;
    }

}