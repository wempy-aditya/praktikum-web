<?php
include "Controllers/FoodController.php";

use Controllers\FoodController;
use Models\Beverage;
use Models\Snack;

$foodController = new FoodController();

// Adding items to order
$foodController->addItem(new Beverage("Orange Juice", 3.50, "Medium"));
$foodController->addItem(new Snack("Chips", 2.00, "Crispy"));

// Display order summary in JSON format
echo $foodController->getOrderSummary();

// Display order in a web view
$foodController->viewItems();
