<!DOCTYPE html>
<html>
<heah>
    <title>Création jeu</title>
    <script src="js/game.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</heah>
<body>
    <div class="col-lg-2">
            <button id="close_button" class="close_button col-lg-1" onclick="selectShowDisplay()">-</button>
    </div>
    <div class="col-lg-12 title_game">
            <p>Memory</p>
    </div>
    <?php
    $connexion = false;
    try {
        include 'datas/connexion.php';
        $connexion = true;
    } catch (Exception $e) {
        $connexion = false;
    }
    if ($connexion == false) {
        include 'src/without_bdd.php';
    } else {
        include 'src/with_bdd.php';
    }
    ?>
</body>

</html>
<script src="js/flip.js"></script>
<script src="js/fireEndGame.js"></script>