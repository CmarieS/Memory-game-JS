function buttonSelect() {
    var timer = 0;
    var countDown = 0;
    document.getElementById("winContainer").style.display = "none";
    // Récupération de l'index du <option> choisi pour la selection du plateau
    select_gameBord = document.getElementById("select_gameBord");
    choice_game = select_gameBord.value;  

    // Récupération de l'index du <option> choisi pour les images
    select_picture = document.getElementById("select_picture");
    choice_picture = select_picture.value;
    if (choice_picture == "null" && choice_game == "null")
    {
        alert("Veuillez choisir votre plateau et vos images");
    }
    else if (choice_picture == "null" && choice_game != "null")
    {
        alert("Veuillez choisir vos images");
    }
    else if (choice_game == "null" && choice_picture != "null")
    {
        alert("Veuillez choisir votre plateau");
    }
    else
    {
        var x = document.getElementsByClassName("open");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].style.display = 'none';
            if (x[i].id != choice_game)
            {
                document.getElementById(x[i].id).classList.remove("open");
            }
        }
        document.getElementById(choice_game).style.display = "block";
        document.getElementById(choice_game).classList.add("open");
        
        if (choice_game == 3)
        {
            timer = 60000;
            countDown = 1;
            document.getElementById("pair").innerHTML = "4";
            var a = [1, 2, 3, 1, 2, 3, 4, 4]
                .map(p => [p, Math.random()])
                .sort((a, b) => a[1] - b[1])
                .map(p => p[0])
        }
        else if (choice_game == 4)
        {
            timer = 120000;
            countDown = 2;
            document.getElementById("pair").innerHTML = "6";
            var a = [1,1,2,2,3,3,4,4,5,5,6,6]
                .map(p => [p, Math.random()])
                .sort((a, b) => a[1] - b[1])
                .map(p => p[0])
        }
        setTimeout(end, timer);
        countdown("countdown", countDown, 0);

        var pics = document.getElementsByTagName("img");
        var picsTab = new Array();

        for (let i = 0; i < pics.length; i++) 
        {
            if (pics[i].id == "imgTree" && choice_game == 3)
            {
                picsTab.push(pics[i]);
                for (let j = 0; j < picsTab.length; j++) {
                    pics[i].src = 'ressources/' + choice_picture +"/spr"+ a[j] + '.jpg';
                }
            }
            else if (pics[i].id == "imgFour" && choice_game == 4)
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
    document.getElementById("winContainer").style.display = "none";
    document.getElementById("blocGameover").style.display = "none";
    window.location.reload();
}
function end()
{
    if (document.getElementById("winContainer").style.display != "block")
    {
        document.getElementById("blocGameover").style.display = "block";
    }
}
function countdown(elementName, minutes, seconds) {
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits(n) {
        return (n <= 9 ? "0" + n : n);
    }
    function updateTimer() {
        msLeft = endTime - (+new Date);
        if (msLeft < 1000) {
            element.innerHTML = "0:00";
        } else {
            time = new Date(msLeft);
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds());
            if (document.getElementById("winContainer").style.display != "block")
            {
                setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
            }
        }
    }
    element = document.getElementById(elementName);
    endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
    updateTimer();
}

