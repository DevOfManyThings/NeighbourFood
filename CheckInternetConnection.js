/*jslint node: true, browser: true */
"use strict";

function checkConnection(formName) {
    var image;
    image = new Image();
    image.src = "https://devweb2014.cis.strath.ac.uk/~ngb12170/317/AppCity/wireless-connection-icon_scale.jpg";
    image.onload = function () {
        document.getElementById(formName).submit();
    };
    image.onerror = function () {
        window.location.href = ("../lostInternetConnection.html");
    };
}


