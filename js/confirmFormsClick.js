$(document).ready(function(){
    $(".confirmParam").click(function(){
        let select_picture = document.getElementById("select_picture").value;
        $.ajax({
            url:'/src/confirmParamForm.php',
            type:'POST',
            data: {selectPicture: select_picture, idTab: 3},
            success: function(result){
                $("#3").html(result);
            }
        });
        return false;
    });
    $(".nextGame").click(function(){
        let select_picture = document.getElementById("select_picture").value;
        $.ajax({
            url:'/src/confirmParamForm.php',
            type:'POST',
            data: {selectPicture: select_picture, idTab: 4},
            success: function(result){
                $("#4").html(result);
            }
        });
        return false;
    });
});