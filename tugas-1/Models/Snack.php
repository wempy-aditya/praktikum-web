<?php

namespace Models;

include_once "Abstracts/FoodItem.php";  // Use include_once here as well

use Abstracts\FoodItem;

class Snack extends FoodItem
{
    private $type;

    public function __construct($name, $price, $type)
    {
        parent::__construct($name, $price);
        $this->type = $type;
    }

    public function getInfo()
    {
        return "{$this->name}, Type: {$this->type}, Price: \${$this->price}";
    }
}
