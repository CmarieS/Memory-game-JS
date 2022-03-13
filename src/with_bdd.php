<?php
include 'datas/requetes.php';
?>
<div class="row selectGame col-lg-12">
    <div id="select" class="select col-lg-6">
        <h1 class="title col-lg-11">Sélection du plateau/catégorie d'images</h1>
        <select name="select_gameBord" id="select_gameBord" class="select_gameBord">
            <option value="null">Sélectionner votre grille</option>
            <option value="3">2*4</option>
            <option value="4">3*4</option>
        </select>
        <select name="select_picture" id="select_picture" class="select_picture">
            <option value="null">Sélectionner vos images</option>
            <?php
            foreach ($categories as $result) {
            ?> <option value="<?php $result ?>"><?php echo $result["name"] ?></option>
            <?php
            } ?>
        </select>
        <button class="button_select" onclick="buttonSelect()">Sélectionner</button>
        <button class="button_select" onclick="buttonReload()">Réinitialiser</button>
        <button class="button_pictures" onclick="location.href='../src/pictures.php'">Images</button>
    </div>

    <div id="tabGame" class="col-lg-6">
        <div class="row bloc_title col-lg-12">
            <div class="bloc_pair col-lg-6">
                <p class="title_pair">Nombre de paire(s) : </p>
                <p id="pair"></p>
            </div>
            <div class="bloc_countDown col-lg-6">
                <p class="title-countDown">Compteur :</p>
                <div id="countdown"></div>
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

    </div>

</div>
<?php include 'widgets/win_gameOver.php'; ?>