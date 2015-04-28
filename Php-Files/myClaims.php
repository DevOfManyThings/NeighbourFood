<?php

include ("connection.php");
include ("checkCharityLogin.php");
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


$sql = "SELECT a.Item, 
               a.ItemID,
               a.Quantity, 
               b.OrgName, 
               a.Business_Email, 
               DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
               DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
               a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Claimed_By = '$email'";

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
        . "<td>" . "<!-- TODO distance from charity base to donator business base -->" . "</td>"
        . "<td>" ?><form id="<?php echo $ItemID; ?>" action="viewDonation.php" method="POST"> 
        <input type="hidden" name="id"  value="<?php echo $ItemID; ?>"/>
        <button type="button" class="button" onclick="checkConnection(<?php echo $ItemID; ?>)">More Details</button>
        </form></tr><?php
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
