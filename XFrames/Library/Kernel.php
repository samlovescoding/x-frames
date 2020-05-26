<?php

namespace XFrames\Library;

/*
 *
 * Kernel
 * 
 * This is a sample Kernel that is used in XFramework. You 
 * can define and use custom kernels as per your needs.
 * 
 */

class Kernel{

    protected Router $router;
    protected Configuration $configuration;

    public function __construct($configurationRoot, $configurationNamespace) {

        singleton(Configuration::class);
        
        $configurationMap = $this->loadConfigurationMap($configurationRoot);

        $this->configuration = resolve(Configuration::class);

        $this->configuration->setKernel();
        $this->configuration->setNamespace($configurationNamespace);
        $this->configuration->mapConfig($configurationMap);
    }

    public function loadConfigurationMap($configurationRoot){
        $map = [];

        foreach (glob($configurationRoot . "*.php") as $configurationFile) {
            $configurationClass = substr($configurationFile, strlen($configurationRoot));
            $configurationClass = substr($configurationClass, 0, strlen($configurationClass) - 4);
            $configurationClass = lcfirst($configurationClass);
            $map[$configurationClass] = $configurationFile;
        }

        return $map;

    }

    public function boot($routesFile){
        // Startup Boot Definitions. Pre-Request State
        require $routesFile;
        $this->router = new Router(false);
    }

    public function render(){
        $this->router->dispatch();
    }
}