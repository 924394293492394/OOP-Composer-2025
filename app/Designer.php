<?php

namespace App;
class Designer extends Worker {

    use HasRest;
    
    public function __construct($name, $age, $hours) {
        parent::__construct($name, $age, $hours);
        // $this->position = "dev30";
    }

    public function  work(){
        print_r('im designing');
    }

}