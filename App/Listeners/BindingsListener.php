<?php

namespace App\Listeners;

use XFrames\Blueprints\Listener;
use XFrames\Database\QueryBuilder;
use XFrames\Utility\Request;
use XFrames\Utility\Session;

class BindingsListener implements Listener{

    public function singletons(){

        singleton(Session::class);
        
        singleton(View::class);
        
        singleton(QueryBuilder::class);
        
        singleton(Request::class);

    }

    public function handle($event){

        $this->singletons();
        
    }

}