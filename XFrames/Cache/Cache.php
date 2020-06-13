<?php


namespace XFrames\Cache;


use XFrames\Blueprints\CacheDriver;
use XFrames\Exceptions\CacheExpired;
use XFrames\Exceptions\CacheNotFound;

class Cache
{

    protected $cacheDriver;

    public function __construct(CacheDriver $cacheDriver = null)
    {
        if($cacheDriver == null){

            $driverName = config("cache")->getDriver();

            $cacheDriver = resolve($driverName);

        }

        $this->cacheDriver = $cacheDriver;

    }

    public function hashedKey(string $key){

        return md5( $key );

    }

    public function set(string $key, $value, $ttl = null)
    {

        $key = $this->hashedKey($key);

        $cachedValue = new Item($value);

        if($ttl != null){

            $cachedValue->setTimeToLive($ttl);

        }

        $this->cacheDriver->set($key, $cachedValue, $ttl);

    }

    public function getCachedItem(string $key){

        $unhashedKey = $key;

        $key = $this->hashedKey($key);

        if(!$this->has($unhashedKey)){

            throw new CacheNotFound("$unhashedKey was not found at storage/cache/$key.");

        }

        $cachedValue = unserialize($this->cacheDriver->get($key));

        if($cachedValue->expired()){

            throw new CacheExpired("$key cache has expired. Please refresh or delete it.");

        }

        return $cachedValue;

    }

    public function get(string $key)
    {

        return $this->getCachedItem($key)->getData();

    }

    public function remainingLifetime($key){

        $cachedItem = $this->getCachedItem($key);

        return ($cachedItem->getStartedAt() - time()) + $cachedItem->getTimeToLive();
    }


    public function has(string $key)
    {

        $key = $this->hashedKey($key);

        return $this->cacheDriver->has($key);

    }

    public function valid(string $key){

        $key = $this->hashedKey($key);

        if(! $this->cacheDriver->has($key)){

            return false;

        }

        $cachedValue = unserialize($this->cacheDriver->get($key));

        return $cachedValue->valid();

    }

    public function expired(string $key){

        $key = $this->hashedKey($key);

        return ! $this->valid($key);

    }

    public function delete(string $key)
    {

        $key = $this->hashedKey($key);

        $this->cacheDriver->delete($key);

        return $this;

    }

    public function refresh(string $key){

        $cachedValue = $this->getCachedItem($key);

        $this->set($key, $cachedValue->getData(), $cachedValue->getTimeToLive());

        return $this;

    }

}