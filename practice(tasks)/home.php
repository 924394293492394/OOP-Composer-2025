<?php

require_once("Rectangle.php");
require_once("Triangle.php");
require_once("Circle.php");
use Classes\Rectangle;
use Classes\Triangle;
use Classes\Circle;

$rect = new Rectangle(4,5);
echo $rect->rectangleArea(), " ", $rect->calculateArea(), " ", $rect->rectanglePerimeter() . "\n";

$rect = new Circle(4);
echo $rect->circleArea(), " ", $rect->circleLength() . "\n";

$tring = new Triangle(40, 27);
echo $tring->calculateArea();
