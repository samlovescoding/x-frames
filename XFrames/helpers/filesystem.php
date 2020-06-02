<?php

use XFrames\FileSystem\Storage;

function storage($storage){
    
    return Storage::folder($storage);
    
}