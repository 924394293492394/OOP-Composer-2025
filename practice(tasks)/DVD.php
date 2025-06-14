<?php
namespace Classes;
include_once "LibraryItem.php";

use Classes\LibraryItem;

class DVD extends LibraryItem {
    protected $duration;

    public function __construct($title, $author, $year, $duration) {
        parent::__construct($title, $author, $year);
        $this->duration = $duration;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function displayDetails() {
        echo "Title: " . $this->title . "\n";
        echo "Author: " . $this->author . "\n";
        echo "Year: " . $this->year . "\n";
        echo "Duration: " . $this->duration . " minutes";
    }
}