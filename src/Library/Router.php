<?php

namespace XFrames\Library;

class Router{

    public string $currentRouteURI;

    public $routeParameters;

    public function __construct(bool $dispatch = true) {
        $this->currentRouteURI = $this->getCurrentRouteURI();
        $this->routeParameters = [];

        if($dispatch){
            $this->dispatch();
        }
    }

    public function getCurrentRequestMethod(){
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getRouteList(){
        global $_ROUTES;

        $requestedMethod = $this->getCurrentRequestMethod();
        
        if(!in_array($requestedMethod, array_keys($_ROUTES))){
            return [];
        }

        return $_ROUTES[$requestedMethod];
    }

    public function getCurrentRouteURI(){
        
        $scriptName = $_SERVER["SCRIPT_NAME"];
        
        $directoryPrefix = str($scriptName)
                            ->trim("/")
                            ->split("/")
                            ->popAndDispose()
                            ->join("/");

        return str($_SERVER["REQUEST_URI"])
            ->before("?")
            ->trim("/")
            ->leftShift($directoryPrefix)
            ->trim("/")
            ->prefix("/");

    }

    public function getErrorRoute(){
        global $_ROUTES;
        if($_ROUTES["error"] == null){
            throw new \Exception("No error route is defined.");
        }
        return $_ROUTES["error"];
    }

    public function matchRoute(string $testRoute){
        
        

        $hasParameters = false;

        # Test Number of Elements
        $currentRouteURIParts = str($this->currentRouteURI)->trim("/")->split("/");
        $testRouteParts = str($testRoute)->trim("/")->split("/");

        if($currentRouteURIParts->length() === $testRouteParts->length()){
            # Test Equality for each part

            $matched = true;
            for ($i=0; $i < $currentRouteURIParts->length(); $i++) { 

                # Get Each Part of URI
                $currentPart = $currentRouteURIParts->get($i);
                $testPart = $testRouteParts->get($i);

                # Discard Empty URIs
                if($currentPart == "" && $testPart  == ""){
                    continue;
                }

                # Is TestPart is empty cause parameter break
                if($testPart == ""){
                    $matched = false;
                }

                # Matchmaking hasnt yet failed so we continue
                if($matched){

                    # If the two parts are not equal, still check for parameters
                    if($currentPart != $testPart){

                        # If test part is not a parameter
                        if($testPart[0] != ":"){
                            $matched = false;
                        }else{

                            #If test part is a parameter
                            $hasParameters = true;
                            $this->routeParameters = array_merge($this->routeParameters, [
                                $testPart => $currentPart
                            ]);
                        }
                    }
                }
            }

            if($matched){
                return true;
            }
            
        }

        if(!$hasParameters){
            # Test Equality
            if($this->currentRouteURI == $testRoute){
                return true;
            }
        }

        return false;
    }

    public function getCurrentRoute(){
        $routeList = $this->getRouteList();
        $routeUri = $this->getCurrentRouteURI();
        foreach ($routeList as $route => $action) {
            if($this->matchRoute($route)){
                return $action;
            }            
        }
        return $this->getErrorRoute();
    }

    public function dispatch(){
        return $this->getCurrentRoute()->run($this);
    }
    
}