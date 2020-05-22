<?php

namespace XFrames\Database\Generator;

trait Delete{
    
    public function delete(string $table){

        $whereSubQuery = $this->whereSubQuery();

        $deleteQuery = $this->driver->getTemplate("delete");

        $deleteQuery = str($deleteQuery)->substitute([
            "table" => $table,
            "where" => $whereSubQuery
        ])->get();

        $this->setCurrentQuery($deleteQuery);

        $this->autoExecute();

        return $this;
    }

}