<?php

use XFrames\Library\Router;
use XFrames\Utility\Route;
use XFrames\Blueprints\Attributes;

require "../vendor/autoload.php";

class Blogs{
    use Attributes;
    public function __construct() {
        $this->hasAttribute("title");
        $this->hasAttribute("noOfArticles");
        $this->hasAttribute("author");
        $this->hasAttribute("dateCreated");
    }
}

function home(){
    $blog = resolve(Blogs::class);
    $blog->getTitle();
    echo "We are home";
}

Route::get("/", "home");

new Router;