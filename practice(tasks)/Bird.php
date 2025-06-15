<?php

namespace Classes;
include_once 'Animal.php';

use Classes\Animal;

class Bird extends Animal{
    
    public function eat() {
        echo strtolower((new \ReflectionClass($this))->getShortName()) . " eating";
    }

    public function makeSound() {
        echo "bird say - car car car";
    }
}