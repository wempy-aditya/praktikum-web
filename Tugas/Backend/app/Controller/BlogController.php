<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Blog.php";

use app\Models\Blog;
use app\Traits\ApiResponseFormatter;

class BlogController
{
    use ApiResponseFormatter;

    public function index()
    {
        $blogModel = new Blog();
        $response = $blogModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $blogModel = new Blog();
        $response = $blogModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        $blogModel = new Blog();
        $response = $blogModel->create([
            "title" => $inputData['title'],
            "content" => $inputData['content'],
            "author" => $inputData['author'],
            "category" => $inputData['category'],
            "status" => $inputData['status']
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        $blogModel = new Blog();
        $response = $blogModel->update([
            "title" => $inputData['title'],
            "content" => $inputData['content'],
            "author" => $inputData['author'],
            "category" => $inputData['category'],
            "status" => $inputData['status']
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $blogModel = new Blog();
        $response = $blogModel->delete($id);
        return $this->apiResponse(200, "success", $response);
    }
}
