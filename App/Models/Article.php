<?php

namespace App\Models;

use XFrames\Database\Model;

class Article extends Model{
    protected $table = "articles";
    protected $index = "slug";
    protected $columns = [
        "id",
        "title",
        "slug",
        "blog"
    ];
    public function link(){
        return "/blog/" . $this->getIndex();
    }
}