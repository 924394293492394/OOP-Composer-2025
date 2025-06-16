<?php

namespace Classes;

class Calculator{
    private $result = 0;

	public function getResult() {
		return $this->result;
	}

    public function add(...$args) {
        $this->result += array_sum($args);
    }

    public function subtract($num) {
        $this->result -= $num;
    }
}