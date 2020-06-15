<?php

namespace App\Middlewares;

class ThrottleRequests
{

    public function handle(){

        $throttlePages = config("middlewares")->getThrottlePages();

        $throttlerKey = config("session")->getThrottlerKey();

        if(session()->validDecay($throttlerKey)){
            $count = session()->getDecay($throttlerKey);
            $count ++;
            session()->updateDecay($throttlerKey, $count);
        }else{
            $count = 1;
            session()->setDecay($throttlerKey, $count, 60);
        }

        if($count > $throttlePages){
            view("error", [
                "title" => "Too many request. Please wait some time before retrying."
            ])->render();
            die();
        }

    }

}