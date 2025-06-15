<?php

namespace Classes;

class Employee extends Person{
    private string $position;
    private float $salary;

    public function __construct(string $name, int $age, float $salary, string $position)
    {
        parent::__construct($name, $age);
        $this->salary = $salary;
        $this->position = $position;
    }

    public function __toString()
    {
        return "Name: " . parent::getName() . "\n" . "Age: " . parent::getAge() . "\n" . "Position: " . $this->getPosition() . "\n" . "Salary (Cash): " . $this->getSalary() . "\n";
    }

	public function getPosition(): string {
		return $this->position;
	}

	public function getSalary(): float {
		return $this->salary;
	}
}