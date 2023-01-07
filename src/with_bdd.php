<?php
include 'datas/requetes.php';
include 'confirmParamForm.php';

$countDonneees = 0;
?>
<?php 
$array= [];
    $today = date("H");
    if($today <= 12)
    { ?>
        <div class="row selectGame col-lg-12" style='background:url(../../ressources/days.png);background-repeat: no-repeat;background-size: 100% 100%;
        background-position: top center;height: 100%;'>
    <?php } else { ?>
        <div class="row selectGame col-lg-12" style='background:url(../../ressources/night.png);background-repeat: no-repeat;background-size: 100% 100%;
        background-position: top center;height: 100%;'>
    <?php }?>
    <div id="select" class="select col-lg-6">
    <h1 class="title">Paramètres:</h1>
    <br>
    <form id="formTabParam" class="formTabParam">
    <h3>Sélection de la catégorie d'images: </h3>
    <select name="select_picture" id="select_picture" class="select_picture">
        <?php if(isset($_SESSION['select_pictureId']))
        {
            ?> <option value="<?php echo $_SESSION['select_pictureId']?>|<?php echo $_SESSION['select_pictureName']?>"> <?php echo $_SESSION['select_pictureName'] ?></option> <?php 
        }
        else { ?>
            <option value="null">Sélectionner vos images</option>
        <?php } ?>
    <?php
    foreach ($categories as $result) {
        ?> <option value="<?php echo $result["id"] ?>|<?php echo $result["name"] ?>"><?php echo $result["name"] ?></option>
    <?php
    } ?>
    </select>
    <button type="button" id="confirmParam" name="confirmParam" class="confirmParam" onclick="buttonSelect(0,3)">Démarrer</button>
    <button type="button" id="resetParam" name="resetParam" class="resetParam" onclick="buttonReload()">Réinitialiser</button>   
    <br>
    </form>
    <br>
        <div class="bloc_rules">
            <h1 class="title col-lg-11">Instructions:</h1>
            <ul>
                <li>Sélectionner les images souhaitées puis démarrer</li>
                <li>Retourner les cartes pour trouver les paires</li>
                <li>Quand vous trouvez une paire, le compteur diminue</li>
                <li>Le jeu est chronométré</li>
            </ul>
        </div>
        <br><br>
        <!--<div class="col-lg-12 buttonPicture">
            <h3>Gestion des images:</h3>
            <button class="button_pictures" onclick="location.href='../src/pictures.php'">Images</button>
        </div>-->
    </div>
    <div id="tabGame" class="col-lg-6">
        <div class="row bloc_title col-lg-12">
            <div class="bloc_pair col-lg-6">
                <p class="title_pair">Nombre de paire(s) : </p>
                <p id="pair"></p>
            </div>
            <div id="bloc_countDown" class="bloc_countDown col-lg-6">
                <p class="title-countDown">Compteur :</p>
            </div>
        </div>
        <table id="3" class="memory_game_with_bdd tree gameBord"></table>
        <div id="nextGame" class="nextGame" style="display:none;">
            <div class="col-lg-12">
                <p>Plateau suivant :</p>
            </div>
            <div>
                <div class="next NextimgMemoryA">
                    <img src="../ressources/memory.png" alt="">
                </div>
                <form class="next" id="formNextTab">
                    <button type="button" id="nextGame" name="nextGame" class="nextGame" onclick="buttonSelect(0,4)">Suivant</button>
                </form>
                <div class="next NextimgMemoryB">
                    <img src="../ressources/memory.png" alt="">
                </div>
            </div>
        </div>
        <table id="4" class="memory_game_with_bdd four gameBord"></table>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../js/confirmFormsClick.js"></script>
<?php include 'widgets/win_gameOver.php';?>