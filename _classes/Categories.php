<?php

class Categories {
    public $id;
    public $name;
    public $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function createCategory($name, $description)
    {
        global $db;

        $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updateCategory($id, $name, $description)
    {
        global $db;

        $stmt = $db->prepare("UPDATE categories SET name = :name, description = :description WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteCategory($id)
    {
        global $db;

        $stmt = $db->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAllCategories()
    {
        global $db;

        $stmt = $db->prepare("SELECT * FROM categories");
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    public function countCategories()
    {
        global $db;
        $query = "SELECT COUNT(*) FROM categories";
        $stmt = $db->prepare($query);
        $stmt->execute();

        if (!$stmt) {
            die('Query failed: ' . $db->errorInfo()[2]);
        }
        return intval($stmt->fetchColumn());
    }

}

?>