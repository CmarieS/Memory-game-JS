function buttonSelect(paramTab) {

    document.getElementById("winContainer").style.display = "none";
    if(document.getElementById("bloc_countDown").lastChild.innerHTML != "")
    {
        document.getElementById("bloc_countDown").removeChild(document.getElementById("bloc_countDown").lastChild);
        var e = document.createElement("div");
        e.setAttribute('id','countdown');
        document.getElementById("bloc_countDown").appendChild(e);
    }
    var memory_car_num = document.getElementsByClassName("memory_card");
    for (let index = 0; index < memory_car_num.length; index++) {
        console.log(memory_car_num[index].classList.contains("flip"));
        if(memory_car_num[index].classList.contains("flip"))
        {
            memory_car_num[index].classList.remove("flip");
        }
    }
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
        gameWithNoBdd(paramTab);
    } 
}

function gameWithNoBdd(paramtab)
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
        
        if(choice_game == 3 && paramtab == 1)
        {
            var a = [1, 2, 3, 1, 2, 3, 4, 4]
                    .map(p => [p, Math.random()])
                    .sort((a, b) => a[1] - b[1])
                    .map(p => p[0])
        }
        else if(choice_game == 4 && paramtab == 1)
        {
            var a = [1,1,2,2,3,3,4,4,5,5,6,6]
                    .map(p => [p, Math.random()])
                    .sort((a, b) => a[1] - b[1])
                    .map(p => p[0])
        }
        pair(choice_game)
    
        let pics = document.getElementsByTagName("img");
        let picsTab = new Array();

        for (let i = 0; i < pics.length; i++) 
        {
            if (pics[i].id == "imgTree" && choice_game == 3 && paramtab == 1)
            {
                picsTab.push(pics[i]);
                for (let j = 0; j < picsTab.length; j++) {
                    pics[i].src = 'ressources/' + choice_picture +"/spr"+ a[j] + '.jpg';
                }
            }
            else if (pics[i].id == "imgFour" && choice_game == 4 && paramtab == 1)
            {
                picsTab.push(pics[i]);
                for (let j = 0; j < picsTab.length; j++) {
                    pics[i].src = 'ressources/' + choice_picture + "/spr" + a[j] + '.jpg';
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
    element = document.getElementById(elementName).lastChild;
    endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
    updateTimer();
}

function selectShowDisplay()
{
    
    if (document.getElementById("select").classList.contains("selectDisplay"))
    {
        document.getElementById("select").classList.remove("selectDisplay");
        document.getElementById('close_button').innerHTML = "->";
        document.getElementById("tabGame").classList.add("col-lg-6");
        document.getElementById("select").classList.remove("col-lg-12");
    }
    else
    {
        document.getElementById("select").classList.add("selectDisplay");
        document.getElementById('close_button').innerHTML = "+";
        document.getElementById("tabGame").classList.remove("col-lg-6");
        document.getElementById("select").classList.add("col-lg-12");
    }
    
}

function pair(choice_game)
{
    var timer = 0;
    var countDown = 0;
    if (choice_game == 3)
    {
        timer = 60000;
        countDown = 1;
        document.getElementById("pair").innerHTML = "4";
            
    }
    else if (choice_game == 4)
    {
        timer = 120000;
        countDown = 2;
        document.getElementById("pair").innerHTML = "6";
            

    }
    setTimeout(end, timer);
    countdown("bloc_countDown", countDown, 0);
}