<?php

session_start();

include ("connection.php");

$ItemID = $_POST['id'];

$sql = "DELETE FROM Food_Details
        WHERE ItemID = '$ItemID'";
                  
mysqli_query($connection, $sql);

header('Location: business.php');

?>
