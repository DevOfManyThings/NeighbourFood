<?php

    include ("connection.php");
    include ("checkCharityLogin.php");
    include ("timeCheck.php");
    
?>

<!DOCTYPE html>
<head>
    <title>NeighbourFood</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <script src="navigate.js"></script>
    <script src="claim.js"></script>
</head>
<body>
<?php



if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

$sql = "SELECT OrgName
        FROM Client_Details
        WHERE Email = '$email'";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$row = mysqli_fetch_row($result);

echo "<header>"
 . "<h2> Hello $row[0]!</h2>"
 . "</header>"
 . "<!-- Navigation -->"
 . "<form method=\"POST\" action=\"myClaims.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"My Claims\"></form>"
 . "<form method=\"POST\" action=\"logout.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Logout\"></form>";



// PHP to show the donations available.
$sql = "SELECT a.Item, a.Quantity,
               DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
               DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
               a.ItemID
               FROM Food_Details a
               WHERE a.Claimed_By = 'Unclaimed'";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    echo "<p>Available Donations<p>"
    . "<table id=\"donations\">"
    . "<thead>"
    . "<tr>"
    . "<th>Item</th>"
    . "<th>Available</th>"
    . "<th>Distance</th>"
    . "<th></th>"
    . "</tr>"
    . "</thead><tbody>";


    // Output data of each row.
    while ($row = $result->fetch_assoc()) {
        $ItemID = $row["ItemID"];
        echo "<tr>"
        . "<td>" . $row["Item"]. " (" . $row["Quantity"]. ")</td>"
        . "<td>" . $row["Time_Start"] ." - " . $row["Time_End"] . "</td>"
        . "<td>" ?><form action="claim.php" method="POST">
                   <input type="hidden" name="id" value="<?php echo $ItemID; ?>">
                   <input type="submit" value="Claim"></form><?php
        "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No Donations Have Been Listed.";
}
?>
    <script src="../layout.js"></script>
</body>
</html>
