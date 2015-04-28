<?php

include ("connection.php");
?>
<!DOCTYPE html>
<html manifest="../neighbourfood.appcache">
<head >
    <title>NeighbourFood</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <script src="../navigate.js"></script>
</head>

<body class="closed">
   
    
    <?php
$email = $_POST['loginEmail'];
$password = $_POST['loginPass'];

$sql = "SELECT Password FROM Client_Details WHERE Email = '$email'";

$result = mysqli_query($connection, $sql);
?>
  
    <?php

if (!$result) {
    die('Query Failed: ' . mysql_error());
} else {
    $pass = "";
    while ($row = mysqli_fetch_array($result)) {
        $pass = $row["Password"];
    }
}

if ($password == $pass) {
    // Check if its a Business or Charity that just logged in.
    $sql = "SELECT Type FROM Client_Details WHERE Email = '$email'";
    $result = mysqli_query($connection, $sql);

    $numRows = mysqli_num_rows($result);

    $type = "";
    while ($row = mysqli_fetch_array($result)) {
        $type = $row["Type"];
    }

    if ($type == "Business") {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['login'] = "business";
        header('Location: business.php');
    } else if ($type == "Charity") {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['login'] = "charity";
        header('Location: charity.php');
    }
    // If the user tries to login with account credentials that aren't recognised
    // the $_SESSION variable isn't set and they are taken back to the Login page.
    else if (numrows < 1) {
        session_start();
        $_SESSION['login'] = "";
        
        echo "<script type=\"text/javascript\">alert(\"Login unsuccessful. Please check credentials then try again.\");</script> ";
        echo "<script type=\"text/javascript\">navTo(\"login.php\");</script> ";
    
        
    }
} else { // If nothing is entered into the login or password textbox.
    session_start();
    $_SESSION['login'] = "";
    echo "<script type=\"text/javascript\">alert(\"Login unsuccessful. Please check credentials then try again.\");</script> ";
    echo "<script type=\"text/javascript\">navTo(\"login.php\");</script> ";
    
    
}
?>
    <script src="../layout.js"/>
</body>
</html>
