<?php

namespace XFrames\Tests;

use PHPUnit\Framework\TestCase;

$_REQUEST = array(
    "title" => "A",
    "slug" => "B",
    "body" => "C"
);

class RequestTest extends TestCase{

    public function test_only(){
        $this->assertEquals([
            "title" => "A"
        ], request()->only("title"));
    }

    public function test_has(){
        $this->assertTrue(request()->has("title"));
        $this->assertFalse(request()->has("something"));
    }

    public function test_get(){
        $this->assertEquals("A", request()->get("title"));
    }

    public function test_array(){
        $this->assertEquals($_REQUEST, request()->array());
    }

}
?>