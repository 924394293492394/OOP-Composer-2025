<?php
namespace Classes;
class Loggerr {
    private static $instance;
    private $logs;

    private function __construct() {
        $this->logs = [];
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Loggerr();
        }

        return self::$instance;
    }

    public function log($message) {
        $this->logs[] = $message;
    }

    public function getLogs() {
        foreach($this->logs as $log)
        echo $log . "\n";
    }
}