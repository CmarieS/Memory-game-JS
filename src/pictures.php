<?php
include('../datas/connexion.php');
include('../datas/requetes.php');

if (isset($_POST["addPictures"])) {
    $countfiles = count($_FILES['picture']['name']);
    for($i=0;$i<$countfiles;$i++){
    $req = $pdo->prepare("insert into game_pictures(name,size,type,category_id,bin) values(?,?,?,?,?)");
    $exec = $req->execute(array(
        $_FILES["picture"]["name"][$i], $_FILES["picture"]["size"][$i],
        $_FILES["picture"]["type"][$i], $_POST["categorie"], file_get_contents($_FILES["picture"]["tmp_name"][$i])
    ));
    }
    header("Refresh:1");
}
if (isset($_POST["deletePictures"])) {
    $array_pictures = $_POST["pictures"];

    foreach ($array_pictures as $picture) {
        $data = [
            'id' => $picture,
        ];
        $sql = "DELETE from game_pictures where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }
    header("Refresh:1");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Gestion des images</title>
    <script src="../js/game.js"></script>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="header">
        <button class="retour" onclick="location.href='../index.php'">Retour</button>
    </div>
    <div class="container row col-lg-12">
        <div class="addPictures col-lg-6">
            <h1>Ajouter une/des image(s)</h1>
            <div class="addPictures_form">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="picture">Images: </label>
                    <input class="inputPictures" type="file" name="picture[]" multiple>
                    <br><br>
                    <label for="categorie">Catégorie de l'image:</label>
                    <select name="categorie">
                        <option value="null">Choix de la catégorie</option>
                        <?php
                        foreach ($categories as $category) {
                        ?> <option value="<?php $category ?>"><?php echo $category["name"] ?></option>
                        <?php
                        } ?>
                    </select>
                    <br><br>
                    <input type="submit" name="addPictures" value="Ajouter">
            </div>
            </form>
        </div>
        <div class="deletePictures col-lg-6">
            <h1>Supprimer une/des image(s)</h1>
            <div class="deletePictures_form">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-lg-12 row">
                    <label class="col-lg-2" for="picture">Images: </label> 
                    <p class="col-lg-10"><?php echo $countPictures ?></p>
                    </div>
                    
                    <br>
                    <select name="pictures[]" multiple>
                        <?php
                        foreach ($pictures as $picture) {
                        ?> <option value="<?php echo $picture["id"] ?>"><?php echo $picture["name"] ?></option>
                        <?php
                        } ?>
                    </select>
                    <br><br>
                    <input type="submit" name="deletePictures" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>