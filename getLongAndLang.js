function checkGpsOn() {
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(setLocation);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function setLocation(position){
    alert("test2");
    document.getElementById("phoneLongitude").value = position.coords.longitude;
    document.getElementById("phoneLatitude").value = position.coords.latitude;
    alert("Latitude: "+document.getElementById("phoneLatitude").value);
    alert("Longitude: "+document.getElementById("phoneLongitude").value);
}