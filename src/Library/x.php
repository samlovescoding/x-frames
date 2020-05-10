<?php

namespace XFrames\Library;

class x{
    static function call($name){
        $allClasses = getClassesUnderNamespace("XFrames\\Components");

        $allClasses = collect($allClasses)->filter(function($value) use ($name){
            if(call_user_func($value .'::getComponentName') == "x-$name"){
                return true;
            }
            return false;
        });

        if($allClasses->hasExactly(1)){
            return resolve($allClasses->pop());
        }else{
            throw new \RuntimeException("x-$name component is never defined but used.");
        }
    }

    static function __callStatic($name, $arguments){
        return static::call($name);
    }
    public function __call($name, $arguments){
        return $this->call($name);
    }
}