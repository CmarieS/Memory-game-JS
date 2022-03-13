<?php
include('connexion.php');
$sql = "SELECT name FROM game_category";
$categories = $pdo->query($sql);
