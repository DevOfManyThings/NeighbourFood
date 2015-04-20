<?php

include ("connection.php");
include ("checkBusinessLogin.php");

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
</head>

    <body>  
        <?php     
        
        echo "<header>"
        . "<h2><!-- We could put currently logged on business name here --> </h2>"
        . "</header>"
        ."<!-- Navigate to donate page for business -->"
        . "<button class=\"button\" onclick=\"navTo('donate.php')\">Donate</button>"
        . "<form method=\"POST\" action=\"logout.php\">"
        . "<input class=\"button\" type=\"submit\" value=\"Logout\">"
        . "</form>";

        
    // PHP to show the donations available.
    $sql = "SELECT a.Item, 
                   a.Quantity, 
                   b.OrgName, 
                   a.Business_Email, 
                   DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
                   DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
                   a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) 
    {
        echo "<p>Available Donations</p>"
        . "<table id=\"donations\">"
                . "<thead>"
                . "<tr>"
                . "<th>Item</th>"
                . "<th>Quantity</th>"
                . "<th>Donator</th>"
                . "<th>Donator Contact</th>"
                . "<th>Donated At</th>"
                . "<th>Available Until</th>"
                . "<th>Claimed By</th>"
                . "</tr>"
                . "</thead><tbody>";
    
    // Output data of each row.
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr>"
                . "<td>" . $row["Item"] . "</td> " 
                . "<td>" . $row["Quantity"] . "</td> " 
                . "<td>" . $row["OrgName"] . "</td> " 
                . "<td>" . $row["Business_Email"] . "</td> " 
                . "<td>" . $row["Time_Start"] . "</td> "
                . "<td>" . $row["Time_End"] . "</td> " 
                . "<td>" . $row["Claimed_By"] . "</td> " 
                . "</tr>";
    }
    echo "</tbody></table>";
    } 
    else 
    {
        echo "<p>No Donations Have Been Listed.<p>";
    }
    
    // PHP to show what the business thats currently logged in has donated.
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
    } 
    
    $sql = "SELECT a.Item, 
                   a.Quantity, 
                   b.OrgName, 
                   a.Business_Email, 
                   DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,    
                   DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Business_Email = '$email'";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) 
    {
        echo "<section>"
                . "<p>Donations Made By You.<p>"
                . "<table id=\"business\">"
                . "<thead>"
                . "<tr>"
                . "<th>Item Description</th>"
                . "<th>Quantity</th>"
                . "<th>Donated At</th>"
                . "<th>Available Until</th>"
                . "</tr>"
                . "</thead><tbody>";
        
    // Output data of each row.
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr>"
            . "<td>" . $row["Item"] . "</td>"
            . "<td>" . $row["Quantity"] . "</td>"
            . "<td>" . $row["Time_Start"] . "</td>"
            . "<td>" . $row["Time_End"] . "</td>"
            . "</tr>";
    }
    echo "</tbody></table>";
    } 
    else 
    {
        echo "<p>You Have Made No Donations.<p>";
    }
?>
        <script src="../layout.js"></script>
    </body>
</html>
