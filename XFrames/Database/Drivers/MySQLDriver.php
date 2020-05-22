<?php

namespace XFrames\Database\Drivers;

use XFrames\Blueprints\DatabaseDriver;

class MySQLDriver extends DatabaseDriver{

    public $connection;
    public $statement;
    public $templates = [
        // Main Queries
        "insert" => "INSERT INTO {table} {columns} VALUES ({values});",
        "select" => "SELECT {columns} FROM {table} {where} {limit} {order};",
        "update" => "UPDATE {table} SET {columns} {where};",
        "delete" => "DELETE FROM {table} {where};",

        // Sub Queries
        "where" => "WHERE {subquery}",
        "limit" => "LIMIT {offset}, {limit}",
        "order" => "ORDER BY {column} {order}"
    ];

    public function getTemplate(string $key){
        return $this->templates[$key];
    }

    public function connect($host = null, $username = null, $password = null, $databaseName = null){

        if($host == null){
            $host = config("database")->getHost();
        }
        if($username == null){
            $username = config("database")->getUsername();
        }
        if($password == null){
            $password = config("database")->getPassword();
        }
        if($databaseName == null){
            $databaseName = config("database")->getDatabase();
        }

        $this->connection = new \mysqli($host, $username, $password, $databaseName);

        return $this;
    }
    public function query(string $query, $params){

        $this->execute($query, $params);

        return $this->statement->get_result()->fetch_all(MYSQLI_ASSOC);

    }
    public function execute(string $query, $params){

        if(!$statement = $this->connection->prepare($query)){
            throw new \Exception($this->errors());
        }

        if($params != [])
        $statement->bind_param(str_repeat("s", count($params)), ...$params);

        $statement->execute();

        $this->statement = $statement;

        return $this;

    }
    public function getAffectedRows(){

        return $this->statement->affected_rows;

    }
    public function getLastInsertID(){

        return $this->connection->insert_id;

    }
    public function errors(){

        return $this->connection->error;

    }
    public function close(){

        $this->connection = null;

    }
}