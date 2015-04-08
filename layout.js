/*jslint node: true, browser: true */
"use strict";
/* Function to deal with height inaccuracy in css, and resize as needed. */
function resize() {
    /* Resize element height to fit screen
     *  L = unit for one percent of screen height
     */
    var i = null,
        element = null,
        screenHeight = window.innerHeight,
        L = (screenHeight / 100);
    for (i = 0; i < document.getElementsByTagName("*").length; i += 1) {
        element = document.getElementsByTagName("*")[i];
        if (element.tagName !== "HTML" &&
                element.tagName !== "HEAD" &&
                element.tagName !== "TITLE" &&
                element.tagName !== "META" &&
                element.tagName !== "LINK" &&
                element.tagName !== "SCRIPT" &&
                element.tagName !== "BODY") {
            console.log("Tag Name :  " + element.tagName);
            if (element.tagName === "BUTTON"){
                element.style.height = String(5 * L) + "px"; 
            }
            if (element.tagName === "INPUT"){
                element.style.height = String(5 * L) + "px";
                element.style.marginTop = String(5 * L) + "px"; 
            }
        }
    }
}
resize();
window.addEventListener("resize", resize);


