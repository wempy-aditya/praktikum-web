<?php

namespace app\Routes;

include "app/Controller/BlogController.php";

use app\Controller\BlogController;

class BlogRoutes
{
    public function handle($method, $path)
    {
        if ($method == "GET" && $path == '/api/posts') {
            $controller = new BlogController();
            echo $controller->index();
        }

        if ($method == "GET" && strpos($path, "/api/posts/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new BlogController();
            echo $controller->getById($id);
        }

        if ($method == "POST" && $path == "/api/posts") {
            $controller = new BlogController();
            echo $controller->insert();
        }

        if ($method == "PUT" && strpos($path, "/api/posts/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new BlogController();
            echo $controller->update($id);
        }

        if ($method == "DELETE" && strpos($path, "/api/posts/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            $controller = new BlogController();
            echo $controller->delete($id);
        }
    }
}
