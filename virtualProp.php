<?php

class Rectangle
{
    // Виртуальное свойство
    public int $area {
        get => $this->h * $this->w;
    }

    public function __construct(public int $h, public int $w) {}
}

$s = new Rectangle(4, 5);
print $s->area; // Выводит 20
$s->area; // Ошибка, поскольку для свойства не определили комбинацию записи