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

        $this->setRequest($request);

        $this->setRules($rules);

    }

    public function validate(){

        $validatedData = [];
        
        $request = $this->getRequest();

        $rules = $this->getRules();

        $validationRules = resolve(ValidationRules::class);

        foreach ($rules as $key => $value) {

            if($request->has($key)) {

                $validatedData[$key] = $request->{ $key };

                $inputRules = str($rules[ $key ])->split("|");

                $inputValidations = $inputRules->flatMap(function($index, $rule) use ($validationRules, $key, $request) {
                    
                    $functionData = explode(":", $rule);

                    $function = $functionData[0];

                    $value = $request->get($key);

                    $functionParams = [ $key , $value ];

                    if(count($functionData) == 2){

                        $functionParams = array_merge( $functionParams, explode(",", $functionData[1]));

                    }

                    return [$rule => call_user_func_array([$validationRules, $function], $functionParams)];

                })->toArray();

                dd($inputValidations);



            } else {

                //check is_required

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

}