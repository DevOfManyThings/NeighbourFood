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
</head>

<body>
<?php
// PHP to show what the business thats currently logged in has donated.
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

$sql = "SELECT OrgName
        FROM Client_Details
        WHERE Email = '$email'";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$row = mysqli_fetch_row($result);


echo "<h2 class=\"heading\">$row[0]</h2>"
 . "<!-- Navigation -->"
 . "<form method=\"POST\" action=\"donate.php\">"
 . "<input class=\"button\" type=\"submit\" value=\"Donate\"></form>"
 . "<form method=\"POST\" action=\"logout.php\">"
 . "<input class=\"button\" type=\"submit\" value=\"Logout\"></form>";


$sql = "SELECT a.Item, 
                    a.Quantity, 
                   b.OrgName, 
                   a.Business_Email, 
                   DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
                   DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End,
                   a.Claimed_By,
                   a.ItemID
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Business_Email = '$email'";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    echo "<p>Donations Made By You.<p>"
    . "<table id=\"business\">"
    . "<thead>"
    . "<tr>"
    . "<th>Item</th>"
    . "<th>Available</th>"
    . "<th>Claimed By</th>"
    . "</tr>"
    . "</thead><tbody>";

    // Output data of each row.
    while ($row = $result->fetch_assoc()) {
        $ItemID = $row["ItemID"];
        $Claimed = $row["Claimed_By"];
        echo "<tr>"
        . "<td>" . $row["Item"] . " (" . $row["Quantity"] . ")</td>"
        . "<td>" . $row["Time_Start"] . " - " . $row["Time_End"] . "</td>"
        . "<td>" . $row["Claimed_By"] . "</td>";
        if ($Claimed == "Unclaimed") {
            echo
            "<td>"
            ?><form action="removeDonation.php" method="POST" id="removeDonation">
                <input type="hidden" name="id" value="<?php echo $ItemID; ?>">
                 <button type="button" class="button" onclick="checkConnection('removeDonation')">Delete</button></form><?php
            "</td></tr>";
        }
    }
    echo "</tbody></table>";
} else {
    echo "<p>You Have Made No Donations.<p>";
}
?>
        <script src="../layout.js"></script>
         <script src="../CheckInternetConnection.js"></script>  
</body>
</html>
