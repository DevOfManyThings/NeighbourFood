<?php

include ("connection.php");

?>

<!DOCTYPE html>
<head>
    <title>NeighbourFood</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <script src="../getLongAndLang.js"> </script>
</head>

<body>
    
        <h1 class="heading">
            Register
        </h1>
    <form method="POST" action="register.php" id="register">
        <h3 class="warning">
            Please only register in your place of business
        </h3>
        <h4 class="smallWarning">
            We use your location to calculate distances for charities
        </h4>
        <h2 class="miniHeading">Organisation</h2>
        
                <input type="text" name="orgName" placeholder="Business/Charity Name">
                <input type="hidden" name="longitude" value="" id="phoneLongitude" />
                <input type="hidden" name="latitude" value="" id="phoneLatitude"/>
                <br />
                <h2 class="miniHeading">Organisation Address</h2>
                <input type="number" min="1" name="number" placeholder="Number">
                <br />
                <input type="text" name="street" placeholder="Street">
                <br />
                <input type="text" name="postCode" placeholder="Post Code">
                <br />
                <h2 class="miniHeading">Login Details</h2>
                <br />
                <input type="email" name="regEmail" placeholder="Email"> 
                <br />
                <input type="password" name="regPass" placeholder="Password">
                <br />
                <input type="password" name="re-enterPass" placeholder="Re-Enter Password">
                <br />
                <h2 class="miniHeading">Select Account Type</h2>
                <div class="radioMenu">
                <div id="buttonBusiness" type="button" class="radioButton" onclick="checkRadio(1);">Donate as a Business</div>
                <input id="radioBusiness" type="radio" name="orgSelection" value="Business" hidden>
                </div>
                <div class="radioMenu">
                 <div id="buttonCharity" type="button" class="radioButton" onclick="checkRadio(2);">Claim as a Charity</div>
                 <input id="radioCharity" type="radio" name="orgSelection" value="Charity" hidden>   
                </div>
                <br />
                <button class="button" type="button" onclick="checkConnection('register')">Register</button>
            </form>
            <script src="../layout.js"></script>
            <script src="../radioButtons.js"></script>
            <script>checkGpsOn();</script>
            <script src="../CheckInternetConnection.js"></script> 
</body>
</html>

<?php
$continue = false;
$firstTime = 0;
if (isset($_POST['longitude'])){
    $longitude = $_POST['longitude'];
    
    $longitudeLength = strlen(trim($longitude));
    if($longitudeLength >0){
        $continue = true;
    }
    else {
        $continue = false;
    }
}
if (isset($_POST['latitude'])){
    $latitude = $_POST['latitude'];
    
    $latitudeLength = strlen(trim($latitude));
    if($latitudeLength >0){
        $continue = true;
    }
    else {
        $continue = false;
    }
}

if (isset($_POST['orgName'])) {
    $orgName = $_POST['orgName'];

    $orgNameLength = strlen(trim($orgName));
    if ($orgNameLength >= 0 && $orgNameLength <= 15) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['number'])) {
    $number = $_POST['number'];

    $numberLength = strlen(trim($number));
    if ($numberLength >= 1) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['street'])) {
    $street = $_POST['street'];

    $streetLength = strlen(trim($street));
    if ($streetLength >= 0) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['postCode'])) {
    $postCode = $_POST['postCode'];

    $postCodeLength = strlen(trim($postCode));
    if ($postCodeLength >= 0 && $postCodeLength <= 6) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['regEmail'])) {
    $email = $_POST['regEmail'];

    $regEmailLength = strlen(trim($email));
    if ($regEmailLength >= 5 && $regEmailLength <= 30) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['regPass'])) {
    $password = $_POST['regPass'];

    $regPassLength = strlen(trim($password));
    if ($regPassLength >= 5 && $regPassLength <= 15) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['re-enterPass'])) {
    $rePassword = $_POST['re-enterPass'];

    if ($rePassword == $password) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['orgSelection'])) {
    $type = $_POST['orgSelection'];
    $continue = true;
} else {
    $continue = false;
}

if ($continue == true) {

    // Check if email is already being used for a registered account.
    $sql = "SELECT * FROM Client_Details WHERE email = '$email'";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        // Email already in use - take them back to the login page.         
        echo "<script type=\"text/javascript\">alert(\"Registration unsuccessful. Email is already in use. Please try again.\");</script> ";
    echo "<script type=\"text/javascript\">navTo(\"login.php\");</script> ";
    } else {
        $sql = "INSERT INTO Client_Details (OrgName, Number, Street, Postcode, Email, Password, Type, Longitude, Latitude)"
                                 . "VALUES (   ?,      ?,      ?,       ?,       ?,       ?,      ?,      ?,         ?)";

        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssssssdd', $orgName, $number, $street, $postCode, $email, $password, $type, $longitude, $latitude);
            mysqli_stmt_execute($stmt);
        }

        // We dont set the login session variable here because
        // instead we direct the user to the login page where
        // they can login using the account they just created.
        $_SESSION['login'] = "";

        header('Location: login.php');
    }
} else {
  
    
}
?>
