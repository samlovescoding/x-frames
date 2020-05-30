<?php

namespace XFrames\Database;

use XFrames\Blueprints\RouteParameter;

class Model implements RouteParameter{

    protected $table = null;
    protected $index = "id";
    protected $isLoaded = false;

    public $queryBuilder;

    public function __construct() {
        $this->queryBuilder = resolve(QueryBuilder::class);
    }

    public function create($data){
        $this->queryBuilder->insert($this->getTableName(), $data);
        return $this->map($data);
    }

    public function update($data, $where = []){
        if($this->isLoaded and $where == []){
            $where = [
                $this->getIndexColumn() => $this->getIndex()
            ];
        }else{
            throw new \Exception("Where parameters of query is missing.");
        }
        
        $this->queryBuilder->set($data)->where($where)->update($this->getTableName());
        return $this->map($data);
    }

    public function delete($where = []){
        if($this->isLoaded and $where == []){
            $where = [
                $this->getIndexColumn() => $this->getIndex()
            ];
        }else{
            throw new \Exception("Where parameters of query is missing.");
        }
        $this->queryBuilder->where($where)->delete($this->getTableName());
        return $this;
    }

    public function all(){
        $items = $this->queryBuilder->get($this->getTableName());
        return $this->mapItems($items);
    }

    public function find($index){
        
        $item = collect($this->queryBuilder->where([
            $this->getIndexColumn() => $index
        ])->get($this->getTableName()))->pop();

        return $this->map($item);
    }

    public function fetch(){
        return $this->all();
    }

    protected function map($item){
        $this->isLoaded = true;
        foreach ($item as $key => $value) {
            $this->{$key} = $value;
        }
        return $this;
    }

    protected function mapItems($items){
        $modelCollection = [];
        $modelClass = get_class($this);
        foreach ($items as $item) {
            $modelCollection[] = (new $modelClass)->map($item);
        }
        return $modelCollection;
    }

    protected function getTableName(){
        if($this->table == null){
            return $this->guessTableName();
        }else{
            return $this->table;
        }
    }

    protected function guessTableName(){
        $reflect = new \ReflectionClass($this);
        return str($reflect->getShortName())->lower()->snakeCase()->get();
    }

    protected function getIndexColumn(){
        return $this->index;
    }

    public function getIndex(){
        return $this->{$this->getIndexColumn()};
    }

    public function __call($name, $arguments){
        return $this->queryBuilder->{$name}(...$arguments);
    }

    public function getRouteObject($routeParameter){
        $className = get_class($this);
        return (new $className)->find($routeParameter);
    }

    public function getPolicy(){
        $policyMap = config("policies")->getMap();
        if(in_array(get_class($this), array_keys($policyMap))){
            return resolve($policyMap[get_class($this)]);
        }
        return null;
    }

}