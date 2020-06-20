<?php

namespace XFrames\Tests;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase{

    private function assertEqualsToArray($expected, $actual, string $message = ''){
        $this->assertEquals($expected, $actual->getArray(), $message);
    }

    public function test_empty_collection(){
        $this->assertEqualsToArray([], collect());
    }

    public function test_collection_setter_getter(){
        $this->assertEqualsToArray([1,2,3], collect([1,2,3]));
    }

    public function test_has(){
        $this->assertTrue(collect([0,1,2,3])->has(0));
        $this->assertFalse(collect([1,2,3])->has(0));
    }

    public function test_associative(){
        $this->assertFalse(collect([1,2,3])->isAssociative());
    }

    public function test_map(){
        $this->assertEqualsToArray([4, 9, 16], collect([2,3,4])->map(function ($key, $value){
            return $value * $value;
        }));
    }

    public function test_merge(){
        $this->assertEqualsToArray([1,2,3], collect([1,2])->merge([3]));
    }

    public function test_join(){
        $this->assertEquals(str("hello world"), collect(["hello", "world"])->join(" "));
    }

    public function test_push(){
        $this->assertEqualsToArray([1,2,3], collect([1,2])->push(3));
    }

    public function test_pop(){
        $this->assertEquals(3, collect([1,2,3])->pop());
        $this->assertEqualsToArray([1,2], collect([1,2,3])->popAndDispose());
    }

    public function test_filter(){
        $this->assertEquals([15, 20], collect([5, 10, 15, 20])->filter(function($value){
            if($value > 10){
                return true;
            }else{
                return false;
            }
        })->values());
    }

    public function test_in(){
        $this->assertTrue(collect([1,2,3])->in(1));
        $this->assertFalse(collect([1,2,3])->in(0));
    }

    public function test_length(){
        $this->assertEquals(5, collect([1,2,3,4,5])->length());
    }

    public function test_hasItems(){
        $this->assertTrue(collect([1,2,3])->hasExactly(3));
        $this->assertTrue(collect([1,2,3])->hasAtleast(3));
    }

    public function test_flat(){
        $testArray = [
            "id" => 5,
            "name" => "samlovescoding"
        ];

        $this->assertEqualsToArray($testArray, collect($testArray)->map(function($index, $value){
            return [$index => $value];
        })->flat());
    }

    public function test_flatMap(){
        $testArray = [
            "id" => 5,
            "name" => "samlovescoding"
        ];

        $this->assertEqualsToArray($testArray, collect($testArray)->flatMap(function($index, $value){
            return [$index => $value];
        }));
    }
}
?>