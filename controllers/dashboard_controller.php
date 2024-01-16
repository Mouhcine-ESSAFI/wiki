<?php
// get number of Users 
$userLogin = new User(null, null, null);
$userCount = $userLogin->countUsers();

// get number of wikis
$wikiClass = new Wiki(null, null, null, null, null);
$wikisCount = $wikiClass->countWikis();

// get number of Tags
$tagsClass = new Tags(null);
$TagsCount = $tagsClass->countTags();

// get number of Categories 
$CategoriesClass = new Categories(null, null);
$CategoriesCount = $CategoriesClass->countCategories();