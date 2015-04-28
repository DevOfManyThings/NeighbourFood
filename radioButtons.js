/*jslint node: true, browser: true */
"use strict";
function checkRadio(num) {
    
    if (num === 1) {
        document.getElementById("radioBusiness").checked = true;
        
        
        document.getElementById("buttonBusiness").className = "radioButtonChecked";
        document.getElementById("buttonCharity").className = "radioButton";
        
    }
    if (num === 2) {
        
        document.getElementById("radioCharity").checked = true;
        
        document.getElementById("buttonCharity").className = "radioButtonChecked";
        document.getElementById("buttonBusiness").className = "radioButton";
        
    }

     
    
}


