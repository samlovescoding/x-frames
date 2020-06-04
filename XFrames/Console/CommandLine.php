<?php

namespace XFrames\Console;

use XFrames\Utility\Str;

class CommandLine{

    public function printline($line = ""){

        echo $line . "\n";

    }

    public function inputline($line = null){

        if(!$line == null){

            echo $line;

        }else{

            echo "Enter your choice: ";

        }

        return trim(readline());

    }

    public function inputbool(){

        echo "Enter your choice (y/n): ";

        $bool = $this->inputline();

        if($bool == "y" || $bool == "Y"){

            return true;

        }

        if($bool == "n" || $bool == "N"){

            return false;

        }

        throw new \Exception("Your input must be Yes or No in the form of y/n.");

    }

    public function asciiLogo(){

        echo file_get_contents(dirname(__FILE__) . "/ascii.txt");

    }

    public function menu(){

        $this->asciiLogo();

        $this->printline();

        $this->printline();

        $this->printline("What do you want to make?");

        $this->printline("1. Controller");

        $this->printline("2. Resource");

        $this->printline("3. Model");

        $this->printline("4. Event");

        $this->printline("5. Listener");

        $this->printline("6. Policy");

    }

    public function render(){

        $this->menu();

        $choice = $this->inputline();

        switch ($choice) {

            case '1':

                $this->controller();

            break;

            case '2':

                $this->resource();

            break;

            case '3':

                $this->model();

            break;

            case '4':

                $this->event();

            break;

            case '5':

                $this->listener();

            break;

            case '6':

                $this->policy();

            break;

            default:

                $this->printline("Sorry, your choice is invalid.");

            break;

        }

    }

    public function stub($stub, $args){

        $content = file_get_contents(dirname(__FILE__) . "/stubs/" . $stub . ".stub");

        foreach ($args as $key => $value) {

            $content = str_replace("{" . $key . "}", $value, $content);

        }

        return $content;

    }

    public function save($stub, $file){

        file_put_contents($file, $stub);

    }

    public function controller(){

        $controllerTitle = $this->inputline("Enter controller class: ");

        $controllerNamespace = "App\\Controllers\\";

        $controllerPath = str_replace("\\", "/", $controllerNamespace . $controllerTitle . ".php");

        $stub = $this->stub("controller", [

            "controller" => $controllerTitle
        ]);

        echo "Created a controller at " . $controllerPath;

        $this->save($stub, $controllerPath);

    }

    public function resource(){

        $controllerTitle = $this->inputline("Enter controller class: ");

        $model = $this->inputline("Enter model class: ");

        $modelShort = str($model)->snakeCase(Str::PASCAL_CASE)->get();

        $modelVar = lcfirst($model);

        $controllerNamespace = "App\\Controllers\\";

        $controllerPath = str_replace("\\", "/", $controllerNamespace . $controllerTitle . ".php");

        $stub = $this->stub("resource", [
            "controller" => $controllerTitle,
            "model" => $model,
            "model.short" => $modelShort,
            "model.var" => $modelVar
        ]);

        echo "Created a controller at " . $controllerPath;

        $this->save($stub, $controllerPath);

    }

    public function model(){

        $modelTitle = $this->inputline("Enter model class: ");

        $modelNamespace = "App\\Models\\";

        $modelPath = str_replace("\\", "/", $modelNamespace . $modelTitle . ".php");

        $stub = $this->stub("model", [
            "model" => $modelTitle
        ]);

        echo "Created a model at " . $modelPath;

        $this->save($stub, $modelPath);

    }

    public function event(){

        $eventTitle = $this->inputline("Enter event class: ");

        $eventNamespace = "App\\Events\\";

        $eventPath = str_replace("\\", "/", $eventNamespace . $eventTitle . ".php");

        $stub = $this->stub("event", [
            "event" => $eventTitle
        ]);

        echo "Created a event at " . $eventPath;

        $this->save($stub, $eventPath);

    }
    public function listener(){

        $listenerTitle = $this->inputline("Enter listener class: ");

        $listenerNamespace = "App\\Listeners\\";

        $listenerPath = str_replace("\\", "/", $listenerNamespace . $listenerTitle . ".php");

        $stub = $this->stub("listener", [
            "listener" => $listenerTitle
        ]);

        echo "Created a listener at " . $listenerPath;

        $this->save($stub, $listenerPath);

    }

    public function policy(){

        $modelTitle = $this->inputline("Enter model class: ");

        $policyNamespace = "App\\Policies\\";

        $policyPath = str_replace("\\", "/", $policyNamespace . $modelTitle . ".php");

        $modelVar = lcfirst($modelTitle);

        $stub = $this->stub("policy", [
            "model" => $modelTitle,
            "model.var" => $modelVar
        ]);

        echo "Created a policy at " . $policyPath;

        $this->save($stub, $policyPath);

    }

}