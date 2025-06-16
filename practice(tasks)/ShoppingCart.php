<?php

namespace Classes;

class ShoppingCart{
    private array $items = [];
    private float $total = 0;

    public function add(...$items){
        array_push($this->items, ...$items); 
    }

	public function getItems(): array {
		return $this->items;
	}

	
	public function getTotal(): float {
		foreach($this->items as $item){
            $this->total += $item['price'];
        }
        return $this->total;
	}
	
}