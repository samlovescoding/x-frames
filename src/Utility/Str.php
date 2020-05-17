<?php

namespace XFrames\Utility;

use XFrames\Traits\Stringable;

class Str{
    use Stringable;

    const CAMEL_CASE = 1;
    const SNAKE_CASE = 2;
    const KEBAB_CASE = 3;
    const PASCAL_CASE = 4;
    
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

    public function tokenizeFromCase($case){
        $tokens = [];

        switch ($case) {
            case self::SNAKE_CASE:
                $tokens = explode("_", $this->data);
                break;
                
            case self::KEBAB_CASE:
                $tokens = explode("-", $this->data);
                break;
            
            case self::CAMEL_CASE:
                $tokens = preg_split('/(?=[A-Z])/', $this->data);
                break;
            
            case self::PASCAL_CASE:
                $tokens = preg_split('/(?=[A-Z])/', $this->data);
                array_shift($tokens);
                break;
            
            default:
                throw new \Exception("Unknown Token Keywork used.");
                break;
        }

        return $tokens;
    }

    public function camelCase($from = self::SNAKE_CASE){

        $this->data = collect( $this->tokenizeFromCase($from) )
            
            ->map(function($index, $key){
                return ucfirst($key);
            })
            
            ->join("");
        
        return $this;
    }

    public function pascalCase($from = self::SNAKE_CASE){

        $this->data = collect( $this->tokenizeFromCase($from) )
            
            ->map(function($index, $key){
                return ucfirst($key);
            })
            
            ->join("");

        $this->data = lcfirst($this->data);

        return $this;
    }

    public function snakeCase($from = self::CAMEL_CASE){

        $this->data = collect( $this->tokenizeFromCase($from) )
            
            ->map(function($index, $key){
                return strtolower($key);
            })

            ->join("_");

        return $this;
    }

    public function kebabCase($from = self::CAMEL_CASE){

        $this->data = collect( $this->tokenizeFromCase($from) )
            
            ->map(function($index, $key){
                return strtolower($key);
            })
            
            ->join("-");
        
        return $this;
    }
    
}