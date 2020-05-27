<?php

namespace XFrames\Database\Generator;

trait Insert{

    public function insert(string $table, array $values){

        $insertQuery = $this->driver->getTemplate("insert");

        if(collect($values)->isAssociative()){
            $columns = "(" . implode(",", array_keys($values)) . ")";
        }else{
            $columns = "";
        }

        $queryParams = array_values($values);

        $values = str_repeat("?,", count(array_values($values))-1) . "?";

        $query = str($insertQuery)->substitute(compact("table", "columns", "values"));

        $this->query($query, $queryParams);

        return $this;
    }

}