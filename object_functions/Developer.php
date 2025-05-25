<?php

require_once("./Workerr.php");

class Developer extends Workerr{
    
    public function __construct($name, $age, $hours) {
        parent::__construct($name, $age, $hours);
        $this->position = "dev30";
    }

    public function  work(){
        print_r('im developing');
    }

    public function  now_position(){
        print_r($this->position);
    }
}