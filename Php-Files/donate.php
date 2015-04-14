<?php

session_start();

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
    <form method="POST" action="donate.php">
        <input type="text" name="itemDescription" placeholder="Item Description" />
        <br />
        <input type="number" min="1" name="quantity" placeholder="Quantity" />
        <br />
        <input type="text" name="start" placeholder="Start Time" onfocus="this.placeholder = ''"/>
        <br />
        <input type="text" name="end" placeholder="End Time" onfocus="this.placeholder = ''"/>
        <br />   
        <input type="submit" value="Donate">
    </form>
    <script src="layout.js"></script>
</body>
</html>

<?php

$continue = false;

if (isset($_POST['itemDescription'])) {
    $itemDescription = $_POST['itemDescription'];

    $itemDescriptionLength = strlen(trim($itemDescription));
    if ($itemDescriptionLength >= 0 && $itemDescriptionLength <= 20) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
    
    if ($quantity >= 1) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['start'])) {
    $start = $_POST['start'];

    $startLength = strlen(trim($start));
    if ($startLength > 0) {
        $continue = true;
    } else {
        $continue = false;
    }
}
if (isset($_POST['end'])) {
    $end = $_POST['end'];

    $endLength = strlen(trim($end));
    if ($endLength > 0) {
        $continue = true;
    } else {
        $continue = false;
    }
}

// Prepared MySQL statement for adding a donation.
if ($continue == true)
{
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
    }   
    
    $sql = "INSERT INTO Food_Details ( Item,  Quantity,  Time_Start,  Claimed,  Business_Email, Time_End, ItemID)"
                        .  "VALUES   (  ?,        ?,         ?,          0,           ?,           ?,      NULL )";
    
    $stmt = mysqli_stmt_init($connection);

    if (mysqli_stmt_prepare($stmt, $sql))
    {
        mysqli_stmt_bind_param($stmt, 'sssss', $itemDescription, $quantity, $start, $email, $end);
        mysqli_stmt_execute($stmt);
    }  
    header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/donate.php');
}

?>
