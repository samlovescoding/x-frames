<?php

namespace XFrames\Database\Generator;

trait Update{

    public array $updateColumns;

    public function update(string $table){

        $updateQuery = $this->driver->getTemplate("update");

        $updateQuery = str($updateQuery)->substitute([
            "table" => $table,
            "columns" => $this->getSetColumnsSubQuery(),
            "where" => $this->whereSubQuery(),
        ]);

        $this->setCurrentQuery($updateQuery);

        $this->autoExecute();

        return $this;
    }

    public function set(array $updateColumns){
        $this->updateColumns = $updateColumns;
        return $this;
    }

    protected function getSetColumnsSubQuery(){
        $setColumnsSubQuery = "";
        foreach ($this->updateColumns as $key => $value) {
            $setColumnsSubQuery .= "$key = ?,";
            $this->setCurrentQueryParams(
                array_merge(
                    $this->getCurrentQueryParams(),
                    [ $value ]
                )
            );
        }
        $setColumnsSubQuery = rtrim($setColumnsSubQuery, ",");
        return $setColumnsSubQuery;
    }
}