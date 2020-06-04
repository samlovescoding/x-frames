<?php

namespace XFrames\Library;

use XFrames\Blueprints\Attributes;

class Configuration{

    public $hasKernel = false;

    protected $namespace = "";
    
    public $map = [];

    public function setKernel(){

        $this->hasKernel = true;

    }

    public function setNamespace($namespace) {

        $this->namespace = $namespace;

    }

    public function mapConfig(array $map){

        $this->map = $map;
        
        foreach ($map as $className => $fileName) {

            require $fileName;

        }
    }

    public function __call($function, $args){
        
        if(in_array($function, array_keys($this->map))){

            $className = $this->namespace . ucfirst($function);

            return new $className;

        }

        throw new \Exception("Unknown method call '$function'.");

    }

}