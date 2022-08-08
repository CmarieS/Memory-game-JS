<?php
include('connexion.php');
$sqlCategories = "SELECT name FROM game_category";
$categories = $pdo->query($sqlCategories);

$sqlPictures = "SELECT * FROM game_pictures";
$pictures = $pdo->query($sqlPictures);
$countPictures = $pictures->rowCount();

$bin = $pdo->query("SELECT * FROM game_pictures");
$donnees = $bin->fetchAll();

