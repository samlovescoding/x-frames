<?php

namespace App\Controllers;

use XFrames\Database\QueryBuilder;

class HomeController{
    public function index(){
        echo "<html><body><script src='main.js'></script><button>Press Me</button></body></html>";
    }

    public function guest(){
        $db = new QueryBuilder;
        // $db->insert("users", [
        //     "name" => "Arsh Jain",
        //     "username" => "arshjn",
        //     "email" => "arshjn@gmail.com",
        //     "password" => password_hash("123456", PASSWORD_DEFAULT)
        // ]);
        

        $db ->where([
                "name" => "Sampan"
            ])
            ->set([
                "name" => "Sampan Verma"
            ])
            ->update("users");
        
        $db->autoReset = false;
        $rows = $db ->select("name", "email", "username")
            ->where([
                "name !=" => "Sampan"
            ])
            ->get("users");
        dd($db->getCurrentQuery());
        
        
    }

    public function error(){
        echo "404 Page Not Found";
    }
}
