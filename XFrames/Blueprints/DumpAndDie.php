<?php

namespace XFrames\Blueprints;

trait DumpAndDie{
    public function dd(){
        dd($this);
    }
}