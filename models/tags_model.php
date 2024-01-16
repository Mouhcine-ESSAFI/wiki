<?php

class Tags {
    public $id;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function createTags($name)
    {
        global $db;

        $stmt = $db->prepare("INSERT INTO tags (name) VALUES (:name)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updateTags($id, $name)
    {
        global $db;

        $stmt = $db->prepare("UPDATE tags SET name = :name WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteTags($id)
    {
        global $db;

        $stmt = $db->prepare("DELETE FROM tags WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAllTags()
    {
        global $db;

        $stmt = $db->prepare("SELECT * FROM tags");
        $stmt->execute();

        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

    public function countTags()
    {
        global $db;
        $query = "SELECT COUNT(*) FROM tags";
        $stmt = $db->prepare($query);
        $stmt->execute();

        if (!$stmt) {
            die('Query failed: ' . $db->errorInfo()[2]);
        }

        return intval($stmt->fetchColumn());
    }

}

?>