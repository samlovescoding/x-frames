<?php

namespace XFrames\Library;

use XFrames\Utility\Collection;
use XFrames\Utility\Str;

abstract class Component{
    protected string $name;
    protected Collection $attributes;
    protected bool $closed = true;
    protected string $slot;

    public function __construct(Str $name, Collection $attributes, Str $slot) {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->slot = $slot;
        $this->mounted();
    }

    public function setName(string $name){
        $this->name = $name;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setSlot(string $slot){
        $this->slot = $slot;
    }

    public function getSlot(){
        return $this->slot;
    }

    public function closed(bool $isClosed){
        $this->closed = $isClosed;
        return $this;
    }

    protected function getAttributeString(){
        return $this->attributes->map(function($attribute, $value){
            return "$attribute=\"$value\"";
        })->join(" ");
    }

    protected function openedElement(){
        return "<{$this->name} {$this->getAttributeString()} />";
    }

    protected function closedElement(){
        return "<{$this->name} {$this->getAttributeString()}>{$this->slot}</{$this->name}>";
    }

    protected function element($slot = null){
        if($slot != null){
            $this->slot = $slot;
        }
        if($this->closed){
            return $this->closedElement();
        }
        return $this->openedElement();
    }

    public function __toString(){
        return $this->render();
    }

    protected function mounted(){}

    protected function render(){
        return $this->element();
    }

    public static function getComponentName(){
        return "x-" . str(get_called_class())->lower()->split("\\")->pop();
    }
}
