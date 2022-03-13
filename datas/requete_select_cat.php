<?php
include('connexion.php');
//$bdd = new mysqli("localhost", "root", "", "game");
$sql = "SELECT name FROM game_category";
$categories = $pdo->query($sql);
