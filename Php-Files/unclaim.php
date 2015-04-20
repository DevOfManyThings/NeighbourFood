<?php

session_start();

include ("connection.php");

$ItemID = $_POST['id'];

$sql = "UPDATE Food_Details
        SET Claimed_By = 'Unclaimed'
        WHERE ItemID = '$ItemID'";
                  
mysqli_query($connection, $sql);

header('Location: myClaims.php');

?>

