<?php

namespace XFrames\Traits;
trait Arrayable{
    protected array $array;

    public function getArray(){
        return $this->array;
    }

    public function setArray(array $array){
        $this->array = $array;
        return $this;
    }

    public function set($index, $value){
        $this->array[$index] = $value;
        return $this;
    }

    public function get($index){
        return $this->array[$index];
    }

}