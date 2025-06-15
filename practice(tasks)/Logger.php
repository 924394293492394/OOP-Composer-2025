<?php
namespace Classes;
class Logger {
    public static $logCount = 0;

    public static function log($message) {
        echo $message . "\n";
        self::$logCount++;
    }
}