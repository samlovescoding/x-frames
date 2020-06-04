<?php

namespace App\Controllers\Authentication;

use App\Models\User;

class RegisterController{

    public function validateRequest(){

        return request()->validate([

            "name" => "required",

            "email" => "required",

            "username" => "required",

            "password" => "required"

        ]);

    }

    public function handle(){

        $validatedRequest = $this->validateRequest();

        $validatedRequest = array_merge($validatedRequest, [

            "created_at" => date("Y-m-d H:i:s"),

            "updated_at" => date("Y-m-d H:i:s")

        ]);

        (new User)->create($validatedRequest);
        
        redirect("/login");

    }

    public function form(){

        view("authentication/register", [

            "title" => "Registeration"

        ]);

    }

}