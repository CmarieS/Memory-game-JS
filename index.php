<!DOCTYPE html>
<html>
<heah>
    <title>Création jeu</title>
    <script src="js/game.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</heah>

<body>
    <div class="row bloc_title col-lg-12">
        <div class="select col-lg-6">
            <h1 class="title">Sélection du plateau/catégorie d'images</h1>
            <select name="select_gameBord" id="select_gameBord" class="select_gameBord">
                <option value="null">Sélectionner votre grille</option>
                <option value="3">2*4</option>
                <option value="4">3*4</option>
            </select>
            <select name="select_picture" id="select_picture" class="select_picture">
                <option value="null">Sélectionner vos images</option>
                <option value="jeux">Jeux</option>
                <option value="noel">Noêl</option>
            </select>
            <button class="button_select" onclick="buttonSelect()">Sélectionner</button>
            <button class="button_select" onclick="buttonReload()">Reload</button>
        </div>
        <div class="display col-lg-6">
            <p class="title_pair">Nombre de paire(s) : </p>
            <p id="pair"></p>
        </div>
    </div>
    <table id="3" class="memory_game tree gameBord">
        <?php for ($j = 1; $j <= 2; $j++) { ?>
            <tr>
                <?php for ($k = 1; $k <= 4; $k++) { ?>
                    <td class="memory_card">
                        <img class="front_img" src="ressources/spr0.jpg">
                        <img id="imgTree" class="back_img" src="ressources/spr0.jpg">
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <table id="4" class="memory_game four gameBord">
        <?php for ($j = 1; $j <= 3; $j++) { ?>
            <tr>
                <?php for ($k = 1; $k <= 4; $k++) { ?>
                    <td class="memory_card">
                        <img class="front_img" src="ressources/spr0.jpg">
                        <img id="imgFour" class="back_img" src="ressources/spr0.jpg">
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <div id="winContainer">
        <div id="starWinContainer">
            <div id="starContainer"></div>
            <div id="starFade"></div>
        </div>
        <div id="fireworksContainer"></div>
    </div>
    <div id="blocGameover">
        <div class="first_message">
            <p> GAME </p>
            <p> OVER </p>
        </div>

        <div class="second_message">
            <p> Trop long! </p>
        </div>

        <div class="reload_bloc">
            <button onclick="buttonReload()">Reload</button>
        </div>

    </div>
</body>

</html>
<script src="js/flip.js"></script>
<script src="js/fireEndGame.js"></script>