<?php


if(isset($_POST['add_tag'])){
    $newCatego = new Tags($_POST['name']);
    $newCatego->createTags($_POST['name']);
}



$tagsClass = new Tags(null);
$alltags = $tagsClass->getAllTags();


if(isset($_POST['delete_tags'])){
    $tagsIDToDelete = $_POST['tag_id'];
    $tagsClass = new Tags(null);
    $tagsClass->deleteTags($tagsIDToDelete);
}


if(isset($_POST['update_tag'])){
    $categoryIdToUpdate = $_POST['tag_id'];
    $updatedName = $_POST['name'];

    $categoriesClass = new Tags(null);
    $categoriesClass->updateTags($categoryIdToUpdate, $updatedName);
}

?>