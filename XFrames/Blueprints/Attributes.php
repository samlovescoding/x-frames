<?php

namespace XFrames\Blueprints;

use Exception;

trait Attributes{

    protected $attributes;

    public function hasAttribute($attributeName){

        if(!isset($this->attributes)){

            $this->attributes = [];

        }

        $this->attributes[$attributeName] = null;

    }

    public function __call($function, $args) {

        if(count($args) == 0){

            // Get Call

            foreach ($this->attributes as $attribute => $value) {

                if($function == "get" . ucfirst($attribute)){

                    return $value;

                }

            }

        }

        elseif(count($args) == 1){

            // Set Call

            $value = $args[0];

            foreach ($this->attributes as $attribute => $attributeValue) {
                
                if($function == "set" . ucfirst($attribute)){

                    $this->attributes[$attribute] = $value;

                    return $this;

                }

            }

        }

        throw new Exception("Call to unknown method '$function'");

    }

}