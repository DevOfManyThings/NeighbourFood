/*jslint node: true, browser: true */
"use strict";
/* Function to deal with height/ vertical spacing issues in css, and resize as needed to fit each screen. */
function resize() {
    /* Resize element height to fit screen
     *  L = unit for one percent of screen height
     */
    var i = null,
        element = null,
        screenHeight = window.outerHeight,
        L = (screenHeight / 100);
    alert("height :  " + screenHeight);

    for (i = 0; i < document.getElementsByTagName("*").length; i += 1) {
        element = document.getElementsByTagName("*")[i];
        if (element.tagName !== "HTML" &&
                element.tagName !== "HEAD" &&
                element.tagName !== "TITLE" &&
                element.tagName !== "META" &&
                element.tagName !== "LINK" &&
                element.tagName !== "SCRIPT" &&
                element.tagName !== "BODY") {
            
            
            if (element.tagName === "INPUT" || element.tagName === "BUTTON"){
                element.style.height = String(7.5 * L) + "px";
                element.style.marginTop = String(7.5 * L) + "px"; 
            }
        }
    }
}
resize();
window.addEventListener("resize", resize);
setTimeout(100,resize);

