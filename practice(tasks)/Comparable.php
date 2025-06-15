<?php
namespace Interfaces;
use Classes\Product;
interface Comparable {
    public function compareTo(Product $other);
}