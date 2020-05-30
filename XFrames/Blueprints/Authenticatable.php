<?php

namespace XFrames\Blueprints;

interface Authenticatable{

    public function attempt($username, $password);

    public function getUsernameColumn();

    public function getPasswordColumn();

    public function validatePassword($password);

}