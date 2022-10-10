<?php
include 'datas/requetes.php';

$countDonneees = 0;

if (isset($_POST["confirmParam"])) {

    session_start(); // pour pouvoir utiliser les sessions
    $select_picture_explode = explode('|', $_POST["select_picture"]);
    $_SESSION['select_pictureId'] = $select_picture_explode[0];
    $_SESSION['select_pictureName'] = $select_picture_explode[1];
    $_SESSION['selectPlateauId'] = $_POST['select_gameBord'];
    $nomberPicture = 0;
    if($_POST['select_gameBord'] == 3)
    {
        $_SESSION['selectPlateauName'] = "2*4";
        $nomberPicture = 4;
    }
    else
    {
        $_SESSION['selectPlateauName'] = "3*4";
        $nomberPicture = 6;
    }

    $selectPictureIdDisplay = $select_picture_explode[0];
    $picturesByIdSql = $pdo->prepare("SELECT * FROM game_pictures where category_id = :category_id");
    $picturesByIdSql->execute(['category_id' => $selectPictureIdDisplay]); 
    $donneees = $picturesByIdSql->fetchAll();
    $countDonneees = count($donneees);
    $_SESSION['countDonneees'] = $countDonneees;
    $test = $_SESSION['selectPlateauId'];
    echo "<script>alert(\"$nomberPicture,$test\")</script>";
    if($countDonneees < $nomberPicture)
    {
        echo "<script>alert(\"Pas assez d\images dans votre bdd ( besoin de $nomberPicture images de la même catégorie)\")</script>";
    }

}

if(isset($_POST["resetParam"]))
{
    //session_destroy();
    unset($_SESSION['select_pictureId']);
    unset($_SESSION['select_pictureName']);
    unset($_SESSION['selectPlateauId']);
    unset($_SESSION['selectPlateauName']);
}
?>
<div class="row selectGame col-lg-12">
    <!--<form action="index.php" method="POST"  id="select" class="select col-lg-6">-->
    <div id="select" class="select col-lg-6">
        <h1 class="title col-lg-11">Paramètres:</h1>
        <br>
        <table class="tableParamPicture">
            <tr>
                <td class="tableParamPictureTd">
                    <h3>Gestion des images:</h3>
                </td> 
                <td class="tableParamPictureTd">
                    <button class="button_pictures" onclick="location.href='../src/pictures.php'">Images</button>
                </td>
            </tr>
        </table>
        <br>
        <form action="" method="POST">
            <table class="tableParam">
                <tr>
                    <td class="tableParamTd">
                        <h3>Sélection de la grille: </h3>
                        <select name="select_gameBord" id="select_gameBord" class="select_gameBord">
                            <?php if(isset($_SESSION['select_pictureId']))
                            {
                                ?> <option value="<?php echo $_SESSION['selectPlateauId']?>"> <?php echo $_SESSION['selectPlateauName'] ?></option> <?php 
                            }
                            else { ?>
                                <option value="null">Sélectionner votre grille</option>
                                <option value="3">2*4</option>
                                <option value="4">3*4</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="tableParamTd">
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
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr class="tableParamTrButtom">
                    <td class="tableParamTdButtom">
                        <button type="submit" name="confirmParam">Valider paramètres</button>
                    </td>
                    <td class="tableParamTdButtom">
                        <button type="submit" name="resetParam">Supprimer paramètres</button>
                    </td>
                </tr>
            </table>   
        <br>
    </form>
    <br>
        <div class="blocButtons">
            <?php if($countDonneees == 4 || $countDonneees == 6) { ?>
                <button id="button_select" class="button_select" onclick="buttonSelect(0)">Démarrer</button>
            <?php } ?>
            <button class="button_select" onclick="buttonReload()">Réinitialiser</button>
        </div> 
    </div>
    <!--</form>-->

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
        <?php if(!empty($donneees)) { 
            $array = array_merge($donneees, $donneees);
            shuffle($array);
        ?>
        <table id="3" class="memory_game_with_bdd tree gameBord">
            <?php for ($k = 0; $k < count($array); $k++) {
                $img=base64_encode($array[$k]['bin']);
            if($k == 0)
            {
                ?> <tr>
            <?php } ?>
            <td class="memory_card">
                <img class="front_img" src="ressources/spr0.jpg">
                <img id="imgTree" class="img-responsive back_img" src="data:<?php echo $array[$k]["type"]; ?>;charset=utf8;base64,<?php echo $img ?>"/>
            </td>
            <?php if($k == 3 ) 
            {
                ?></tr><tr><?php
            }
            ?><?php if($k == count($array) ) 
            {
                ?></tr><?php
            }
            ?><?php } ?>
        </table>

        <table id="4" class="memory_game_with_bdd four gameBord">
            <?php for ($k = 0; $k < count($array); $k++) {
                $img=base64_encode($array[$k]['bin']);
            if($k == 0)
            {
                ?> <tr>
            <?php } ?>
            <td class="memory_card">
                <img class="front_img" src="ressources/spr0.jpg">
                <img id="imgTree" class="img-responsive back_img" src="data:<?php echo $array[$k]["type"]; ?>;charset=utf8;base64,<?php echo $img ?>"/>
            </td>
            <?php if($k == 5 ) 
            {
                ?></tr><tr><?php
            }
            ?><?php if($k == count($array) ) 
            {
                ?></tr><?php
            }
            ?><?php } ?>
        </table>
        <?php } ?>
    </div>
</div>
<?php include 'widgets/win_gameOver.php'; ?>