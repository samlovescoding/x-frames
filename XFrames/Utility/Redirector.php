<?php


namespace XFrames\Utility;


class Redirector
{
    public function __construct() {
        global $_PREVIOUS_ROUTE;
        global $_CURRENT_ROUTE;
        if(session()->has($this->getPreviousRouteKey())){
            $_PREVIOUS_ROUTE = session()->get($this->getPreviousRouteKey());
        }else{
            $_PREVIOUS_ROUTE = null;
        }
        
        session()->set($this->getPreviousRouteKey(), $_CURRENT_ROUTE);
    }

    public function redirect($to){
        header("Location:" . $to);
        return $this;
    }

    public function action($method, $parameters = []){
        return $this->redirect(action($method, $parameters));
    }

    public function route($name, $parameters = []){
        return $this->redirect(route($name, $parameters));
    }

    public function back(){
        global $_PREVIOUS_ROUTE;
        return $this->redirect($_PREVIOUS_ROUTE);
    }

    public function getPreviousRouteKey(){
        return config("session")->getPreviousRouteKey();
    }

}