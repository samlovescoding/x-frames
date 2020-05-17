<?php

namespace XFrames\Blueprints;

trait Mapper{
    public function memberMapsTo(array $dictionary){
        foreach ($dictionary as $key => $value) {
            $this->{$key} = $value;
        }
    }
}