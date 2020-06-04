<?php

namespace XFrames\Utility;

class ValidationRules{

    public function is_required($key, $value){
        
        if(isset($_REQUEST[$key]) && $_REQUEST[$key] == $value){
        
            return true;
        
        }
        
        return false;

    }

    public function is_alpha($key, $value){
        
        if(ctype_alpha($value)){
            
            return true;

        }

        return false;

    }

    public function is_min($key, $value, $min){

        if(strlen($value) > $min){

            return true;

        }

        return false;

    }

    public function is_max($key, $value, $max){

        if(strlen($value) < $max){

            return true;

        }

        return false;

    }

    public function is_min_max($key, $value, $min, $max){

        if(
            $this->is_min($key, $value, $min)
            &&
            $this->is_max($key, $value, $max)
        ){

            return true;

        }

        return false;

    }

}