<?php

namespace XFrames\Library;

class Emitter{

    public function emit($event, $data){
        
        $event->emit($data);

        $eventMap = config("events")->getMap();
        
        if(in_array(get_class($event), array_keys($eventMap))){

            $listeners = $eventMap[get_class($event)];
            
            foreach ($listeners as $listener) {

                resolve($listener)->handle($event);

            }

        }

    }

}