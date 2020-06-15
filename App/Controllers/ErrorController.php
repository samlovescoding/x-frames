<?php


namespace App\Controllers;


class ErrorController
{

    public function unauthorizedAction(){

        return view("error", [
            "title" => "You are not authorized to do that."
        ]);

    }

    public function fileNotFound(){

        return view("error", [
            "title" => "File Not Found"
        ]);

    }

}