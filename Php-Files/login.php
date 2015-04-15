<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>NeighbourFood</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <link rel="icon" sizes="192x192" href="../icon.png" />
    <link rel="apple-touch-icon" href="../icon.png" />
    <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
</head>

<body>
    <header>
        <img id="icon" src="../icon.png" alt="icon"/>
        <h1 id="heading"> NeighbourFood </h1>
    </header>
    <?php if (empty($_SESSION['login'])) { ?>
        <form method="POST" action="authenticate.php">
            <input type="text" name="loginEmail" placeholder="Email" onfocus="this.placeholder = ''">
            <br>
            <br>
            <input type="text" name="loginPass" placeholder="Password" onfocus="this.placeholder = ''">
            <br>
            <br>
            <input class="button" type="submit" value="Login">
        </form>
        <p> Don't have an account?</p>
        <form action="register.php">
            <input class="button" type="submit" value="Register">
        </form>
    <?php } ?>

    <?php if (!empty($_SESSION['login'])) { ?>
        <form method="POST" action="logout.php">
            <input class="button" type = "submit" value = "Logout">
        </form>
    <?php } ?>
    <script src="../layout.js"></script>  
</body>
</html>
