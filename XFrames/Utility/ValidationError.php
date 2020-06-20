<?php

namespace XFrames\Utility;

use XFrames\Blueprints\Attributes;

class ValidationError{

    use Attributes;

    public function __construct() {
        
        $this->hasAttribute("key");
        
        $this->hasAttribute("value");

        $this->hasAttribute("rule");

    }

    public function getMessage(){
        return $this->getRule();
    }

}