<?php

namespace XFrames\Blueprints;

abstract class Runnable {

    protected $class;

    protected $method;

    protected $isStatic;

    protected abstract function getCallable();

    //protected function run();

}