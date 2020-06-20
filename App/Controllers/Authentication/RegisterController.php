<?php

namespace App\Controllers\Authentication;

use App\Models\User;

class RegisterController{

    public function handle(){
        $validatedRequest = request()->validate([
            "name" => "is_required|is_min:6|is_max:64",
            "email" => "is_required|is_min:6|is_max:64",
            "username" => "is_required|is_min:6|is_max:32",
            "password" => "is_required|is_min:6|is_max:256"
        ]);

        if(request()->failed()){
            return redirect("/register");
        }
        
        $validatedRequest = array_merge($validatedRequest, [
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        (new User)->create($validatedRequest);        
        return redirect("/login");
    }

    public function form(){

        return view("authentication/register", [
            "title" => "Registeration"
        ]);

    }

}