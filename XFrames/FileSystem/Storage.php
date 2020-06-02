<?php

namespace XFrames\FileSystem;

class Storage{

    static public function folder($storage){

        $path = $storage;

        $path = config("fileSystem")->getStorage()[$storage];

        $folder = new Folder( $path );

        return $folder;

    }

}