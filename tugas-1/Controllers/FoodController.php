<?php

namespace Controllers;

include "Traits/ResponseFormatter.php";
include "Models/Beverage.php";
include "Models/Snack.php";

use Traits\ResponseFormatter;
use Models\Beverage;
use Models\Snack;

class FoodController
{
    use ResponseFormatter;

    private $items = [];

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function getOrderSummary()
    {
        $order = [];
        foreach ($this->items as $item) {
            $order[] = $item->getInfo();
        }
        return $this->formatResponse(200, "Order Summary", $order);
    }

    public function viewItems()
    {
        include 'views/order_summary.php';
    }
}
