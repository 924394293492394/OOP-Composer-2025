<?php

abstract class Worker{

    public string $name;
    public int $age;
    public array $hours;
    protected string $position = "worker1";

    public function __construct($name, $age, $hours) {
        $this->name = $name;
        $this->age = $age;
        $this->hours = $hours;
    }


}