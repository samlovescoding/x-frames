<?php

namespace XFrames\FileSystem;

class File{

    protected $storage;

    protected $name;

    protected $data;

    protected $commit;

    protected $path;

    static public function create(string $name, string $data = "", bool $commit = true){

        $file = new File;

        $file->name = $name;

        $file->data = $data;

        $file->commit = $commit;

        return $file;

    }

    public function path($path){

        $this->path = $path;

        return $this;

    }

    public function save($path = null){

        if($path != null){

            $this->path = $path;

        }

        file_put_contents($this->getFilePath(), $this->data);

        return $this;

    }

    public function commit(){

        if($this->commit){
            
            $this->save();

        }

        return $this;

    }

    public function write(string $data = ""){

        $this->data = $data;

        $this->commit();

        return $this;

    }

    public function prepend(string $data = ""){

        $this->data = $data . $this->data;

        $this->commit();

        return $this;
    
    }

    public function append(string $data = ""){

        $this->data = $this->data . $data;

        $this->commit();

        return $this;
    
    }

    public function empty(){
        
        $this->data = "";

        $this->commit();

        return $this;

    }

    static public function load($filePath){

        $file = File::create($filePath);

        $realFilePath = $file->getFilePath();

        $file->data = file_get_contents($realFilePath);

        return $file;

    }

    public function data(){

        return $this->data;

    }

    public function read($filePath = ""){

        $realFilePath = $this->getFilePath($filePath);

        return file_get_contents($realFilePath);

    }

    public function delete($filePath = ""){

        $realFilePath = $this->getFilePath($filePath);

        unlink($realFilePath);
        
    }

    public function exists($filePath){

        $realFilePath = $this->getFilePath($filePath);
        
        return file_exists($realFilePath);
    }

    public function store($storage){

        //

    }

    public function size(){

        return filesize($this->getFilePath());
        
    }

    public function getFilePath($appends = ""){
        
        return $this->getRoot() . $this->path . $this->name . $appends;

    }

    static public function getRoot(){
        
        return $_SERVER["DOCUMENT_ROOT"] . "/../";

    }

}