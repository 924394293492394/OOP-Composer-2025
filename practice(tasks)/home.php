<?php

require_once("Rectangle.php");
use Classes\Rectangle;

$rect = new Rectangle(4,5);
echo $rect->rectangleArea(), " ", $rect->rectanglePerimeter();