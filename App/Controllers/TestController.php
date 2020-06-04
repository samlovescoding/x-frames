<?php

namespace App\Controllers;

class TestController{

    public function form(){

        view("test");

    }

    public function handle(){

        // Exactly Laravel Like Implementation

        $request = request()->validate([

            "input-1" => "is_required|is_alpha|is_min:6|is_max:128",

            "input-2" => "is_required|is_max:1024",

        ]);

        dd($request);

    }

}