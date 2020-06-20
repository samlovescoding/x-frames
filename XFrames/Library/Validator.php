<?php

namespace XFrames\Library;

use XFrames\Utility\ValidationRules;
use XFrames\Blueprints\Attributes;
use XFrames\Utility\ValidationError;

class Validator{
    
    use Attributes;

    public function __construct($request = null, array $rules = []) {

        //$this->hasAttribute("request");
        
        $this->hasAttribute("rules");

        $this->hasAttribute("failed");

        //$this->setRequest($request);

        $this->setRules($rules);

        $this->setFailed(false);

    }

    public function validate(){

        $validatedData = [];
        
        $request = request();

        $rules = $this->getRules();

        $validationRules = resolve(ValidationRules::class);

        foreach ($rules as $key => $value) {

            //if($request->has($key)) {
            if(true){

                if($request->has($key)){
                    $validatedData[$key] = $request->get($key);
                }else{
                    $validatedData[$key] = null;
                }

                $inputValidations = [];

                // If Rule is passed as a String
                if(is_string($rules[ $key ])){

                    $inputRules = str($rules[ $key ])->split("|");
                    
                    $stringInputValidations = $inputRules->flatMap(function($index, $rule) use ($validationRules, $key, $request) {
                        
                        $functionData = explode(":", $rule);

                        $function = $functionData[0];
                        if($request->has($key)){
                            $value = $request->get($key);
                        }else{
                            $value = null;
                        }
                        
                        $functionParams = [ $key , $value ];

                        if(count($functionData) == 2){

                            $functionParams = array_merge( $functionParams, explode(",", $functionData[1]));

                        }

                        return [$rule => call_user_func_array([$validationRules, $function], $functionParams)];

                    })->toArray();
                    
                    $inputValidations = array_merge($inputValidations, $stringInputValidations);

                }
                
                // If Rule is passed as a Callable
                if(is_callable($rules[ $key ])){

                    $inputValidations = array_merge($inputValidations, [

                        "validate" => $rules[ $key ]($request->{ $key })

                    ]);

                }

                foreach ($inputValidations as $rule => $didPass) {

                    if( $didPass !== true ){

                        unset($validatedData[ $key ]);

                        $value = $request->has($key) ? $request->get($key) : null;

                        $this->fail($key, $value, $didPass);

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