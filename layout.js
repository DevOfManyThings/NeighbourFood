/*jslint node: true, browser: true */
"use strict";
/* Function to deal with height/ vertical spacing issues in css, and resize as needed to fit each screen. 
 * Used alongside media query in css3 to return less diverse results of how elements are displayed
 * on devices with different screen proportions. Also allows for screen-rotation adjustments to keep
 * elements looking right. */
function resize() {
    /* Resize element height to fit screen
     *  L = unit for one percent of screen height
     */
    var i = null,
        element = null,
        screenHeight = window.outerHeight,
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
            
            if (element.className === "icon") {
                element.style.height = String(15 * L) + "px";
                element.style.marginTop = String(3 * L) + "px";
                element.style.marginBottom = String(2 * L) + "px";
            }
            if (element.className === "mainHeading") {
                element.style.height = String(10 * L) + "px";
                element.style.marginTop = String(L) + "px";
                element.style.marginBottom = String(2 * L) + "px";
                element.style.paddingTop = String(2 * L) + "px";
            }
            if (element.tagName === "HR") {
                element.style.marginTop = String(10 * L) + "px";
                element.style.marginBottom = String(5 * L) + "px";
            }
            if (element.tagName === "INPUT" || element.tagName === "BUTTON"){
                if(element.getAttribute("type") !== "radio") {
                    element.style.height = String(7 * L) + "px";
                    element.style.marginTop = String(2 * L) + "px";
                    element.style.marginBottom = String(1 * L) + "px";
                }
            }
            
        }
    }
}
resize();
window.addEventListener("resize", resize);
setTimeout(100,resize);

