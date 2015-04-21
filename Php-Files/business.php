<?php

    include ("connection.php");
    include ("checkBusinessLogin.php");
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
    <script src="../navigate.js"></script>
</head>


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
 . "<form method=\"POST\" action=\"donate.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Donate\"></form>"
 . "<form method=\"POST\" action=\"logout.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Logout\"></form>"
 . "<form method=\"POST\" action=\"myDonations.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"My Donations\"></form>";





// PHP to show the donations available.
$sql = "SELECT a.Item, 
               a.Quantity, 
               b.OrgName, 
               a.Business_Email, 
               DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
               DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
               a.Claimed_By
        FROM Food_Details a
        INNER JOIN Client_Details b ON a.Business_Email = b.Email
        WHERE a.Claimed_By = 'Unclaimed'";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    echo "<p>Available Donations</p>"
    . "<table id=\"donations\">"
    . "<thead>"
    . "<tr>"
    . "<th>Item</th>"
    . "<th>Donated By</th>"
    . "<th>Contact</th>"
    . "<th>Available</th>"
    . "<th>Claimed By</th>"
    . "</tr>"
    . "</thead><tbody>";

    // Output data of each row.
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"
        . "<td>" . $row["Item"]. " (" . $row["Quantity"]. ")</td>"
        . "<td>" . $row["OrgName"] . "</td> "
        . "<td>" . $row["Business_Email"] . "</td> "
        . "<td>" . $row["Time_Start"] . " - " . $row["Time_End"] . "</td>"
        . "<td>" . $row["Claimed_By"] . "</td> "
        . "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No Donations Have Been Listed.<p>";
}

?>

    <script src="../layout.js"></script>
</body>
</html>
