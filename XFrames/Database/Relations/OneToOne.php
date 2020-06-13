<?php

namespace XFrames\Database\Relations;

trait OneToOne
{

    protected function hasOne($model, $foreignKey = null, $foreignValue = null){

        $model = $this->resolveModel($model);

        if($foreignKey == null) {

            $myTableName = $this->getTableName();

            $foreignKey = $myTableName . "_" . $this->getIndexColumn();

        }

        if($foreignValue == null){

            $foreignValue = $this->getIndex();

        }

        return $model->where([

            $foreignKey => $foreignValue

        ])->first();

    }

    protected function belongsTo($model, $foreignKey = null, $foreignValue = null){

        $model = $this->resolveModel($model);

        if($foreignKey == null) {

            $myTableName = $this->getTableName();

            $foreignKey = $myTableName . "_" . $this->getIndexColumn();

        }

        if($foreignValue == null){

            $foreignValue = $this->getIndex();

        }

        return $model->where([

            $foreignKey => $foreignValue

        ])->first();

    }

}