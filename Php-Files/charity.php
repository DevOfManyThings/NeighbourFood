<?php

    include ("connection.php");
    include ("checkCharityLogin.php");
    include ("timeCheck.php");
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
    <script src="navigate.js"></script>
    <script src="claim.js"></script>
</head>
<body>
<?php



if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

$sql = "SELECT OrgName, Longitude, Latitude
        FROM Client_Details
        WHERE Email = '$email'";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$rowDist = $result->fetch_assoc();
$longitude = $rowDist["Longitude"];
$latitude = $rowDist["Latitude"];

$row = mysqli_fetch_row($result);

echo"<h2 id=\"heading\">$row[0]</h2>"
 . "<!-- Navigation -->"
 . "<form method=\"POST\" action=\"myClaims.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"My Claims\"></form>"
 . "<form method=\"POST\" action=\"logout.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Logout\"></form>";



// PHP to show the donations available.
$sql = "SELECT a.Item, a.Quantity,
               DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
               DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
               a.ItemID, a.Business_Email, b.Latitude, b.Longitude
               FROM Food_Details a
               INNER JOIN Client_Details b
               WHERE a.Claimed_By = 'Unclaimed' AND a.Business_Email = b.Email
               ORDER BY a.Business_Email";



$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);
//echo "London long and lat" . $longitude . "   " . $latitude;
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
//    echo "London long and lat" . $longitude . "   " . $latitude;
    while ($row = $result->fetch_assoc()) {
        $ItemID = $row["ItemID"];
        echo "<tr>"
        . "<td>" . $row["Item"]. " (" . $row["Quantity"]. ")</td>"
        . "<td>" . $row["Time_Start"] ." - " . $row["Time_End"] . "</td>"
        . "<td>" . \calculateDistance($longitude, $latitude, $row["Longitude"], $row["Latitude"]) . "</td>"
        . "<td>" ?><form action="viewDonation.php" method="POST" id="viewDonation">
                   <input type="hidden" name="id" value="<?php echo $ItemID; ?>">
                    <button type="button" class="button" onclick="checkConnection('viewDonation')">More Details</button>
                  </form><?php
        "</tr>";
    }
    echo "</tbody></table>";
     
     
} else {
    echo "No Donations Have Been Listed.";
}
      
     
?>
    <script src="../layout.js"></script>
     <script src="../CheckInternetConnection.js"></script> 
</body>
</html>
