<?php

function calculateDistance($long1, $lat1, $long2, $lat2){
 
    $radius = 6371000;
    $val1 = deg2rad($lat1);
    $val2 = deg2rad($lat2);
    $val3 = deg2rad($lat2-$lat1);
    $val4 = deg2rad($long2-$long1);
    
    $a= sin($val3/2) * sin($val3/2) + cos($val1) * cos($val2) * sin($val4/2) * sin($val4/2);
    $c = (2 * atan2(sqrt($a), sqrt(1-$a)));
    $distance = $radius * $c;
    
    $distanceInMiles = $distance * 0.00062137;
    
    return round($distanceInMiles, 2);
}