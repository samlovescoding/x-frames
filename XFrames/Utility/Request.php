<?php

namespace XFrames\Utility;

use XFrames\FileSystem\UploadedFile;

class Request{
    public function __construct() {
        $request = $_REQUEST;
        foreach ($request as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function only(){

        $requiredKeys = func_get_args();

        $request = [];

        foreach ($requiredKeys as $key) {
            
            $request[$key] = $_REQUEST[$key];

        }

        return $request;

    }

    public function array(){

        return $_REQUEST;

    }

    public function file($key){

        return new UploadedFile($key);
        
    }

    public function validate($rules){
        return (new Validator($_REQUEST, $rules))->validatedRequest();
    }
}