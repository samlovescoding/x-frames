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

        return $session->get("authentication_user");
    }

    public static function check(){
        
        $session = resolve(Session::class);

        return $session->has("authentication_user");

    }

    public static function remember($user){
        
        $session = resolve(Session::class);

        $session->set("authentication_user", $user);

    }

    public static function forget(){

        $session = resolve(Session::class);

        $session->delete("authentication_user");

    }


}