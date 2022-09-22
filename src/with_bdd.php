<?php
include 'datas/requetes.php';
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
                            <?php if(empty($donnees)) { ?>
                                <option value="null">Ajouter des images</option>
                            <?php } else { ?>
                                <option value="null">Sélectionner votre grille</option>
                            <?php if(count($donnees) >= 4) {?>
                                <option value="3">2*4</option>
                            <?php } if (count($donnees) >= 6) { ?>
                                <option value="4">3*4</option>
                            <?php } ?>
                        <?php } ?>
                        </select>
                    </td>
                    <td class="tableParamTd">
                        <h3>Sélection de la catégorie d'images: </h3>
                        <select name="select_picture" id="select_picture" class="select_picture">
                            <option value="null">Sélectionner vos images</option>
                        <?php
                        foreach ($categories as $result) {
                            ?> <option value="<?php $result ?>"><?php echo $result["name"] ?></option>
                        <?php
                        } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr class="tableParamTrButtom">
                    <td colspan="2" class="tableParamTdButtom">
                        <!-- <button type="submit" name="confirmParam">Valider paramètres</button>-->
                    </td>
                </tr>
            </table>   
        <br>
    </form>
    <br>
        <div class="blocButtons">
            <button id="button_select" class="button_select" onclick="buttonSelect(0)">Démarrer</button>
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
    <?php if(!empty($donnees)) { 
        $array = array_merge($donnees, $donnees);
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
        <?php } ?>
    </div>
</div>
<?php include 'widgets/win_gameOver.php'; ?>