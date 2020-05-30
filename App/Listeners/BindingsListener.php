<?php

namespace App\Listeners;

use XFrames\Blueprints\Listener;
use XFrames\Utility\Session;

class BindingsListener implements Listener{

    public function handle($event){

        singleton(Session::class);

    }

}