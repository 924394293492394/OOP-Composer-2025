<?php

require_once("Rectangle.php");
require_once("Circle.php");
use Classes\Rectangle;
use Classes\Circle;

$rect = new Rectangle(4,5);
echo $rect->rectangleArea(), " ", $rect->rectanglePerimeter();

$rect = new Circle(4);
echo $rect->circleArea(), " ", $rect->circleLength();