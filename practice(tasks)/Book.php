<?php
namespace Classes;
include_once "LibraryItem.php";

use Classes\LibraryItem;

class Book extends LibraryItem {
    protected $genre;

    public function __construct($title, $author, $year, $genre) {
        parent::__construct($title, $author, $year);
        $this->genre = $genre;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function displayDetails() {
        echo "Title: " . $this->title . "\n";
        echo "Author: " . $this->author . "\n";
        echo "Year: " . $this->year . "\n";
        echo "Genre: " . $this->genre;
    }
}