<?php

namespace XFrames\Library;

class View{

    public $file = "";
    public array $viewParams = [];

    public function __construct($file = "", $viewParams = [], $render = true) {
        $this->file = $file;
        $this->viewParams = $viewParams;
        if($render){
            $this->render();
        }
    }

    public function with($key, $value){
        $this->viewParams = array_merge($this->viewParams, [$key => $value]);
        return $this;
    }
    
    public function render(){
        foreach ($this->viewParams as $key => $value) {
            ${$key} = $value;
        }
        require $_SERVER["DOCUMENT_ROOT"] . "/../" . config("system")->getViewsFolder() . $this->file . ".php";
        return $this;
    }

}