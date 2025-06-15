<?php

namespace Classes;
include_once "Comparable.php";

use Interfaces\Comparable;

class Product implements Comparable{
    private string $name;
    private float $cost;

    public function __construct(string $name, float $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

	public function getName(): string {
		return $this->name;
	}
	
	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}
	
	public function getCost(): float {
		return $this->cost;
	}
	
	public function setCost(float $cost): self {
		$this->cost = $cost;
		return $this;
	}

    public function compareTo(Product $other) {
        $result1 = $this->getCost() > $other->getCost();
        $result2 = $this->getCost() < $other->getCost();
        if($result1 && !$result2)
            echo "First product worth more";
        else if(!$result1 && $result2)
            echo "Second product worth more";
        else if(!$result1 && !$result2)
            echo "Cost is equal!";
        }

    public static function compareObjects(Product $first, Product $second) {
        $result1 = $first->getCost() > $second->getCost();
        $result2 = $first->getCost() < $second->getCost();
        if($result1 && !$result2)
            echo "First product worth more";
        else if(!$result1 && $result2)
            echo "Second product worth more";
        else if(!$result1 && !$result2)
            echo "Cost is equal!";
        }
}