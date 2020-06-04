<?php

namespace XFrames\Components;

use XFrames\Library\Component;

class Input extends Component{

    public function mounted() {
        
        $this->name = "input";

        $this->closed = false;

        $this->attributes->merge(["type" => "text"]);

    }

    public function render(){

        return $this->element();

    }
    
}