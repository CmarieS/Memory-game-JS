/*settings variables*/
var fireworkDimensions = 10; //make each firework 10px in width and height
var fireworkTransitionTime = 1000; //in milliseconds
var resizeTimer = false; //resize delay timer (not set)
var rayWidth = 2; //width of firework ray
var rayLength = 100; //length of firework ray
var fireworkRayPositions = [
    [0, 3],
    [10, 5],
    [8, 6],
    [5, 8],
    [2, 8],
    [2, 6],
    [0, 4],
    [0, 2],
    [2, 2],
    [4, 0],
    [8, 2],
    [10, 2]
]; //firework array positions in px format: bottom,right
var blurLights = true;
var windowWidth = window.innerWidth; //get width of viewport (updated when window is resized)
var windowHeight = window.innerHeight; //get height of viewport (updated when window is resized)

// IF THE BROWSER IS INTERNET EXPLORER 10 OR 11
var UAString = navigator.userAgent;
if ((navigator.appVersion.indexOf("MSIE 10") != -1) || (UAString.indexOf("Trident") !== -1 && UAString.indexOf("rv:11") !== -1)) {
    //ie 10 and 11 don't support filter blurring
    blurLights = false;
}

var fireworkCounter = 0;
var fireworkRayRotation = [0, -30, -60, -90, -120, -150, -180, -210, -240, 90, 60, 30];

window.addEventListener('load', function () {
    initialize();
});

function initialize() {
    fireworkTimers = [];
    createFireworks();

    function createFireworks() {
        var fireworkContainer = document.getElementById('fireworksContainer');
        fireworkContainer.innerHTML = '';
        var numFireworks = Math.floor(window.innerWidth / fireworkDimensions);
        var colors = ['#001EFF', '#DE0013', '#E2BC00', '#6600FF', '#78DD00', '#E06CBE'];
        for (var i = 0; i < numFireworks; i++) {
            var firework = document.createElement('div');
            firework.className = 'fireworkContainer';
            firework.style.width = fireworkDimensions + 'px';
            firework.style.height = fireworkDimensions + 'px';
            var fireworkColor = colors[Math.floor(Math.random() * colors.length)];
            firework.style.backgroundColor = fireworkColor;
            firework.style.left = Math.floor(Math.random() * ((windowWidth - firework.offsetWidth) - (5 * firework.offsetWidth) + 1)) + (5 * firework.offsetWidth) + 'px';
            var numFireworkRay = Math.floor(Math.random() * 20);
            for (var j = 0; j < 12; j++) {
                var ray = document.createElement('div');
                ray.style.backgroundColor = fireworkColor;
                ray.style.bottom = fireworkRayPositions[j][0] + 'px';
                ray.style.right = fireworkRayPositions[j][1] + 'px';
                ray.className = 'fireworkRay';
                ray.style.oTransform = 'rotate(' + fireworkRayRotation[j] + 'deg)';
                ray.style.mozTransform = 'rotate(' + fireworkRayRotation[j] + 'deg)';
                ray.style.webkitTransform = 'rotate(' + fireworkRayRotation[j] + 'deg)';
                ray.style.msTransform = 'rotate(' + fireworkRayRotation[j] + 'deg)';
                ray.style.transform = 'rotate(' + fireworkRayRotation[j] + 'deg)';
                firework.appendChild(ray);
            }
            if (blurLights == true) {
                var light = document.createElement('div');
                firework.appendChild(light);
                light.className = 'light';
            }
            fireworkContainer.appendChild(firework)
        }
        fireworkTiming();
    }
}

function fireworkTiming() {
    var numCompletedFireworks = 0;
    var fireworks = document.getElementsByClassName('fireworkContainer');
    for (var i = 0; i < fireworks.length; i++) {
        createTimer(i, fireworks[i]);
    }

    function createTimer(i, firework) {
        fireworkTimers.push(window.setTimeout(function () {
            firework.style.bottom = Math.floor(Math.random() * ((windowHeight * .9) - (windowHeight * .7) + 1)) + (windowHeight * .7) + 'px';
            numCompletedFireworks++;
            explodeTimer(firework);
            if (numCompletedFireworks == fireworks.length - 1) {
                //all fireworks have been exploded, reset them
                repositionFireworks();
            }
        }, i * Math.floor(Math.random() * (4000 - 2000 + 1)) + 2000));
    }

    function explodeTimer(firework, i) {
        window.setTimeout(function () {
            var fireworkRays = firework.getElementsByClassName('fireworkRay');
            var light = firework.getElementsByClassName('light')[0];
            for (var i = 0; i < fireworkRays.length; i++) {
                fireworkRays[i].style.height = rayLength + 'px';
                fireworkRays[i].style.width = rayWidth + 'px';
                fireworkRays[i].style.boxShadow = "10px 10px 10px #fff";
            }
            if (blurLights == true) {
                light.style.width = 2 * rayLength + 'px';
                light.style.height = 2 * rayLength + 'px';
                light.style.backgroundColor = firework.style.backgroundColor;
            }
            window.setTimeout(function () {
                firework.style.opacity = '0';
            }, 800);
        }, fireworkTransitionTime - 200);
    }
}

function repositionFireworks() {
    var fireworks = document.getElementsByClassName('fireworkContainer');
    var colors = ['#001EFF', '#DE0013', '#E2BC00', '#6600FF', '#78DD00', '#E06CBE'];
    for (var i = 0; i < fireworks.length; i++) {
        var fireworkColor = colors[Math.floor(Math.random() * colors.length)];
        fireworks[i].style.opacity = '1';
        fireworks[i].lastChild.removeAttribute('style');
        var fireworkRays = fireworks[i].getElementsByClassName('fireworkRay');
        for (var j = 0; j < fireworkRays.length; j++) {
            fireworkRays[j].style.width = '0px';
            fireworkRays[j].style.height = '0px';
            fireworkRays[j].style.backgroundColor = fireworkColor;
        }
        fireworks[i].style.backgroundColor = fireworkColor;
        fireworks[i].style.left = Math.floor(Math.random() * ((windowWidth - fireworks[i].offsetWidth) - fireworks[i].offsetWidth + 1)) + fireworks[i].offsetWidth + 'px';
        fireworks[i].style.bottom = '0';
    }
    for (var i = 0; i < fireworkTimers.length; i++) {
        window.clearTimeout(fireworkTimers[i]);
    }
    fireworkTiming();
}

window.addEventListener('resize', function () {
    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;
    window.clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(function () {
        initialize();
    }, 100);
});