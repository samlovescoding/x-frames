<?php

namespace XFrames\Blueprints;

trait ConfigurationMapper{
    
    public function __call($function, $args) {

        if(count($args) == 0){

            // Get Call

            foreach ($this->config as $attribute => $value) {

                if($function == "get" . ucfirst($attribute)){

                    return $value;

                }

            }

        }

        elseif(count($args) == 1){

            // Set Call

            $value = $args[0];

            foreach ($this->config as $attribute => $attributeValue) {
                
                if($function == "set" . ucfirst($attribute)){

                    $this->config[$attribute] = $value;

                    return $this;
                }

            }
            
        }

        throw new \Exception("Call to unknown method '$function'");

    }

}