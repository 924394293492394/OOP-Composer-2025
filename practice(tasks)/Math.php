<?php
namespace Classes;
class Math {
    public static function add(...$args) {
        return array_sum($args);
    }

    public static function subtract($num, ...$args) {
        return $num - self::add(...$args);
    }

    public static function multiply(...$args) {
        if(empty($args)){
            return 1;
        } else {
            return array_shift($args) * self::multiply(...$args);
        }
    }
}