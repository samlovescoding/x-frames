<?php

namespace XFrames\Utility;

class Session{

    public function __construct() {

        $this->boot();

        $this->map();

    }

    public function map(){

        foreach ($_SESSION as $key => $value) {
            
            $this->{$key} = $value;

        }

        return $this;
    }

    static function boot(){

        $sessionStorage = storage("session");

        $sesionPath = str($sessionStorage->getRealPath())->getRtrim(DIRECTORY_SEPARATOR);

        ini_set('session.save_path', $sesionPath);

        session_start();

    }

    static function reset(){

        session_destroy();

    }

    public function start(){

        $this->boot();

        return $this;

    }

    public function destroy(){

        $this->reset();

        return $this;

    }

    public function has($key){

        return isset($_SESSION[$key]);

    }

    public function set($key, $value){

        $_SESSION[$key] = $value;
        
        return $this->map();

    }

    public function delete($key){
        
        if($this->has($key)){

            unset($_SESSION[$key]);

        }

        return $this->map();

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