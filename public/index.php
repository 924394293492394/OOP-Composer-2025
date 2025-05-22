<?php

use App\Salary;

require_once('../vendor/autoload.php');

// $worker = new App\Worker('Boris', 20, [5, 6, 10]);
$developer = new App\Developer('Alex', 17, [5, 4, 2]);
// $visitor = new App\Visitor();

// $worker->work();
// $visitor->work();

// var_dump($worker);
$developer->setPosition("developer_30");
echo $developer->getPosition();
echo $developer->rest();

//-----------------------------------------------------------------
//статические методы создаются с целью вызова по явному и 
//  понятному названию, если разработчик не собирается создавать 
//  объекты но все равно желает использовать понятный вызов 
//  и использование таких статических методов в коде программы.

$salary = Salary::count($developer->getHours());
echo $salary;
$totalHours = Salary::$totalHours;
echo "\n" . $totalHours;

//все статические свойста остаются для классов единными
//  (грубо говоря у всех обьектов данного класса адрес 
//  на одну и ту же ячейку памяти).
$salaryObj = new Salary();
echo "\n" . $totalHours;
//-----------------------------------------------------------------