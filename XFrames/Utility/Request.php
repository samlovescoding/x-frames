<?php

namespace XFrames\Utility;

class Request{
    public function __construct() {
        $request = $_REQUEST;
        foreach ($request as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function validate($rules){
        return (new Validator($_REQUEST, $rules))->validatedRequest();
    }
}