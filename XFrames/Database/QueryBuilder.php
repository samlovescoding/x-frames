<?php

namespace XFrames\Database;

use XFrames\Blueprints\Attributes;
use XFrames\Blueprints\DatabaseDriver;
use XFrames\Database\Drivers\MySQLDriver;
use XFrames\Database\Generator\Insert;
use XFrames\Database\Generator\Select;
use XFrames\Database\Generator\Update;
use XFrames\Database\Generator\Delete;

class QueryBuilder{

    use Insert, Select, Update, Delete,  Attributes;

    public DatabaseDriver $driver;
    public bool $autoExecute = true;
    public bool $autoReset = true;

    public function __construct(DatabaseDriver $driver = null) {

        if($driver == null){
            $this->driver = resolve(MySQLDriver::class);
            $this->driver->connect();
        }

        $this->hasAttribute("currentQuery");
        $this->hasAttribute("currentQueryParams");
        $this->hasAttribute("tableName");
        $this->resetQuery();
    }

    public function autoExecute(){
        if($this->autoExecute){
            $this->execute();
        }
        
        return $this;
    }

    public function execute(){
        $this->driver->execute(
            $this->getCurrentQuery(),
            $this->getCurrentQueryParams()
        );
        if($this->autoReset){
            $this->resetQuery();
        }
        return $this;
    }

    public function result(){
        $result = $this->driver->query(
            $this->getCurrentQuery(),
            $this->getCurrentQueryParams()
        );
        if($this->autoReset){
            $this->resetQuery();
        }
        return $result;
    }

    public function resetQuery(){
        $this->setCurrentQuery("");
        $this->setCurrentQueryParams([]);
        
        return $this;
    }

    public function replaceCurrentQueryTemplate($what, $with){
        $this->setCurrentQuery(
            str_replace("{" . $what . "}", $with, $this->getCurrentQuery())
        );
        return $this;
    }

    public function query($query, $params){
        $this->setCurrentQuery($query);
        $this->setCurrentQueryParams($params);
        $this->autoExecute();
    }

    public function escape($string){
        return $this->driver->connection->real_escape_string($string);
    }
}