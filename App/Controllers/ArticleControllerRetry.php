<?php

namespace App\Controllers;

use App\Models\Article;

class ArticleController{

    public function validate($isEditRequest = false){
        $validatedRequest = request()->validate([
            "title" => "required",
            "slug" => "required",
            "body" => "required"
        ]);

        $validatedRequest = array_merge($validatedRequest, [
            "feature" => "",
            "user_id" => "2",
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        if(!$isEditRequest){
            $validatedRequest = array_merge($validatedRequest, [
                "created_at" => date("Y-m-d H:i:s")
            ]);
        }
        return $validatedRequest;
    }

    public function index(Article $article){
        $articles = (new Article)->all();

        view("articles/index", compact("articles"));
    }

    public function view(Article $article){
        view("articles/view", compact("article"));
    }

    public function create(){
        
        view("articles/create");

    }

    public function store(){
        
        (new Article)->create($this->validate());
        redirect("/blog");
    }

    public function edit(Article $article){
        
        view("articles/edit", compact("article"));
    }

    public function update(Article $article){

        $article->update($this->validate(true));

        redirect("/blog/" . $article->slug . "/edit");
    }

    public function destroy(Article $article){
        $article->delete();
        redirect("/blog");
    }

}