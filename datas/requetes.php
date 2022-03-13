<?php
include('connexion.php');
$sqlCategories = "SELECT name FROM game_category";
$categories = $pdo->query($sqlCategories);

$sqlPictures = "SELECT * FROM game_pictures";
$pictures = $pdo->query($sqlPictures);
