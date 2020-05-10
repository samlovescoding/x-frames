<?php

namespace XFrames\Traits;

trait Stringable {
    private string $data = "";

    public function __construct(){
        if(func_num_args() > 0){
            $this->data = func_get_args(0);
        }
    }

    public function get(){
        return $this->data;
    }

    public function set(string $data){
        $this->data = $data;
        return $this;
    }
}