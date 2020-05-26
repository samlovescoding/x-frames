<?php

namespace XFrames\Utility;

use XFrames\Blueprints\RouteParameter;
use XFrames\Blueprints\Runnable;
use XFrames\Library\Router;

class Action extends Runnable{

    protected $className;
    protected string $method;
    protected bool $isStatic;
    protected Router $router;

    public function __construct($className = null, string $method = "dd", bool $isStatic = false) {
        $this->className = $className;
        $this->method = $method;
        $this->isStatic = $isStatic;
    }


    /*
     * 
     * Get a name of the original function or method
     * 
     * @return string|array
     * 
     */
    protected function getCallable(){
        if($this->className == null){
            return $this->method;
        }else{
            if($this->isStatic){
                return $this->className . "::" . $this->method;
            }else{
                $object = resolve($this->className);
                return [$object, $this->method];
            }
        }
    }


    /*
     *
     * Get a reflection of the action call
     * 
     * @return ReflectionMethod|ReflectionFunction
     * 
     */
    protected function getReflection(){
        
        if($this->className == null){
            return new \ReflectionFunction($this->method);
        }else{
            return new \ReflectionMethod($this->className, $this->method);
        }
    }


    /*
     * 
     * Get wildcard data from the requested route
     * 
     * @return string
     * 
     */
    protected function getRouteWildcard($parameter){
        return $this->router->routeParameters[":" . $parameter];
    }

    /*
     * 
     * Builds dependencies for DI in injections
     * 
     * @return array
     * 
     */
    public function buildDependencies($reflection){
        $dependencies = [];
        foreach ($reflection->getParameters() as $index => $parameter) {
            $reflectionType = $parameter->getType();
            if($reflectionType == null){
                $parameterName = $parameter->getName();
                
                $dependencies[] = $this->getRouteWildcard($parameterName);
                continue;
            }
            
            $object = resolve($reflectionType);
            
            if($object instanceof RouteParameter){
                //unset($object);
                $parameterName = $parameter->getName();
                $dependencies[] = $object->getRouteObject($this->getRouteWildcard($parameterName));
                continue;
            }else{
                echo $reflectionType;
            }
            $dependencies[] = resolve($reflectionType);
        }
        return $dependencies;
    }


    /*
     *
     * Run the action
     * 
     * @return void
     * 
     */
    public function run(Router $router){
        $this->router = $router;
        $parameters = func_get_args();
        $reflection = $this->getReflection();
        $dependencies = $this->buildDependencies($reflection);
        call_user_func_array($this->getCallable(), $dependencies);
    }

    /*
     *
     * Build an action from any type of data
     * 
     * @return XFrames\Utility\Action
     * 
     */
    static public function from($runnable){
        if($runnable instanceof string){
            return static::fromString($runnable);
        }elseif($runnable instanceof \Closure){
            die("Closure yet not implemented");
            return dd($runnable);
        }
    }

    /*
     *
     * Build an action from a string
     * 
     * @return XFrames\Utility\Action
     * 
     */
    static public function fromString(string $runnableString){
        if(config()->hasKernel){
            $runnableString = config("system")->getControllerNamespace() . $runnableString;
        }
        $runnable = str($runnableString);
        if($runnable->contains("@")){
            $runnableArray = $runnable->split("@");
            $className = $runnableArray->get(0);
            $methodName = $runnableArray->get(1);
            return new self($className, $methodName);
        }else{
            $methodName = $runnable->get();
            return new self(null, $methodName);
        }
    }
}