<?php
include('connexion.php');
$sqlCategories = $pdo->query("SELECT * FROM game_category");
$categories = $sqlCategories->fetchAll();

$sqlPictures = "SELECT * FROM game_pictures";
$pictures = $pdo->query($sqlPictures);
$countPictures = $pictures->rowCount();

$bin = $pdo->query("SELECT * FROM game_pictures LIMIT 4");
$donnees = $bin->fetchAll();


