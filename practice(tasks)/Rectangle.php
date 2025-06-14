<?php

namespace Classes;
require_once 'Shape.php';
use Classes\Shape;
class Rectangle extends Shape{

    private int $length;
    private int $width;

    public function __construct(int $length, int $width){
        $this->length = $length;
        $this->width = $width;
    }

    public function rectangleArea(): int{
        return $this->length * $this->width;
    }

    public function rectanglePerimeter(): int{
        return ($this->length + $this->width) * 2;
    }

    //test abstract
    public function calculateArea(){
        return $this->length * $this->width;
    }
}