<?php

require_once("./Developer.php");

$developer = new Developer('Alex', 17, [5, 4, 2]);

// __construct
var_dump($developer); //
echo "\n";
// __call
$developer->work2(); // перегрузка магического метода __call. Попытка вызова метода work2 
echo "\n";
// __callStatic
Developer::work2(); // перегрузка магического метода __callStatic. Попытка вызова статического метода work2
echo "\n";
// __get
$developer->whatup; // перегрузка магического метода __get. Попытка получить переменную whatup
echo "\n";
// __set
$developer->element = 2025; // перегрузка магического метода __set. Попытка установить переменной element значение 2025
echo "\n";
// __isset
echo isset($developer->name2); // перегрузка магического метода __isset. Попытка проверить установлена переменная name2 или нет
var_dump(isset($developer->name)); // bool(true)
echo "\n";
// __unset
unset($developer->name2); //перегрузка магического метода __unset. Попытка проверить отсутствует перменная name2 или нет
echo "\n";
// __sleep
$serObj = serialize($developer);
var_dump($serObj); //string(132) "O:9:"Developer":4:{s:4:"name";s:4:"Alex";s:3:"age";i:17;s:5:"hours";a:3:{i:0;i:5;i:1;i:4;i:2;i:2;}s:11:"*position";s:7:"worker1";}"
echo "\n";

// __wakeup
$unserObj = unserialize($serObj); 
var_dump($unserObj);
/*
object(Developer)#2 (4) {
  ["name"]=>
  string(4) "Alex"
  ["age"]=>
  int(17)
  ["hours"]=>
  array(3) {
    [0]=>
    int(5)
    [1]=>
    int(4)
    [2]=>
    int(2)
  }
  ["position":protected]=>
  string(7) "worker1"
}
*/
echo "\n";

// __toString
echo $developer; // Имя разработчика: Alex
echo "\n";

// __invoke()
echo $developer(); // вызов метода __invoke (попытка вызова объект класса как функцию)
echo "\n";