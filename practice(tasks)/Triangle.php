<?php

namespace Classes;
require_once 'Shape.php';
class Triangle extends Shape{

    private int $side;
    private int $height;

    public function __construct(int $side, int $height){
        $this->side = $side;
        $this->height = $height;
    }

    public function calculateArea():float{
        return 0.5 * $this->side * $this->height;
    }
}