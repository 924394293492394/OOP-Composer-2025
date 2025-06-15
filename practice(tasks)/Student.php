<?php

namespace Classes;

require_once 'OutPutProperty.php';

use Interfaces\OutPutProperty;
class Student implements OutPutProperty{
    
    private string $name;
    private int $age;
    private array $grades = [];

    public function __construct($name, $age, $grades){
        $this->name=$name;
        $this->age=$age;

        foreach ($grades as $grade){
            if($grade <= 10 && $grade >= 1){
                array_push($this->grades, $grade);
            }
        }
    }
    
    public function tostringAll() {
        echo "Name: " . $this->getName() . "\n";
        echo "Age: " . $this->getAge() . "\n";
        echo "Grades: ";
        foreach ($this->getGrades() as $grade){
            echo $grade . " ";
        }
    }
	public function getName(): string {
		return $this->name;
	}
	
	public function getAge(): int {
		return $this->age;
	}
	
	public function getGrades(): array {
		return $this->grades;
	}
}