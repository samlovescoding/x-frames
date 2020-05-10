<?php

function autoload_in($directory){
    foreach (glob("../src/$directory/*.php") as $filename) {
        require $filename;
    }
}

function require_in($directory){
    require "../src/$directory/include.php";
}


autoload_in("Traits");
autoload_in("Utility");
autoload_in("Library");
autoload_in("Components");

require_in("helpers");
