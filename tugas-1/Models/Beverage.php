<?php

namespace Models;

include_once "Abstracts/FoodItem.php";  // Use include_once to avoid duplicate declarations

use Abstracts\FoodItem;

class Beverage extends FoodItem
{
    private $size;

    public function __construct($name, $price, $size)
    {
        parent::__construct($name, $price);
        $this->size = $size;
    }

    public function getInfo()
    {
        return "{$this->name}, Size: {$this->size}, Price: \${$this->price}";
    }
}
