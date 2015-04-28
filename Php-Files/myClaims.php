<?php

include ("connection.php");
include ("checkCharityLogin.php");
include ("calculateDistance.php");

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

<body>
<?php

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

echo"<!-- Navigation -->"
 . "<form method=\"POST\" action=\"charity.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Home\"></form>";


$sqlCharity = "SELECT b.Longitude,
                       b.Latitude
               FROM Client_Details b
               WHERE b.Email = '$email'";

$resultChar = mysqli_query($connection, $sqlCharity) or trigger_error("Query Failed: " . mysql_error());

$rowChar = $resultChar->fetch_assoc();
$charLongitude = $rowChar["Longitude"];
$charLatitude = $rowChar["Latitude"];

$sql = "SELECT a.Item, 
               a.ItemID,
               a.Quantity, 
               b.OrgName, 
               a.Business_Email, 
               DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
               DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
               a.Claimed_By, b.Latitude, b.Longitude
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Claimed_By = '$email' AND a.Business_Email = b.Email";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    echo "<p>Donations Claimed By You.<p>"
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
        . "<td>" . \calculateDistance($charLongitude, $charLatitude, $row["Longitude"], $row["Latitude"]) . "</td>"
        . "<td>" ?><form action="viewDonation.php" method="POST" id="viewDonation">
                   <input type="hidden" name="id" value="<?php echo $ItemID; ?>">
                   <button type="button" class="button" onclick="checkConnection('viewDonation')">More Details</button>
         </form><?php
        "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>You Have Claimed No Donations.<p>";
}

?>
        <script src="../layout.js"></script>
        <script src="../CheckInternetConnection.js"></script>  
</body>
</html>
