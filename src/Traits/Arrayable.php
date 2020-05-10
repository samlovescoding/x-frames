<?php

namespace XFrames\Traits;

trait Arrayable {
    private array $array = [];

    public function __construct(){
        if(func_num_args() > 0){
            $this->setArray(func_get_args(0));
        }
    }

    public function getArray(){
        return $this->array;
    }

    public function setArray(array $array){
        $this->array = $array;
        return $this;
    }
}