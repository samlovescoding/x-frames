<?php


namespace XFrames\Cache;


use XFrames\Blueprints\CacheDriver;
use XFrames\FileSystem\File;

class FileDriver extends CacheDriver
{

    protected function loadFile(string $key){

        $file = File::load($key);

        return storage("cache")->add($file);

    }

    public function set(string $key, $value)
    {

        $file = File::create($key, serialize($value));

        $file = storage("cache")->add($file);

        $file->save();

    }

    public function get(string $key)
    {

        return $this->loadFile($key)->read();

    }

    public function has(string $key)
    {

        return $this->loadFile($key)->exists();

    }

    public function delete(string $key)
    {

        return $this->loadFile($key)->delete();

    }

}