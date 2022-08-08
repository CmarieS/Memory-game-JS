<?php
include 'datas/requetes.php';
?>
<div class="row selectGame col-lg-12">
    <div id="select" class="select col-lg-6">
        <h1 class="title col-lg-11">Sélection du plateau/catégorie d'images</h1>
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
    </div>
    <?php if(!empty($donnees)) { 
    
    $test = [];
    array_push($test,$donnees);
        
    ?>
    <table id="3" class="memory_game_with_bdd">
            <?php for ($j = 1; $j <= 2; $j++) { ?>
                <tr>
                    <?php for ($k = 0; $k <= 3; $k++) {
                        $img=base64_encode($donnees[$k]['bin']);
                    ?>
                    <td class="memory_card">
                        <img class="img-responsive" src="data:<?php echo $donnees[$k]["type"]; ?>;charset=utf8;base64,<?php echo $img ?>"/>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</div>
<?php include 'widgets/win_gameOver.php'; ?>