<?php
if(isset($_POST["selectPicture"]))
{
    include '../datas/requetes.php';
	$selectPicture = $_POST["selectPicture"];
    $idTab = $_POST["idTab"];

    session_start(); // pour pouvoir utiliser les sessions
    $select_picture_explode = explode('|', $_POST["selectPicture"]);
    $_SESSION['select_pictureId'] = $select_picture_explode[0];
    $_SESSION['select_pictureName'] = $select_picture_explode[1];
    $nomberPicture = 0;

    $selectPictureIdDisplay = $select_picture_explode[0];
    if($idTab == 3)
    {
        $picturesByIdSql = $pdo->prepare("SELECT * FROM game_pictures where category_id = :category_id LIMIT 4");
    }
    else
    {
        $picturesByIdSql = $pdo->prepare("SELECT * FROM game_pictures where category_id = :category_id LIMIT 6");
    }
    $picturesByIdSql->execute(['category_id' => $selectPictureIdDisplay]); 
    $donneees = $picturesByIdSql->fetchAll();
    $countDonneees = count($donneees);
    $_SESSION['countDonneees'] = $countDonneees;
    $array = array_merge($donneees, $donneees);
    shuffle($array);
    $imgBackground=base64_encode($array[1]['bin']);
    if($idTab == 3)
    {
        for ($k = 0; $k < count($array); $k++) 
        {
            if($k == 0)
            {
                echo '<tr>';
            }
            
            echo '<td class="memory_card">';
            echo '<img class="front_img" src="ressources/spr0.jpg">';
            echo '<img id="imgTree" class="img-responsive back_img" src="data:'.$array[$k]['type'].';charset=utf8;base64,'.base64_encode($array[$k]['bin']).'"/>';
            echo '</td>';

            if($k == 3 ) 
            {
                echo '</tr><tr>';
            }
            if($k == count($array) ) 
            {
                echo'</tr>';
            }
        }
    }
    else if($idTab == 4)
    {
        for ($l = 0; $l < count($array); $l++) 
        {
            if($l == 0)
            {
                echo '<tr>';
            }
            
            echo '<td class="memory_card">';
            echo '<img class="front_img" src="ressources/spr0.jpg">';
            echo '<img id="imgTree" class="img-responsive back_img" src="data:'.$array[$l]['type'].';charset=utf8;base64,'.base64_encode($array[$l]['bin']).'"/>';
            echo '</td>';

            if($l == 3 || $l == 7 ) 
            {
                echo '</tr><tr>';
            }
            if($l == count($array) ) 
            {
                echo'</tr>';
            }
        }
    }
    echo '<script src="js/flip.js"></script>';
}
