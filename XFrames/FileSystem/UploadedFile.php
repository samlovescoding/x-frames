<?php

namespace XFrames\FileSystem;

class UploadedFile extends File{

    public function __construct($key) {
        
        $file = $_FILES[$key];

        $folder = Storage::folder("temporary");

        $randomString = md5(rand(0,1000000) . time());

        $newTempName = $folder->realPath . $randomString;
        
        move_uploaded_file($file["tmp_name"], $newTempName);

        $this->path = $folder->path;

        $this->name = $randomString;

        $this->uploadedFile = $file;

    }

    public function store($storage, $createFile = false){

        parent::store($storage, $createFile);

        $this->rename($this->uploadedFile["name"]);

    }

}