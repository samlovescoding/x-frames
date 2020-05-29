<?php

namespace App\Listeners;

use XFrames\Blueprints\Listener;
use XFrames\Utility\Str;

class BindingsListener implements Listener{

    public function handle($event){

        bind("CustomString", Str::class);

    }

}