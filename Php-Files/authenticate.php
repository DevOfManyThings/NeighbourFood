<?php

include ("connection.php");

$email = $_POST['loginEmail'];
$password = $_POST['loginPass'];

$sql = "SELECT Password FROM Client_Details WHERE Email = '$email'";

$result = mysqli_query($connection, $sql);

if (!$result) 
{
    die('Query Failed: ' . mysql_error());
}
else
{
    $pass = "";
    while ($row = mysqli_fetch_array($result)) 
    {
        $pass = $row["Password"];
    }  
}
        
if ($password == $pass)
{
        // Check if its a Business or Charity that just logged in.
        $sql = "SELECT Type FROM Client_Details WHERE Email = '$email'";
        $result = mysqli_query($connection, $sql);
        
        $numRows = mysqli_num_rows($result); 
        
        $type = "";
        while ($row = mysqli_fetch_array($result)) 
        {
            $type = $row["Type"];
        }  
        
        if($type == "Business")
        {
            session_start();
            $_SESSION['login'] = "business";
            header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/business.php');                           
        }
        if($type == "Charity")
        {
            session_start();
            $_SESSION['login'] = "charity";
            header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/charity.php');              
        } 
        else if ($numRows < 1)
        {
            // If the user tries to login with account credentials that aren't recognised
            // the $_SESSION variable isn't set and they are taken back to the Login page.
            session_start();
            $_SESSION['login'] = "";
            header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/login.php'); 
        }
}
			
?>