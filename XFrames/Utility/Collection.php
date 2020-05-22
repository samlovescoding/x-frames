<?php

namespace XFrames\Utility;

use XFrames\Blueprints\DumpAndDie;
use XFrames\Blueprints\Arrayable;

class Collection{
    use Arrayable, DumpAndDie;

    public function has($key){
        return in_array($key, $this->array);
    }

    public function set($index, $value){
        $this->array[$index] = $value;
        return $this;
    }

    public function get($index){
        return $this->array[$index];
    }

    public function keys(){
        return array_keys($this->array);
    }

    public function values(){
        return array_values($this->array);
    }

    function isAssociative(){
        if (array() === $this->array) return false;
        return array_keys($this->array) !== range(0, count($this->array) - 1);
    }

    public function map(\Closure $with){
        $this->array = array_map($with, $this->keys(), $this->values());
        return $this;
    }

    public function merge(array $with){
        $this->array = array_merge($this->array, $with);
    }

    public function join($glue = " "){
        return (new Str())->set(implode($glue, $this->array));
    }

    public function all(){
        return $this->getArray();
    }

    public function toArray(){
        return $this->getArray();
    }

    public function push(){
        $values = func_get_args();
        array_push($this->array, ...$values);
        return $this;
    }

    public function pop(){
        return array_pop($this->array);
    }

    public function popAndDispose(){
        array_pop($this->array);
        return $this;
    }

    public function random(){
        return array_rand($this->array);
    }

    public function filter(\Closure $with){
        $this->array = array_filter($this->array, $with);
        return $this;
    }

    public function in($needle){
        return in_array($needle, $this->array);
    }

    public function flat(){
        $newArray = [];
        foreach ($this->array as $index => $item) {
            $newArray = array_merge($newArray, $item);
        }
        $this->array = $newArray;
        return $this;
    }

    public function flatMap(\Closure $with){
        return $this->map($with)->flat();
    }

    public function hasAtleast($n){
        if($this->length() > $n){
            return true;
        }else{
            return false;
        }
    }

    public function hasExactly($n){
        if($this->length() == $n){
            return true;
        }else{
            return false;
        }
    }

    public function length(){
        return count($this->array);
    }
}