<?php

namespace App;
abstract class Worker implements WorkerInterface {

    public string $name;
    public int $age;
    public array $hours;

    protected string $position = "worker1";
    private int $experience;
    //магические методы у которых в начале __

    public function __construct($name, $age, $hours) {
        $this->name = $name;
        $this->age = $age;
        $this->hours = $hours;
    }

    public function getHours(): array{
        return $this->hours;
    }

    public function setPosition($value){
         $this->position = $value;
    }

    public function getPosition(): string {
        return $this->position;
    }

    public function getExperience(): int{
        return $this->experience;
    }

}