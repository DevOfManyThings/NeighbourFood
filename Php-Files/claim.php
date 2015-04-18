<?php

session_start();

include ("connection.php");

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
} 

$ItemID = $_POST['id'];

$sql = "UPDATE Food_Details
        SET Claimed_By = '".$email."'
        WHERE ItemID = '$ItemID'";
                  
mysqli_query($connection, $sql);

header('Location: charity.php');

?>
