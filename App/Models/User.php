<?php

namespace App\Models;

use XFrames\Blueprints\Authenticatable;
use XFrames\Database\Model;

class User extends Model implements Authenticatable{
    
    public function attempt($username, $password){

        $this->where([

            $this->getUsernameColumn() => $username

        ]);

        $users = $this->fetch();

        if(count($users) != 1){

            return false;

        }else{

            return array_pop($users);

        }

    }

    public function getUsernameColumn(){

        return "username";

    }

    public function getPasswordColumn(){

        return "password";

    }

    public function validatePassword($password){

        return password_verify($password, $this->getPassword());

    }

}