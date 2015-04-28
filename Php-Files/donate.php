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
    <link rel="stylesheet" type="text/css" href="../style.css"/>
</head>

<?php

echo"<h2 class=\"mainHeading\">Donate</h2>"
. "<!-- Navigation -->"
 . "<form method=\"POST\" action=\"business.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Home\"></form>";

?>

<body>
    <form method="POST" action="donate.php" id="donate">
        <input type="text" name="itemDescription" placeholder="Item Description" />
        <br />
        <input type="number" min="1" name="quantity" placeholder="Quantity" />
        <br />
        <input type="time" name="start" placeholder="Available from... 24-hour(HH:MM)" onfocus="this.placeholder = ''"/>
        <br />
        <input type="time" name="end" placeholder="Available Until... 24-hour(HH:MM)" onfocus="this.placeholder = ''"/>
        <br /> 
        <button type="button" class="button" onclick="checkConnection('donate')">Donate</button>
    </form>
    <script src="../layout.js"></script>
    <script src="../CheckInternetConnection.js"></script> 
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
if (isset($_POST['start']) && (isset($_POST['end']))) 
{
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    if (check_time($start) && (check_time($end)))  
    {
        $continue = true;
    } else {
        $continue = false;
    }
}

function check_time($time) 
{
    if(strtotime($time)) {
        return true;
    } else {
        return false;
    }
}

// Prepared MySQL statement for adding a donation.
if ($continue == true)
{
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
    }   

    $sql = "INSERT INTO Food_Details ( Item,  Quantity,  Time_Start,  Claimed_By,  Business_Email, Time_End, ItemID, Date_Donated)"
                        .  "VALUES   (  ?,        ?,         ?,           ?,              ?,          ?,      NULL,   CURDATE())";
    
    $stmt = mysqli_stmt_init($connection);
    $claimedBy= "Unclaimed";

    if (mysqli_stmt_prepare($stmt, $sql))
    {
        mysqli_stmt_bind_param($stmt, 'ssssss', $itemDescription, $quantity, $start, $claimedBy, $email, $end);
        mysqli_stmt_execute($stmt);
    }  
    header('Location: business.php');
}

?>
