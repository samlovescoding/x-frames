<?php

namespace XFrames\Blueprints;

abstract class Runnable{
    protected string $class;
    protected string $method;
    protected bool $isStatic;
    protected abstract function getCallable();
    protected abstract function run();
}