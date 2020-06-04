<?php

namespace App\Listeners;

use XFrames\Blueprints\Listener;
use XFrames\Database\QueryBuilder;
use XFrames\Utility\Session;

class BindingsListener implements Listener{

    public function singletons(){

        singleton(Session::class);
        singleton(View::class);
        singleton(QueryBuilder::class);

    }

    public function handle($event){

        $this->singletons();
        
    }

}