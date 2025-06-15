<?php

namespace Classes;

class Person{
    private string $name;
    private int $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function __toString()
    {
        return "Name: " . $this->getName() . "\n" . "Age: " . $this->getAge();
    }

	public function getName(): string {
		return $this->name;
	}
	
	public function getAge(): int {
		return $this->age;
	}
}