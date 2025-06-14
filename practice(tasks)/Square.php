<?php

namespace Classes;

require_once 'Resizable.php';

use Interfaces\Resizable;

class Square implements Resizable{
    private $side;

    public function __construct($side) {
        $this->side = $side;
    }

    public function getArea() {
        return pow($this->side, 2);
    }

    public function getSide() {
        return $this->side;
    }
    public function resize($percentage) {
        $this->side = $this->side * ($percentage / 100);
    }
}