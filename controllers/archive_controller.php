<?php

$wikiClass = new Wiki(null, null, null, null, null);
$wikis = $wikiClass->getAllWikisWithDetails();
$wikiDs = $wikiClass->getAllWikisWithDetails2();
// echo "<pre>";
// print_r($wikiDs);
// echo "<pre>";

if (isset($_POST['delete_wiki'])) {
    $wikiId = $_POST['wiki_id'];
    $wikiClass->softDeleteWiki($wikiId);
    header("Location: index.php?page=archive");
    exit();
}

if (isset($_POST['recover_wiki'])) {
    $wikiId = $_POST['wiki_id'];
    $wikiClass->RecoverWiki($wikiId);
    header("Location: index.php?page=archive");
    exit();
}

?>