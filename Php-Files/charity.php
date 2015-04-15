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
    <script src="navigate.js"></script>
    <script src="claim.js"></script>
</head>

    <body>
        <form method="POST" action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </body>

    <body>
        <?php      
    $sql = "SELECT a.Item, a.Quantity, b.OrgName, a.Business_Email, a.Time_Start, a.Time_End, a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) 
    {
        echo "Donations"
        . "<table>"
                . "<thead>"
                . "<tr>"
                . "<th>Item Description</th>"
                . "<th>Quantity</th>"
                . "<th>Business Name</th>"
                . "<th>Business Email</th>"
                . "<th>Donation Date</th>"
                . "<th>Donation Available Until</th>"
                . "<th>Claimed By</th>"
                . "</tr>"
                . "</thead><tbody>";
        
    
    // Output data of each row.
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr>"
        . "<td>" . $row["Item"] . "</td>"
        . "<td>" . $row["Quantity"] . "</td>"
        . "<td>" . $row["OrgName"] . "</td>"
        . "<td>" . $row["Business_Email"] . "</td>" 
        . "<td>" . $row["Time_Start"] . "</td>"
        . "<td>" . $row["Time_End"] . "</td>" 
        . "<td>" . $row["Claimed_By"] . "</td>"
                . "</tr>";
    }
    echo "</tbody></table>";
    } 
    else 
    {
        echo "No Donations have been listed.";
    }
?>
        <script src="../layout.js"></script>
    </body>
</html>


