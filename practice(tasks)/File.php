<?php

namespace Classes;
class File {
    public $name;
    public $size;

    public function __construct($name, $size) {
        $this->name = $name;
        $this->size = $size;
    }

    public static function calculateTotalSize(... $files) {
        $totalSize = 0;

        foreach ($files as $file) {
            if ($file instanceof File) {
                $totalSize += $file->size;
            }
        }

        return $totalSize;
    }
}
