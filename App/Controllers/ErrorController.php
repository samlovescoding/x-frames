<?php


namespace App\Controllers;


class ErrorController
{

    public function unauthorizedAction(){

        echo "401 - The action is forbidden.";

    }

    public function fileNotFound(){

        echo "404 - File Not Found";

    }

}