<?php

namespace Classes;

require_once 'OutPutProperty.php';

use Interfaces\OutPutProperty;

class Vehicle implements OutPutProperty{
    private string $brand;
    private string $model;
    private int $year;

    public function __construct($brand, $model, $year) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

	public function getBrand(): string {
		return $this->brand;
	}
	
	public function setBrand(string $brand): self {
		$this->brand = $brand;
		return $this;
	}
	
	public function getModel(): string {
		return $this->model;
	}

	public function setModel(string $model): self {
		$this->model = $model;
		return $this;
	}

	public function getYear(): int {
		return $this->year;
	}
	
	public function setYear(int $year): self {
		$this->year = $year;
		return $this;
	}

    public function tostringAll(){
       return "Brand: " . $this->getBrand() . " Model: " . $this->getModel() . " Year prod: " . $this->getYear() . "\n";
    }
}