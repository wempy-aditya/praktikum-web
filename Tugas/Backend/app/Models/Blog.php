<?php

namespace app\Models;

include "app/Config/DatabaseConfiguration.php";

use app\Config\DatabaseConfig;
use mysqli;

class Blog extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->databaseName,
            $this->port
        );

        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM posts";
        $result = $this->conn->query($sql);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $this->conn->close();
        return $data;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    public function create($data)
    {
        $query = "INSERT INTO posts (title, content, author, category, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $data['title'], $data['content'], $data['author'], $data['category'], $data['status']);
        $stmt->execute();
        $stmt->close();
    }

    public function update($data, $id)
    {
        $query = "UPDATE posts SET title = ?, content = ?, author = ?, category = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $data['title'], $data['content'], $data['author'], $data['category'], $data['status'], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function delete($id)
    {
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
