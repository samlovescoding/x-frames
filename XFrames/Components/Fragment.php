<?php

namespace XFrames\Components;

use XFrames\Library\Component;
use XFrames\Utility\Collection;

class Fragment extends Component{
    public $components;

    public function mounted() {
        $this->name = "div";
        $this->closed = true;
        $this->components = collect([]);
    }

    public function addComponent(Component $component){
        $this->components->push($component);
        return $this;
    }

    public function render(){
        $this->slot = "";
        
        foreach ($this->components->all() as $component) {
            $this->slot .= $component->render();
        }
        return $this->element();
    }
    
}