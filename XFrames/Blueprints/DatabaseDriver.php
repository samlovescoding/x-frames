<?php

namespace XFrames\Blueprints;

abstract class DatabaseDriver{

    abstract public function connect();

    abstract public function query(string $query, $params);

    abstract public function execute(string $query, $params);

    abstract public function getAffectedRows();

    abstract public function getLastInsertID();

    abstract public function errors();

    abstract public function close();

    abstract public function getTemplate(string $key);

}