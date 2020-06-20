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
            // Yes Yes, I know thats not a good way to implement middleware errors.
            // Yes there should be a middleware chain but this is so easy to implement
            // and until each middleware renders a single view, it's OK. We dont need
            // complex architectures to solve complex problems. We just need to divide
            // the problem.
        }

    }

}