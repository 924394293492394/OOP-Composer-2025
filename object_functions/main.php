<?php

require_once("./Developer.php");
require_once("./Designer.php");
require_once("./Workerr.php");

$worker = new Workerr('Boris', 20, [5, 6, 10]);
$developer = new Developer('Alex', 17, [5, 4, 2]);

var_dump($developer, $worker);

$check = property_exists($developer, 'name');
var_dump($check); //true

var_dump(method_exists($developer, 'work22')); //false

var_dump(is_subclass_of($worker, 'Developer')); //false
var_dump(is_subclass_of($developer, 'Workerr')); //true

class_alias('Workerr', 'Workff', true);

var_dump(enum_exists('Character', false)); //true (за счет require_once("./Developer.php"); require_once("./Designer.php"); require_once("./Workerr.php");

var_dump(get_class($developer));
var_dump(get_class_methods('Developer'));
var_dump(get_class_vars('Developer'));

print_r(get_declared_classes());
print_r(get_declared_interfaces());
print_r(get_declared_traits());

print_r(get_object_vars($developer));
print_r(get_mangled_object_vars($developer));