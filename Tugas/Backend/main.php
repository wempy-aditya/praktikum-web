<?php
header("Content-Type: application/json; charset=UTF-8");

include "app/Routes/BlogRoutes.php";

use app\Routes\BlogRoutes;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$position = strpos($path, '.php');
if ($position !== false) {
    // Ambil substring setelah '.php'
    $pathAfterPhp = substr($path, $position + 4); 
}

$blogRoutes = new BlogRoutes();
$blogRoutes->handle($method, $pathAfterPhp);
