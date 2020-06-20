<?php

namespace App\Controllers\Authentication;

use App\Models\User;
use XFrames\Library\Authentication;

class LoginController
{

    public function handle()
    {

        request()->validate([
            "username" => "is_required|is_min:6",
            "password" => "is_required|is_min:6"
        ]);

        if(request()->failed()){
            return redirect("/login");
        }

        $user = new User;

        $userAttempt = $user->attempt(
            request()->username,
            request()->password
        );

        if ($userAttempt != false) {
            Authentication::remember($userAttempt);
            return redirect("/dashboard");
        } else {
            return redirect("/login");
        }

    }

    public function form()
    {

        return view("authentication/login");

    }
}