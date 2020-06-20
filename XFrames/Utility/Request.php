<?php

namespace XFrames\Utility;

use XFrames\Blueprints\Mapper;
use XFrames\FileSystem\UploadedFile;
use XFrames\Library\Validator;

class Request{

    use Mapper;

    public function __construct(Validator $validator) { 

        $this->memberMapsTo($_REQUEST);

        $this->validator = $validator;

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

    public function hasFile($key){
        return isset($_FILES[$key]);
    }

    public function file($key) {

        return new UploadedFile($key);
        
    }

    public function validate($rules) {

        $this->validator->setRequest($this);
        
        $this->validator->setRules($rules);

        return $this->validator->validate();

    }

    public function failed(){

        return $this->validator->failed();

    }

    public function passed(){

        return !$this->validator->failed();

    }

}