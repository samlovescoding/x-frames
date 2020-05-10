<?php

use XFrames\Library\x as ComponentLibrary;

singleton(ComponentLibrary::class);

function x(){
    if(func_num_args() == 1){
        $componentName = func_get_arg(0);
        return call_user_func(ComponentLibrary::class . "::" . $componentName);
    }
    return resolve(ComponentLibrary::class);
}