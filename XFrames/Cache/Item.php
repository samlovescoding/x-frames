<?php


namespace XFrames\Cache;


use XFrames\Blueprints\Attributes;

class Item
{

    use Attributes;

    public function __construct($data = null, $timeToLive = null, $startedAt = null)
    {

        if($startedAt == null){

            $startedAt = time();

        }

        if($timeToLive == null){

            $timeToLive = config("cache")->getTimeToLive();

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