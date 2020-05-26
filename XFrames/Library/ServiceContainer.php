<?php

namespace XFrames\Library;

use XFrames\Utility\Collection;

class ServiceContainer{
    
    protected Collection $bindings;
    protected Collection $singletons;
    protected Collection $activeSingletons;

    public function __construct() {
        $this->bindings = new Collection();
        $this->singletons = new Collection();
        $this->activeSingletons = new Collection();
    }

    function buildDependencies(\ReflectionClass $reflection){
        if(!$constructor = $reflection->getConstructor()){
            return [];
        }
        $params = $constructor->getParameters();
        return array_map(function($param) {
            if(!$type =  $param->getType()){
                throw new \RuntimeException("Unknown Type of " . $param);
            }
            return $this->resolve($type);
        }, $params);
    }

    function resolveBindings($service){
        if(collect($this->bindings->keys())->has($service)){
            $service = $this->bindings->get($service);
            $reflection = new \ReflectionClass($service);
            $dependencies = $this->buildDependencies($reflection);
            return $reflection->newInstanceArgs($dependencies);
        }
    }

    function resolveSingletons($service){
        if(collect($this->activeSingletons->keys())->has($service)){
            return $this->activeSingletons->get($service);
        }

        if(collect($this->singletons->keys())->has($service)){
            $originalService = $service;
            $service = $this->singletons->get($service);
            $reflection = new \ReflectionClass($service);
            $dependencies = $this->buildDependencies($reflection);
            $this->activeSingletons->merge([$originalService => $reflection->newInstanceArgs($dependencies)]);
            return $this->activeSingletons->get($originalService);
        }
    }

    function resolve(string $service){
        $bindingsResolution = $this->resolveBindings($service);

        if($bindingsResolution != null) return $bindingsResolution;

        $singletonsResolution = $this->resolveSingletons($service);

        if($singletonsResolution != null) return $singletonsResolution;

        //Automatic Resolver

        $reflection = new \ReflectionClass($service);
        $dependencies = $this->buildDependencies($reflection);
        return $reflection->newInstanceArgs($dependencies);
    }

    function bind($name, $service){
        $this->bindings->merge([$name => $service]);
    }

    function singleton($name, $service){
        $this->singletons->merge([$name => $service]);
    }
}