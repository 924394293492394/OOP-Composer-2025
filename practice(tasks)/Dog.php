<?php

namespace Classes;
include_once 'Animal.php';

use Classes\Animal;

class Dog extends Animal{
    
    public function eat() {
        echo strtolower((new \ReflectionClass($this))->getShortName()) . " eating";
    }

    public function makeSound() {
        echo "dog say - ow ow ow";
    }
}