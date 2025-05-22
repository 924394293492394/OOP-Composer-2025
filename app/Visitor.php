<?php

namespace App;
class Visitor {

    public string $name;
    public int $age;
    public array $hours;

    public function work(){
        print_r('im visiting');
    }

}