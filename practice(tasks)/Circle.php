<?php

namespace Classes;

class Circle {

    private float $radius;

    public function __construct(float $radius){
        $this->radius = $radius;
    }

    public function circleArea(): float{
        return pow($this->radius, 2) * pi();
    }

    public function circleLength(): float{
        return 2 * $this->radius * pi();
    }
}