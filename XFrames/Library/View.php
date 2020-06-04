<?php

namespace XFrames\Library;

use XFrames\Blueprints\Renderable;

class View implements Renderable{

    public $file = "";
    
    public $parameters = [];
    
    public $content;
    
    public $layout = null;

    public function setFile($file) {

        $this->file = $file;

        return $this;

    }

    public function setParameters($parameters) {

        $this->parameters = $parameters;

        return $this;

    }

    public function setLayout($layout) {

        $this->layout = $layout;

        return $this;

    }

    public function __toString() {

        return $this->render();
        
    }

    public function with($key, $value) {

        $this->parameters = array_merge($this->parameters, [$key => $value]);

        return $this;

    }
    
    public function render() {
        
        $this->getContent();

        if($this->layout != null){

            $this->renderLayout();

        }else{

            $this->renderContent();

        }
        
        return $this;
    }

    public function renderLayout() {

        foreach ($this->parameters as $key => $value) {

            ${$key} = $value;

        }

        require $_SERVER["DOCUMENT_ROOT"] . "/../" . config("system")->getViewsFolder() . $this->layout . ".php";

        return $this;

    }

    public function renderContent() {

        echo $this->content;

    }

    public function getContent() {
        
        foreach ($this->parameters as $key => $value) {
        
            ${$key} = $value;
        
        }

        ob_start();

        require $_SERVER["DOCUMENT_ROOT"] . "/../" . config("system")->getViewsFolder() . $this->file . ".php";
        
        $this->content = ob_get_contents();
        
        ob_end_clean();
        
        return $this->content;

    }

    public function import($view) {

        foreach ($this->parameters as $key => $value) {

            ${$key} = $value;

        }

        require $_SERVER["DOCUMENT_ROOT"] . "/../" . config("system")->getViewsFolder() . $view . ".php";

    }

}