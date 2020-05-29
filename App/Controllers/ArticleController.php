<?php

namespace App\Controllers;

use App\Events\MountEvent;
use App\Models\Article;

class ArticleController{

    public function request($isCreateRequest = true){
        $validatedRequest = request()->validate([
            "title" => "required",
            "slug" => "required",
            "body" => "required",
        ]);
        $validatedRequest = array_merge($validatedRequest, [
            "excerpt" => "",
            "author_id" => 1,
            "poster" => "",
            "category" => "",
            "tags" => "",
            "updated_at" => date("Y-m-d H:i:s")
        ]);
        if($isCreateRequest){
            $validatedRequest = array_merge($validatedRequest, [
                "created_at" => date("Y-m-d H:i:s")
            ]);
        }
        return $validatedRequest;
    }

    public function index(){
        //(new Article)->all()
        
        
        resolve("CustomString");

        $articles = [];
        $title = "Keemstar";
        view("articles/index", compact("articles", "title"));

    }

    public function view(Article $article){

        view("articles/view", compact("article"));
    }

    public function create(){

        view("articles/create");
    }

    public function store(){
        (new Article)->create(
            $this->request()
        );

        redirect("/blog");

    }

    public function edit(Article $article){

        view("articles/edit", compact("article"));

    }
    
    public function update(Article $article){

        $article->update(
            $this->request()
        );

        redirect($article->link());
    }

    public function delete(Article $article){

        $article->delete();

        redirect("/blog");
    }

}