<?php

namespace XFrames\Utility;

class Validator{
    
    public $request;
    public $rules;

    public function __construct(array $request = [], array $rules = []) {
        $this->request = $request;
        $this->rules = $rules;
        return $this->validatedRequest();
    }

    public function validatedRequest(){
        $validatedData = [];
        foreach ($this->rules as $key => $value) {
            $validatedData[$key] = $this->request[$key];

        }
        return $validatedData;
    }

    public function validateInput($key, $value, $rules){
        $validated = true;
        $failedRule = null;
        foreach (explode("|", $rules) as $rule) {
            if(!"validate_" . $rule($value)){
                $validated = false;
                $failedRule = $rule;
            }
        }

        if($validated){
            return $value;
        }
        return $this->onValidationFails($key, $value, $failedRule);
    }

    public function onValidationFails(){
        die("Cannot process request due to validation errors.");
    }
}