<?php

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use XFrames\Exceptions\CallToUnknown;

class StrTest extends TestCase{

    public function test_get_and_set(){
        $str = str("Hello World");
        $this->assertTrue("Hello World" === $str->get());
        $str->set("World Hello");
        $this->assertTrue("World Hello" === $str->get());
    }
    
    public function test_startsWith_and_endsWith(){
        $str = str("Hello World");
        $this->assertTrue($str->startsWith("Hello") === true);
        $this->assertFalse($str->startsWith("Not Hello") === true);
        $this->assertTrue($str->endsWith("World") === true);
        $this->assertFalse($str->endsWith("Not World") === true);
    }

    public function test_shifts(){
        $str = str("this-is-a-cool-way-to-write");
        $this->assertTrue($str->getLeftShift("this") === "-is-a-cool-way-to-write");
        $this->assertTrue($str->getRightShift("write") === "-is-a-cool-way-to-");
    }

    public function test_affix(){
        $str = str("-is-a-cool-way-to-");
        $this->assertTrue($str->getPrefix("this") === "this-is-a-cool-way-to-");
        $this->assertTrue($str->getSuffix("write") === "this-is-a-cool-way-to-write");
    }

    public function test_contains(){
        $str = str("this-is-a-cool-way-to-write");
        $this->assertTrue($str->contains("cool"));
        $this->assertFalse($str->contains("hello"));
    }

    public function test_string_cases(){
        $str = str("hello");
        $this->assertTrue($str->getUpper() === "HELLO");
        $this->assertTrue($str->getLower() === "hello");
    }

    public function test_code_cases(){
        $this->assertEquals("hello_world", str("helloWorld")->getSnakeCase());
        $this->assertEquals("hello-world", str("helloWorld")->getKebabCase());

        $this->assertEquals("helloWorld", str("hello_world")->getCamelCase());
        $this->assertEquals("HelloWorld", str("hello_world")->getPascalCase());
    }

    public function test_length(){
        $this->assertEquals(5, str("Hello")->length());
    }

    public function test_before_and_after(){
        $this->assertEquals("before", str("before-something")->getBefore("-"));
        $this->assertEquals("after", str("something-after")->getAfter("-"));
    }

    public function test_unknown_call(){
        $this->expectException(CallToUnknown::class);

        str()->unknownMethodThatDefinitelyDoesNotExists();
    }
}
?>