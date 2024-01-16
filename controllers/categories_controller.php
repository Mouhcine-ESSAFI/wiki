<?php




if(isset($_POST['add_catego'])){
    $newCatego = new Categories($_POST['name'], $_POST['description']);
    $newCatego->createCategory($_POST['name'], $_POST['description']);
    header('Location: index.php?page=categories');
}



$categoriesClass = new Categories(null, null);
$allCategories = $categoriesClass->getAllCategories();


if(isset($_POST['delete_catego'])){
    $categoryIDToDelete = $_POST['category_id'];
    $categoriesClass = new Categories(null, null);
    $categoriesClass->deleteCategory($categoryIDToDelete);
    header('Location: index.php?page=categories');
}


if(isset($_POST['update_catego'])){
    $categoryIdToUpdate = $_POST['category_id'];
    $updatedName = $_POST['name'];
    $updatedDescription = $_POST['description'];

    $categoriesClass = new Categories(null, null);
    $categoriesClass->updateCategory($categoryIdToUpdate, $updatedName, $updatedDescription);
    header('Location: index.php?page=categories');
}

?>