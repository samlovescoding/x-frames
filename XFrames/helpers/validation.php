<?php

function validate_required($key, $value){
    if(isset($_REQUEST[$key]) and $_REQUEST[$key] == $value){
        return true;
    }
    return false;
}