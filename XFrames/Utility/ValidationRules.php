<?php

namespace XFrames\Utility;

class ValidationRules{

    protected $imageTypes = [
        "png", "jpg", "jpeg", "gif",
        "svg"
    ];

    public function is_required($key, $value){
        if(isset($_REQUEST[$key]) && $_REQUEST[$key] == $value){
        
            return true;
        
        }
        
        return "$key is a required field.";

    }

    public function is_alpha($key, $value){
        
        if(ctype_alpha($value)){
            
            return true;

        }

        return "$key must contain only alphabets.";

    }

    public function is_alpha_num($key, $value){

        if(ctype_alnum($value)){

            return true;

        }

        return "$key must contain only alphabets and numbers.";

    }

    public function is_num($key, $value){

        if(ctype_digit($value)){

            return true;

        }

        return "$key must contain only numbers.";

    }

    public function is_file($key, $value){

        if(isset($_FILES[$key])){

            return true;

        }

        return "$key file was not uploaded.";

    }

    public function is_min($key, $value, $min){

        if(strlen($value) > $min){

            return true;

        }

        return "$key should be atleast $min characters.";

    }

    public function is_max($key, $value, $max){

        if(strlen($value) < $max){

            return true;

        }

        return "$key should be utmost $max characters.";

    }

    public function is_min_max($key, $value, $min, $max){

        if(strlen($value) > $min){

            return true;

        }

        if(strlen($value) < $max){

            return true;

        }

        return "$key should be atleast $min and utmost $max characters.";

    }

    public function has_filesize($key, $value, $max){

        if(isset($_FILES[$key])){

            if($_FILES[$key]["size"] < $max){

                return true;

            }

            return "$key file must not exceed $max byte size.";

        }

        return "$key file was not uploaded.";
    }

    public function is_image($key, $value){

        if(isset($_FILES[$key])){

            $fileParts = explode(".", $_FILES[$key]["name"]);

            $extension = array_pop($fileParts);

            if(in_array($extension, $this->imageTypes)){

                return true;

            }

            $allowedTypes = implode(", ", $this->imageTypes);

            return "$key file must be one of type $allowedTypes.";

        }

        return "$key image was not uploaded.";

    }

    public function has_extension($key, $value, $extension){

        if(isset($_FILES[$key])){

            $fileParts = explode(".", $_FILES[$key]["name"]);

            $fileExtension = array_pop($fileParts);

            if($fileExtension == $extension){

                return true;

            }

            return "$key file must be of type $extension.";

        }

        return "$key file was not uploaded.";

    }

}