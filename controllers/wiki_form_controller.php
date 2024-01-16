<?php

$categoriesClass = new Categories(null, null);
$categories = $categoriesClass->getAllCategories();

$tagsClass = new Tags(null);
$tags = $tagsClass->getAllTags();

// dd($_FILES);
if (isset($_POST['wiki'])) {
    $auteurId = $_SESSION['id'];

    $wikiTitle = $_POST['title'];
    $wikiContent = $_POST['content'];
    $categorieId = $_POST['category'];

    $wiki = new Wiki($wikiTitle, $wikiContent, $auteurId, $categorieId);
    $wikiCreated = $wiki->createWiki();
    if ($wikiCreated) {
        $wikiId = $wiki->getLastInsertId();

        if (!empty($_POST['tags'])) {
            foreach ($_POST['tags'] as $tagId) {
                $wiki->addTagToWiki($wikiId, $tagId);
            }
        }
    }
}