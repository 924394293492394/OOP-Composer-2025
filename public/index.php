<?php

require_once('../vendor/autoload.php');

$worker = new App\Worker('Boris', 20, [5, 6, 10]);
$developer = new App\Developer('Alex', 17, [5, 4, 2]);
// $visitor = new App\Visitor();

// $worker->work();
// $visitor->work();

// var_dump($worker);
$developer->setPosition("developer_30");
echo $developer->getPosition();