<?php

require_once("Rectangle.php");
require_once("Triangle.php");
require_once("Circle.php");
require_once("Square.php");
use Classes\Rectangle;
use Classes\Triangle;
use Classes\Circle;
use Classes\Square;

$rect = new Rectangle(4,5);
echo "Fisrt | " . $rect->rectangleArea(), " ", $rect->calculateArea(), " ", $rect->rectanglePerimeter() . "\n";

$rect = new Circle(4);
echo "Second | " .$rect->circleArea(), " ", $rect->circleLength() . "\n";

$tring = new Triangle(40, 27);
echo "Third | " .$tring->calculateArea() . "\n";

$square = new Square(14);
echo "Fourth | " .$square->getSide(), " ", $square->resize(75), " ", $square->getSide() . "\n";