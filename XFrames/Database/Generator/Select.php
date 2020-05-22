<?php

namespace XFrames\Database\Generator;

trait Select{

    public array $selectColumns = ["*"];

    public array $whereColumns = [];

    public int $limitColumns = -1;

    public int $offsetColumns = 0;

    /*
     *
     * Publicly Accessible Function
     * 
     * Use these functions to generate select queries.
     * 
     */

    public function get(string $table){

        $selectQuery = $this->driver->getTemplate("select");

        $selectQuery = str($selectQuery)->substitute([
            "columns" => $this->columnsSubQuery(),
            "table" => $table,
            "where" => $this->whereSubQuery(),
            "limit" => $this->limitSubQuery()
        ])->get();

        $this->setCurrentQuery($selectQuery);

        return $this->result();
    }

    public function select(){

        $this->selectColumns = func_get_args();
        if($this->selectColumns == []){
            $this->selectColumns = "*";
        }
        return $this;
    }

    public function where(array $whereColumns = []){
        $this->whereColumns = $whereColumns;
        return $this;
    }

    public function limit(int $limit){
        $this->limitColumns = $limit;
        return $this;
    }

    public function offset(int $offset){
        $this->offsetColumns = $offset;
        return $this;
    }

    /*
     *
     * SubQuery Generators
     * 
     * These protected function generate subqueries for the 
     * main select query.
     * 
     */

    protected function columnsSubQuery(){
        return implode(", ", $this->selectColumns);
    }

    protected function whereSubQuery($glue = "AND"){
        $whereQuery = $this->driver->getTemplate("where");

        if($this->whereColumns == []){
        
            return "";
        
        }else{
        
            $whereSubQuery = "";

            foreach ($this->whereColumns as $key => $value) {
                if(substr($key, 0, 3) == "OR "){
                    $glue = "OR";
                }
                if(substr($key, 0, 4) == "AND "){
                    $glue = "AND";
                }
                $operator = "=";
                if(str($key)->contains(" ")){
                    $keyParts = explode(" ", $key);
                    $key = $keyParts[0];
                    $operator = $keyParts[1];
                }
                $whereSubQuery .= $key . " $operator ? $glue ";
                // if(substr($key, -1) == "="){
                //     $whereSubQuery .= $key . " ? $glue ";
                // }else{
                //     $whereSubQuery .= $key . "= ? $glue ";
                // }
                $this->setCurrentQueryParams(
                    array_merge(
                        $this->getCurrentQueryParams(),
                        [$value]
                    )
                );
            }
            $whereSubQuery = substr($whereSubQuery, 0, strlen($whereSubQuery) - 4);
            return str($whereQuery)->substitute([
                "subquery" => $whereSubQuery
            ]);
        
        }
    }

    protected function limitSubQuery(){
        if($this->limitColumns == -1){
            return "";
        }

        $limitSubQuery = $this->driver->getTemplate("limit");
        
        $limitSubQuery = str($limitSubQuery)->substitute([
            "limit" => $this->limitColumns,
            "offset" => $this->offsetColumns
        ])->get();

        return $limitSubQuery;

    }

}