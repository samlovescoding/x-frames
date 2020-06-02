<?php

namespace XFrames\FileSystem;

class File{

    protected $storage;

    protected $name;

    protected $data;

    protected $commit;

    protected $path;

    protected $created = false;

    static public function create(string $name, string $data = "", bool $commit = true){

        $file = new File;

        $file->name = $name;

        $file->data = $data;

        $file->commit = $commit;

        $file->created = true;

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

    public function saveTo(Folder $folder){

        $file = $folder->add($this);

        $file->save();

        return $file;

    }

    public function renameTo(Folder $folder){

        $file = $folder->add($this);

        $file->rename($file->name);

        return $file;

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

        $folder = Storage::folder($storage);

        if($this->created){

            return $this->saveto($folder);

        }

        rename($this->getFilePath(), $folder->realPath . $this->name);

        $this->path($folder->path);

        return $this;


    }

    public function size(){

        return filesize($this->getFilePath());

    }

    public function copy($name){

        $originalFilePath = $this->getFilePath();

        $this->name = $name;

        $newFilePath = $this->getFilePath();

        copy($originalFilePath, $newFilePath);

        return $this;

    }

    public function rename($name){

        $originalFilePath = $this->getFilePath();

        $this->name = $name;

        $newFilePath = $this->getFilePath();

        rename($originalFilePath, $newFilePath);

        return $this;

    }

    public function getFilePath($appends = ""){
        
        return $this->getRoot() . $this->path . $this->name . $appends;

    }

    static public function getRoot(){
        
        return $_SERVER["DOCUMENT_ROOT"] . "/../";

    }

}