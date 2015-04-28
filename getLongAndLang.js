function checkGpsOn() {
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(setLocation);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function setLocation(position){
    document.getElementById("phoneLongitude").value = position.coords.longitude;
    document.getElementById("phoneLatitude").value = position.coords.latitude;
}