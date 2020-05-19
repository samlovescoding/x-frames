<?php

namespace XFrames\Blueprints;

trait Attributes{
    protected array $attributes;
    public function hasAttribute($attributeName){
        if(!isset($this->attributes)){
            $this->attributes = [];
        }
        $this->attributes[] = $attributeName;
    }
    public function __call($function, $args) {
        if(count($args) == 1){
            // Get Call
            $value = $args[0];
            foreach ($this->attributes as $attribute) {
                echo $attribute;
            }
        }
        if(count($args) == 1){
            // Set Call
            $value = $args[0];
            foreach ($this->attributes as $attribute) {
                echo $attribute;
            }
        }
        return $this;
    }

}