<?php

namespace XFrames\Library;

use XFrames\Utility\ValidationRules;
use XFrames\Blueprints\Attributes;
use XFrames\Utility\ValidationError;

class Validator{
    
    use Attributes;

    public function __construct($request = null, array $rules = []) {

        $this->hasAttribute("request");
        
        $this->hasAttribute("rules");

        $this->hasAttribute("failed");

        $this->setRequest($request);

        $this->setRules($rules);

        $this->setFailed(false);

    }

    public function validate(){

        $validatedData = [];
        
        $request = $this->getRequest();

        $rules = $this->getRules();

        $validationRules = resolve(ValidationRules::class);

        foreach ($rules as $key => $value) {

            if($request->has($key)) {

                $validatedData[$key] = $request->{ $key };

                $inputValidations = [];

                if(is_string($rules[ $key ])){

                    $inputRules = str($rules[ $key ])->split("|");

                    $stringInputValidations = $inputRules->flatMap(function($index, $rule) use ($validationRules, $key, $request) {
                        
                        $functionData = explode(":", $rule);

                        $function = $functionData[0];

                        $value = $request->get($key);

                        $functionParams = [ $key , $value ];

                        if(count($functionData) == 2){

                            $functionParams = array_merge( $functionParams, explode(",", $functionData[1]));

                        }

                        return [$rule => call_user_func_array([$validationRules, $function], $functionParams)];

                    })->toArray();

                    $inputValidations = array_merge($inputValidations, $stringInputValidations);

                }

                if(is_callable($rules[ $key ])){

                    $inputValidations = array_merge($inputValidations, [

                        "validate" => $rules[ $key ]($request->{ $key })

                    ]);

                }

                foreach ($inputValidations as $rule => $didPass) {
                    
                    if( $didPass !== true ){

                        unset($validatedData[ $key ]);

                        $this->fail($key, $request->{ $key }, $didPass);

                        $this->setFailed(true);

                    }

                }

            }

        }
        
        return $validatedData;
    
    }

    public function fail($key, $value, $failedRule){

        $validationError = resolve(ValidationError::class);

        $validationError->setKey($key);

        $validationError->setValue($value);

        $validationError->setRule($failedRule);

        emit(
            config("events")->getValidationError(), 
            $validationError
        );

    }

    public function failed(){

        return $this->getFailed();

    }

}