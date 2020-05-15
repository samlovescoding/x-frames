<?php

namespace XFrames\Utility;

use XFrames\Traits\Stringable;

class Str{
    use Stringable;
    
    public function startsWith($prefix){
        $length = strlen($prefix);
        return (substr($this->data, 0, $length) === $prefix);
    }

    public function endsWith($suffix){
        $length = strlen($suffix); 
        if ($length == 0){
            return true;
        }
        return (substr($this->data, -$length) === $suffix); 
    }

    public function lower(){
        $this->data = strtolower($this->data);
        return $this;
    }

    public function upper(){
        $this->data = strtoupper($this->data);
        return $this;
    }

    public function length(){
        return strlen($this->data);
    }

    public function split($separator){
        return (new Collection())->setArray(explode($separator, $this->data));
    }

    public function __toString()
    {
        return $this->data;
    }
}