<?php

namespace XFrames\Utility;

use XFrames\Blueprints\Runnable;

class Action extends Runnable{
    protected $className;
    protected string $method;
    protected bool $isStatic;

    public function __construct($className = null, string $method = "dd", bool $isStatic = false) {
        $this->className = $className;
        $this->method = $method;
        $this->isStatic = $isStatic;
    }

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

    public function run(){
        $parameters = func_get_args();
        call_user_func_array($this->getCallable(), $parameters);
    }

    static public function fromString(string $runnableString){
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