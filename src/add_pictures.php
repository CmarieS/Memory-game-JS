<?php

if (isset($_POST["valider"])) {
    include('../datas/connexion.php');
    $req = $pdo->prepare("insert into game_pictures(name,size,type,category_id,bin) values(?,?,?,?,?)");
    $exec = $req->execute(array(
        $_FILES["picture"]["name"], $_FILES["picture"]["size"],
        $_FILES["picture"]["type"], $_POST["categorie"], file_get_contents($_FILES["picture"]["tmp_name"])
    ));
}
include('../datas/requete_select_cat.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ajout des images</title>
    <script src="../js/game.js"></script>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="header">
        <button class="retour" onclick="location.href='../index.php'">Retour</button>
    </div>
    <div class="container">
        <div class="addimages">
            <h1>Ajouter une/des image(s)</h1>
            <div class="addimages_form">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="picture">Images: </label>
                    <input type="file" name="picture">
                    <br><br>
                    <label for="categorie">Catégrie de l'image:</label>
                    <select name="categorie">
                        <?php
                        foreach ($categories as $result) {
                        ?> <option value="<?php $result ?>"><?php echo $result["name"] ?></option>
                        <?php
                        } ?>
                    </select>
                    <br><br>
                    <input type="submit" name="valider">
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>