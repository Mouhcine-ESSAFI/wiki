<?php

class Wiki {
    public $id;
    public $title;
    public $content;
    public $auteur_id;
    public $categorie_id;

    public function __construct($title, $content, $auteur_id, $categorie_id) {
        $this->title = $title;
        $this->content = $content;
        $this->auteur_id = $auteur_id;
        $this->categorie_id = $categorie_id;
    }

    public function createWiki() {
        global $db;
        $stmt = $db->prepare("INSERT INTO Wikis (title, content, auteur_id, categorie_id) VALUES (:title, :content, :auteur_id, :categorie_id)");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':auteur_id', $this->auteur_id);
        $stmt->bindParam(':categorie_id', $this->categorie_id);
        return $stmt->execute();
    }

    public function updateWiki($id) {
        global $db;
        $stmt = $db->prepare("UPDATE Wikis SET title = :title, content = :content, categorie_id = :categorie_id WHERE id = :id");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':categorie_id', $this->categorie_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function getWikiById($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM Wikis WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getWikisByCateg($id) {
        global $db;
        $stmt = $db->prepare("
            SELECT 
                w.*, 
                u.name AS author_name, 
                c.name AS category_name, 
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM Wikis w
            LEFT JOIN Users u ON w.auteur_id = u.id
            LEFT JOIN Categories c ON w.categorie_id = c.id
            LEFT JOIN Wiki_Tags wt ON w.id = wt.wiki_id
            LEFT JOIN Tags t ON wt.tag_id = t.id
            WHERE w.categorie_id = :id AND w.deleted_at IS NULL
            GROUP BY w.id
            ORDER BY w.date_edit DESC
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    

    public static function getAllWikis() {
        global $db;
        $stmt = $db->prepare("SELECT * FROM Wikis");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTagToWiki($wikiId, $tagId) {
        global $db;
        $stmt = $db->prepare("INSERT INTO Wiki_Tags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)");
        $stmt->bindParam(':wiki_id', $wikiId);
        $stmt->bindParam(':tag_id', $tagId);
        return $stmt->execute();
    }

    public function getLastInsertId() {
        global $db;
        return $db->lastInsertId();
    }  

    public function softDeleteWiki($id) {
        global $db;
        $stmt = $db->prepare("UPDATE Wikis SET deleted_at = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function RecoverWiki($id) {
        global $db;
        $stmt = $db->prepare("UPDATE Wikis SET deleted_at = NULL WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function getDetailedWikiById($wikiId){
        global $db;
        $stmt = $db->prepare("SELECT w.*, u.name AS author_name, c.name AS category_name, GROUP_CONCAT(t.name) AS tags
        FROM Wikis w
        JOIN Users u ON w.auteur_id = u.id
        JOIN Categories c ON w.categorie_id = c.id
        LEFT JOIN Wiki_Tags wt ON w.id = wt.wiki_id
        LEFT JOIN Tags t ON wt.tag_id = t.id
        WHERE w.id = :wiki_id
        GROUP BY w.id;
        ");
        $stmt->bindParam(':wiki_id', $wikiId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllWikisWithDetails() {
        global $db;
        $stmt = $db->prepare("
            SELECT 
                w.*, 
                u.name AS author_name, 
                c.name AS category_name, 
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM Wikis w
            LEFT JOIN Users u ON w.auteur_id = u.id
            LEFT JOIN Categories c ON w.categorie_id = c.id
            LEFT JOIN Wiki_Tags wt ON w.id = wt.wiki_id
            LEFT JOIN Tags t ON wt.tag_id = t.id
            WHERE w.deleted_at IS NULL
            GROUP BY w.id
            ORDER BY w.date_edit DESC
            LIMIT 3
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWikisWithDetailsA() {
        global $db;
        $stmt = $db->prepare("
            SELECT 
                w.*, 
                u.name AS author_name, 
                c.name AS category_name, 
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM Wikis w
            LEFT JOIN Users u ON w.auteur_id = u.id
            LEFT JOIN Categories c ON w.categorie_id = c.id
            LEFT JOIN Wiki_Tags wt ON w.id = wt.wiki_id
            LEFT JOIN Tags t ON wt.tag_id = t.id
            WHERE w.deleted_at IS NULL
            GROUP BY w.id
            ORDER BY w.date_edit DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWikisWithDetails2() {
        global $db;
        $stmt = $db->prepare("
            SELECT 
                w.*, 
                u.name AS author_name, 
                c.name AS category_name, 
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM Wikis w
            LEFT JOIN Users u ON w.auteur_id = u.id
            LEFT JOIN Categories c ON w.categorie_id = c.id
            LEFT JOIN Wiki_Tags wt ON w.id = wt.wiki_id
            LEFT JOIN Tags t ON wt.tag_id = t.id
            WHERE w.deleted_at IS NOT NULL
            GROUP BY w.id
            ORDER BY w.date_edit DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    static function searchForTitles($title) {
        global $db;
        $title = "%" . $title . "%";
        $sql = "SELECT w.* FROM Wikis w
                WHERE w.title LIKE :title AND w.deleted_at IS NULL";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    


    static function searchForTags($tag)
{
    global $db;
    $tag = "%" . $tag . "%";
    $sql = "SELECT 
                w.*, 
                u.name AS author_name, 
                c.name AS category_name, 
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM Wikis w
            INNER JOIN Wiki_Tags wt ON w.id = wt.wiki_id
            INNER JOIN Tags t ON wt.tag_id = t.id
            LEFT JOIN Users u ON w.auteur_id = u.id
            LEFT JOIN Categories c ON w.categorie_id = c.id
            WHERE t.name LIKE :tag AND w.deleted_at IS NULL
            GROUP BY w.id
            ORDER BY w.date_edit DESC";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":tag", $tag, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    static function searchForCategories($category) {
        global $db;
        $category = "%" . $category . "%";
        $sql = "SELECT w.* FROM Wikis w
                INNER JOIN Categories c ON w.categorie_id = c.id
                WHERE c.name LIKE :category AND w.deleted_at IS NULL";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function countWikis()
    {
        global $db;
        $query = "SELECT COUNT(*) FROM Wikis";
        $stmt = $db->prepare($query);
        $stmt->execute();

        if (!$stmt) {
            die('Query failed: ' . $db->errorInfo()[2]);
        }
        return intval($stmt->fetchColumn());
    }


    public function getWikisByUserWithDetails($userId) {
        global $db;
        $stmt = $db->prepare("
            SELECT 
                w.*, 
                u.name AS author_name, 
                c.name AS category_name, 
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM Wikis w
            LEFT JOIN Users u ON w.auteur_id = u.id
            LEFT JOIN Categories c ON w.categorie_id = c.id
            LEFT JOIN Wiki_Tags wt ON w.id = wt.wiki_id
            LEFT JOIN Tags t ON wt.tag_id = t.id
            WHERE w.auteur_id = :userId AND w.deleted_at IS NULL
            GROUP BY w.id
            ORDER BY w.date_created DESC
        ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateWikiById($id, $title, $content, $categorieId, $tags) {
            global $db;

            $stmt = $db->prepare("UPDATE Wikis SET title = :title, content = :content, categorie_id = :categorie_id, date_edit = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':categorie_id', $categorieId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM Wiki_Tags WHERE wiki_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("INSERT INTO Wiki_Tags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)");
            foreach ($tags as $tagId) {
                $stmt->bindParam(':wiki_id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':tag_id', $tagId, PDO::PARAM_INT);
                $stmt->execute();

                
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }
    


}
?>