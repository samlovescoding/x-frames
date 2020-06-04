<?php

namespace XFrames\Blueprints;

trait Mapper{

    protected function memberMapsTo(array $dictionary){

        foreach ($dictionary as $key => $value) {

            $this->{$key} = $value;

        }

    }

}