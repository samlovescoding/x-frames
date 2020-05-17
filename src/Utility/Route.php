<?php

namespace XFrames\Utility;

use XFrames\Utility\Action;

class Route{
    
    public function error($actionable){
        global $_ROUTES;
        $_ROUTES["error"] = Action::fromString($actionable);
    }

    static public function __callStatic($name, $parameters){
        global $_ROUTES;
        
        if(!isset($_ROUTES)){

            $_ROUTES = [];

            $methods = ["get", "post", "put", "patch", "delete", "options"];

            foreach ($methods as $supportedMethod) {
                $_ROUTES = array_merge($_ROUTES, [
                    $supportedMethod => []
                ]);
            }

            $_ROUTES["error"] = null;
        }

        list($routeMatch, $actionable) = $parameters;
        
        $action = Action::fromString($actionable);
        
        $route = [$routeMatch => $action];

        if(!in_array($name, array_keys($_ROUTES))){

            throw new \Exception("Current Route Method '$name' is not supported by XFrames.");
            return null;

        }

        $_ROUTES[$name] = array_merge($_ROUTES[$name], $route);

    }
}

