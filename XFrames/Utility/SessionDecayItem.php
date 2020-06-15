<?php

namespace XFrames\Utility;

use XFrames\Blueprints\Attributes;

class SessionDecayItem
{

    use Attributes;

    public function __construct($data = null, $timeToLive = null, $startedAt = null)
    {

        if($startedAt == null){

            $startedAt = time();

        }

        if($timeToLive == null){

            $timeToLive = config("session")->getDecayTime();

        }

        $this->hasAttribute("data", $data);

        $this->hasAttribute("startedAt", $startedAt);

        $this->hasAttribute("timeToLive", $timeToLive);

    }

    public function expired(){

        $expiryTime = $this->getStartedAt() + $this->getTimeToLive();

        if($expiryTime < time()){

            return true;

        }

        return false;

    }

    public function valid(){

        return ! $this->expired();

    }

}