<?php

$wikiClass = new Wiki(null, null, null, null, null);
$wikis = $wikiClass->getWikisByUserWithDetails($_SESSION['id']);
// echo "<pre>";
// print_r($wikis);
// echo "<pre>";
$categoriesClass = new Categories(null, null);
$categories = $categoriesClass->getAllCategories();

$tagsClass = new Tags(null);
$tags = $tagsClass->getAllTags();

if (isset($_POST['update_mwiki'])) {
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categorieId = $_POST['category'];
    $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
    $id = $_POST['category_id'];


    $success = $wikiClass->updateWikiById($id, $title, $content, $categorieId, $tags);

    

    header("Location: index.php?page=my_wikis");
    exit();
}

if (isset($_POST['delete_mwiki'])) {
    $wikiId = $_POST['wiki_id'];
    $wikiClass->softDeleteWiki($wikiId);
    
    header("Location: index.php?page=my_wikis");
    exit();
}

?>