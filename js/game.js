function buttonSelect() {
    document.getElementById("projectContainer").style.display = "none";
    // Récupération de l'index du <option> choisi pour la selection du plateau
    select_plateau = document.getElementById("select_plateau");
    choice_plat = select_plateau.value;  

    // Récupération de l'index du <option> choisi pour les images
    select_picture = document.getElementById("select_picture");
    choice_picture = select_picture.value;
    if (choice_picture == "null" && choice_plat == "null")
    {
        alert("Veuillez choisir votre plateau et vos images");
    }
    else if (choice_picture == "null" && choice_plat != "null")
    {
        alert("Veuillez choisir vos images");
    }
    else if (choice_plat == "null" && choice_picture != "null")
    {
        alert("Veuillez choisir votre plateau");
    }
    else
    {
        var x = document.getElementsByClassName("open");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].style.display = 'none';
            if (x[i].id != choice_plat)
            {
                document.getElementById(x[i].id).classList.remove("open");
            }
        }
        document.getElementById(choice_plat).style.display = "block";
        document.getElementById(choice_plat).classList.add("open");
        
        if (choice_plat == 3)
        {
            document.getElementById("pair").innerHTML = "4";
            var a = [1, 2, 3, 1, 2, 3, 4, 4]
                .map(p => [p, Math.random()])
                .sort((a, b) => a[1] - b[1])
                .map(p => p[0])
        }
        else if (choice_plat == 4)
        {
            document.getElementById("pair").innerHTML = "6";
            var a = [1,1,2,2,3,3,4,4,5,5,6,6]
                .map(p => [p, Math.random()])
                .sort((a, b) => a[1] - b[1])
                .map(p => p[0])
        }

        var pics = document.getElementsByTagName("img");
        var picsTab = new Array();

        for (let i = 0; i < pics.length; i++) 
        {
            if (pics[i].id == "imgTree" && choice_plat == 3)
            {
                picsTab.push(pics[i]);
                for (let j = 0; j < picsTab.length; j++) {
                    pics[i].src = 'ressources/' + choice_picture +"/spr"+ a[j] + '.jpg';
                }
            }
            else if (pics[i].id == "imgFour" && choice_plat == 4)
            {
                picsTab.push(pics[i]);
                for (let j = 0; j < picsTab.length; j++) {
                    pics[i].src = 'ressources/' + choice_picture + "/spr" + a[j] + '.jpg';
                }  
            }  
        }
    } 
}
function buttonReload(){
    document.getElementById("projectContainer").style.display = "none";
    window.location.reload();
}

