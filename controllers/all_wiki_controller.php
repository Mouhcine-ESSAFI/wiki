<?php

$wikiClass = new Wiki(null, null, null, null);
$wikis = $wikiClass->getAllWikisWithDetailsA();

$categoriesClass = new Categories(null, null);
$allCategories = $categoriesClass->getAllCategories();



if(isset($_GET["search_title"])) {
    $input_value = $_GET["input_value"];
    $searchedData = Wiki::searchForTitles($input_value);

    echo json_encode($searchedData);
    exit;
}

if(isset($_GET["search_category"])) {
    $input_value = $_GET["input_value"];
    $searchedData = Wiki::searchForCategories($input_value);

    echo json_encode($searchedData);
    exit;
}

if(isset($_GET["search_tag"])) {
    $input_value = $_GET["input_value"];
    $searchedData = Wiki::searchForTags($input_value);

    echo json_encode($searchedData);
    exit;
}

// print_r($allCategories[2]);

?>