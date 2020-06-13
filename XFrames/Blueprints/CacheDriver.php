<?php

namespace XFrames\Blueprints;

abstract class CacheDriver{

    abstract public function set(string $key, $value);

    abstract public function get(string $key);

    abstract public function has(string $key);

    abstract public function delete(string $key);

}