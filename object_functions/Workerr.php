<?php

require_once("./Enums/Character.php");
class Workerr {

    public string $name;
    public int $age;
    protected array $hours;
    private $possibility;

    protected string $position = "worker1";

    public function __construct($name, $age, $hours) {
        $this->name = $name;
        $this->age = $age;
        $this->hours = $hours;
        $this->possibility = Character::Possibility;
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

}