<?php
// echo "<pre>";
// print_r($wikis);
// echo "<pre>";

$wikiClass = new Wiki(null, null, null, null, null);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categId = $_GET['id'];
    $wikis = $wikiClass->getWikisByCateg($categId);
}
