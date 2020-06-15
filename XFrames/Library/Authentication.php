<?php

namespace XFrames\Library;

use XFrames\Utility\Session;

class Authentication{

    public static $unauthorizedRoute = "/unauthorized";

    public static function require(){

        if(!static::check()){

            redirect(static::$unauthorizedRoute);

        }

    }

    public static function can($method, $model, $redirectUnauthorized = true, $redirectNoUser = true){

        $policy = $model->getPolicy();

        if($policy == null){

            if($redirectUnauthorized){

                redirect(static::$unauthorizedRoute);

            }

            return false;

        }

        $user = static::user();

        if($user == null){

            if($redirectNoUser){

                redirect(static::$unauthorizedRoute);

            }

            return false;

        }

        $result = call_user_func_array([$policy, $method], [$model, $user]);

        if($result == null || $result == false){

            if($redirectUnauthorized){

                redirect(static::$unauthorizedRoute);

            }

            return false;

        }else{

            return true;

        }

    }

    public static function setUnauthorizedRoute($route){

        static::$unauthorizedRoute = $route;

    }

    public static function user(){

        $session = resolve(Session::class);

        return $session->get(static::getAuthenticationKey());
    }

    public static function check(){
        
        $session = resolve(Session::class);

        return $session->has(static::getAuthenticationKey());

    }

    public static function remember($user){
        
        $session = resolve(Session::class);

        $session->set(static::getAuthenticationKey(), $user);

    }

    public static function forget(){

        $session = resolve(Session::class);

        $session->delete(static::getAuthenticationKey());

    }

    static public function getAuthenticationKey(){
        return config("session")->getAuthenticationKey();
    }


}