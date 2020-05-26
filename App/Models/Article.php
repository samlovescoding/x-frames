<?php

namespace App\Models;

use XFrames\Blueprints\RouteParameter;
use XFrames\Database\Model;

class Article extends Model{
    protected $table = "articles";
    public function link(){
        return "/blog/" . $this->id;
    }
}