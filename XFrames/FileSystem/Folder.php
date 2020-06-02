<?php

namespace XFrames\FileSystem;

class Folder{

    public function __construct($path) {
        
        $this->path($path);
        
    }
    
    public function path($path){
        
        if(!str($path)->endsWith("/")){
            
            $path = $path . "/";

        }

        $this->path = $path;
    
        $this->realPath = $this->getRoot() . $path;

        return $this;

    }

    static public function create($path){

        $folder = new Folder($path);

        if(!is_dir($folder->realPath)){

            mkdir($folder->realPath);

        }


        return $folder;

    }

    public function delete(){

        $iterator = new \RecursiveDirectoryIterator($this->realPath, \RecursiveDirectoryIterator::SKIP_DOTS);

        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach($files as $file) {

            if ($file->isDir()){

                rmdir($file->getRealPath());

            } else {

                unlink($file->getRealPath());

            }
        }

        rmdir($this->realPath);

    }

    public function file($file){

        $file = File::load($file);

        return $this->add($file);

    }

    public function files($includeFolders = false){

        $files = [];

        foreach(glob($this->realPath . "/*") as $file) {

            $fileName = substr($file, strlen($this->realPath . "/"));

            if(is_dir($file) && $includeFolders){

                $files[] = new Folder($this->path . $fileName);

            }

            $fileObject = File::create($fileName);
            
            $fileObject->path($this->path);

            $files[] = $fileObject;

        }

        return $files;

    }

    public function getPath(){

        return $this->path;

    }

    public function getRealPath(){

        return $this->realPath;
        
    }

    public function add(File $file){

        $file->path($this->path);

        return $file;

    }

    static public function getRoot(){
        
        return $_SERVER["DOCUMENT_ROOT"] . "/../";

    }

}