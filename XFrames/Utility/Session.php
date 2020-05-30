<?php

namespace XFrames\Utility;

class Session{
    public function __construct() {
        $this->boot();
    }
    static function boot(){
        session_start();
    }
    static function reset(){
        session_destroy();
    }
    public function has($key){
        return isset($_SESSION[$key]);
    }
    public function set($key, $value){
        $_SESSION[$key] = $value;
        return $this;
    }
    public function delete($key){
        if($this->has($key)){
            unset($_SESSION[$key]);
        }
        return $this;
    }
    public function get($key){
        return $_SESSION[$key];
    }
    public function flash($key){
        $data = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $data;
    }
    public function flush(){
        unset($_SESSION);
        return $this;
    }
}