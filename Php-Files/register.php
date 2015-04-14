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
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
    <form method="POST" action = "register.php">
        <input type="text" name="orgName" placeholder="Business/Charity Name">
                <br>
                <br>
                <input type="number" min="1" name="number" placeholder="Number">
                <br>
                <input type="text" name="street" placeholder="Street">
                <br>
                <input type="text" name="postCode" placeholder="Post Code">
                <br>
                <br>
                <input type="text" name="regEmail" placeholder="Email"> 
                <br>
                <br>
                <input type="text" name="regPass" placeholder="Password">
                <br>
                <br>
                <input type="text" name="re-enterPass" placeholder="Re-Enter Password">
                <br>
                <br>
                Business
                <input type="radio" name="orgSelection" value="Business">
                <br>
                <br>
                Charity
                <input type="radio" name="orgSelection" value="Charity">
                <br>
                <br>
                <input type="submit" value="Register">
            </form>
            <script src="layout.js"></script>
</body>
</html>

<?php
$continue = false;

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
        header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/login.php');
    } else {
        $sql = "INSERT INTO Client_Details (OrgName, Number, Street, Postcode, Email, Password, Type )"
                . "VALUES (   ?,      ?,      ?,       ?,       ?,       ?,      ?  )";

        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssssss', $orgName, $number, $street, $postCode, $email, $password, $type);
            mysqli_stmt_execute($stmt);
        }

        // We dont set the login session variable here because
        // instead we direct the user to the login page where
        // they can login using the account they just created.
        $_SESSION['login'] = "";

        header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/login.php');
    }
}
?>