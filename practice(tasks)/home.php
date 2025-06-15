<?php

use Classes\BankAccount;
use Classes\Bird;
use Classes\Dog;

require_once("Rectangle.php");
require_once("Triangle.php");
require_once("Circle.php");
require_once("Square.php");
require_once("Vehicle.php");
require_once("Book.php");
require_once("DVD.php");
require_once("Student.php");
require_once("BankAccount.php");
require_once("Bird.php");
require_once("Dog.php");

use Classes\Rectangle;
use Classes\Triangle;
use Classes\Circle;
use Classes\Square;
use Classes\Vehicle;
use Classes\Book;
use Classes\DVD;
use Classes\Student;

$rect = new Rectangle(4,5);
echo "Fisrt | " . $rect->rectangleArea(), " ", $rect->calculateArea(), " ", $rect->rectanglePerimeter() . "\n";

$rect = new Circle(4);
echo "Second | " . $rect->circleArea(), " ", $rect->circleLength() . "\n";

$tring = new Triangle(40, 27);
echo "Third | " . $tring->calculateArea() . "\n";

$square = new Square(14);
echo "Fourth | " . $square->getSide(), " ", $square->resize(75), " ", $square->getSide() . "\n";

$square = new Vehicle("Toyota", "RAV4", 2019);
echo "Fifth | " . $square->tostringAll() . "\n";

echo "Sixth | ";
$book = new Book("Don Quixote", "Miguel de Cervantes", 1605, "Epic novel");
$book->displayDetails();

$dvd = new DVD("The Land Before Time", "Charles Grosvenor", 2010, 150);
$dvd->displayDetails() . "\n";

$student = new Student("Egor", 21, [10, 8, 7, 12, 5, 2, 11]);
echo "Seventh | ";
echo $student->tostringAll() . "\n";

echo "Eighth | " . "\n";
$bankaccount = new BankAccount();
echo $bankaccount->getBalance() . "\n";
$bankaccount->deposit(3500);
echo $bankaccount->getBalance() . "\n";
try{
    $bankaccount->withdraw(4500);
}catch (ErrorException $e){
    echo $e->getMessage() . "\n";
}

echo "Ninth | " . "\n";
$dog = new Dog();
$bird = new Bird();
$dog->eat() . "\n";
$dog->makeSound() . "\n";
$bird->eat() . "\n";
$bird->makeSound() . "\n";
