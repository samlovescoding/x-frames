<?php

namespace XFrames\Blueprints;

class RouteParam{
    public $name;
    public $data;
    public function __construct($name, $data) {
        $this->name = $name;
        $this->data = $data;
    }
    public function get(){
        return $this->data;
    }
}