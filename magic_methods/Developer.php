<?php

include_once("./Worker.php");

class Developer extends Worker
{

    function __construct($name, $age, $hours)
    {
        parent::__construct($name, $age, $hours);
        // $this->position = "dev30";
    }

    function __destruct()
    {
        print "Уничтожается " . __CLASS__  . "\n";
    }

    function __call($method, $args)
    {
        echo "перегрузка магического метода __call. Попытка вызова метода $method";
    }
    static function __callStatic($method, $args)
    {
        echo "перегрузка магического метода __callStatic. Попытка вызова статического метода $method";
    }
    function __get($value)
    {
        echo "перегрузка магического метода __get. Попытка получить переменную $value";
    }
    function __set($name, $value)
    {
        print "перегрузка магического метода __set. Попытка установить переменной $name значение $value";
    }
    function __isset($name)
    {
        print "перегрузка магического метода __isset. Попытка проверить установлена переменная $name или нет";
    }
    function __unset($name)
    {
        print "перегрузка магического метода __unset. Попытка проверить отсутствует перменная $name или нет";
    }
    function __toString()
    {
        return "Имя разработчика: ". $this->name;
    }
    function __invoke(){
        return "вызов метода __invoke (попытка вызова объект класса как функцию)";
    }
    public function  work()
    {
        print_r('im developing');
    }

}