<?php
include 'datas/requete_select_cat.php';
?>
<div class="row selectGame col-lg-12">
    <div id="select" class="select col-lg-6">
        <h1 class="title col-lg-11">Sélection du plateau/catégorie d'images</h1>
        <select name="select_picture" id="select_picture" class="select_picture">
            <?php
            foreach ($categories as $result) {
            ?> <option value="<?php $result ?>"><?php echo $result["name"] ?></option>
            <?php
            } ?>
        </select>
        <select name="select_picture" id="select_picture" class="select_picture">
            <?php
            foreach ($categories as $result) {
            ?> <option value="<?php $result ?>"><?php echo $result["name"] ?></option>
            <?php
            } ?>
        </select>
        <button class="button_select" onclick="buttonSelect()">Sélectionner</button>
        <button class="button_select" onclick="buttonReload()">Réinitialiser</button>
        <button class="button_pictures" onclick="location.href='../src/add_pictures.php'">Images</button>
    </div>

</div>