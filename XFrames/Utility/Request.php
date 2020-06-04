<?php

namespace XFrames\Utility;

use XFrames\Blueprints\Mapper;
use XFrames\FileSystem\UploadedFile;
use XFrames\Library\Validator;

class Request{

    use Mapper;

    public function __construct() { 

        $this->memberMapsTo($_REQUEST);

    }

    public function only() {

        $requiredKeys = func_get_args();

        $request = [];

        foreach ($requiredKeys as $key) {
            
            $request[$key] = $_REQUEST[$key];

        }

        return $request;

    }

    public function has($key) {

        return isset($_REQUEST[$key]);

    }

    public function get($key){

        return $_REQUEST[$key];

    }

    public function array() {

        return $_REQUEST;

    }

    public function file($key) {

        return new UploadedFile($key);
        
    }

    public function validate($rules) {

        return (new Validator($this, $rules))->validate();
        
    }
}