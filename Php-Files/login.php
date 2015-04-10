<?php

?>


<!DOCTYPE html>
<head>
    <title>NeighbourFood</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
</head>

<body>
    <form method="POST" action="authenticate.php">
        <input type="text" name="loginEmail" placeholder="Email" onfocus="this.placeholder = ''">
        <br>
        <br>
        <input type="text" name="loginPass" placeholder="Password" onfocus="this.placeholder = ''">
        <br>
        <br>
        <input type="submit" value="Login">
    </form>
    <p> Don't have an account?</p>
    <form action="register.php">
        <input type="submit" value="Register">
    </form>
</body>
