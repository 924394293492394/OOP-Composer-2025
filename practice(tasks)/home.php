<?php

use Classes\Calculator;

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
require_once("Person.php");
require_once("Employee.php");
require_once("Product.php");
require_once("Logger.php");
require_once("Math.php");
require_once("File.php");
require_once("Calculator.php");
require_once("Loggerr.php");
require_once("ShoppingCart.php");
require_once("Validation.php");

use Classes\Rectangle;
use Classes\Triangle;
use Classes\Circle;
use Classes\Square;
use Classes\Vehicle;
use Classes\Book;
use Classes\DVD;
use Classes\Student;
use Classes\BankAccount;
use Classes\Bird;
use Classes\Dog;
use Classes\Employee;
use Classes\Person;
use Classes\Product;
use Classes\Logger;
use Classes\Math;
use Classes\File;
use Classes\Loggerr;
use Classes\ShoppingCart;
use Classes\Validation;

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

echo "Tenth | " . "\n";
$person = new Person("Andre", 37);
echo "\n";
print($person);

echo "Eleventh | " . "\n";
$employee = new Employee("Egor", 21, 1750.43, "Fullstack PHP");
echo "\n";
print($employee);

echo "Twelfth | " . "\n";
$product = new Product("Milk", 75.4);
echo "\n";
$product->compareTo(new Product("Coffee", 75.5));
echo "\n";
Product::compareObjects($product, new Product("Coffee", 75.4));
echo "\n";

echo "Thirteenth | " . "\n";
Logger::log("Log message 1");
Logger::log("Log message 2");
Logger::log("Log message 3");
echo "Total log count: " . Logger::$logCount . "\n";


echo "Fourteenth | " . "\n";
$result1 = Math::add(...[14, -7, 9, 28]);
$result2 = Math::subtract(74, ...[14, -7, 9, 28]);
$result3 = Math::multiply(...[14, -7, 9, 28]);

echo "Addition: " . $result1 . "\n";
echo "Subtraction: " . $result2 . "\n";
echo "Multiplication: " . $result3 . "\n";

echo "Fifteenth | " . "\n";
$file1 = new File("file1.txt", 1300);
$file2 = new File("file2.txt", 2200);
$file3 = new File("file3.txt", 1400);

$files = [$file1, $file2, $file3];
$totalSize = File::calculateTotalSize(...$files);

echo "Total size of files: " . $totalSize . " bytes";

echo "Sixteenth | " . "\n";
$calculator = new Calculator();
echo $calculator->getResult() . "\n";
$calculator->add(...[14, -7, 9, 28]);
echo $calculator->getResult() . "\n";
$calculator->subtract(32);
echo $calculator->getResult() . "\n";

echo "Seventeenth | " . "\n";
$cart = new ShoppingCart();
$cart->add(['name' => 'Игровая мышь', 'price' => 29.99]);
$cart->add(['name' => 'Клавиатура', 'price' => 49.99]);
$cart->add(['name' => 'Монитор', 'price' => 199.99]);

echo "Товары в корзине:\n";
print_r($cart->getItems());
echo "Итоговая сумма: {$cart->getTotal()}";

echo "Eightteenth | " . "\n";
$logger = Loggerr::getInstance();
$logger->log("Egor CEO");
$logger->log("16.06.2025 21 OLD");
$logger->getLogs();

echo "Nineteenth (LAST) | " . "\n";
$email = "admin@example.com";
$password = "password123";
$field = "";

if (Validation::validateEmail($email)) {
    echo "Email is valid.";
} else {
    echo "Email is invalid.";
}
echo "\n";

if (Validation::validatePassword($password)) {
    echo "Password is valid.";
} else {
    echo "Password is invalid.";
}
echo "\n";

if (Validation::validateField($field)) {
    echo "Field is valid.";
} else {
    echo "Field is invalid.";
}
echo "\n";