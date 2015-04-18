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
    
    // PHP to show the donations available.
    $sql = "SELECT a.Item, a.Quantity, b.OrgName, a.Business_Email, a.Time_Start, a.Time_End, a.ItemID, a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Claimed_By = 'Unclaimed'";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);
    
    if ($numRows > 0) 
    {
        echo "<p>Available Donations<p>"
            . "<table id=\"donations\">"
                . "<thead>"
                . "<tr>"
                . "<th>Item Description</th>"
                . "<th>Quantity</th>"
                . "<th>Donated By</th>"
                . "<th>Donator Contact</th>"
                . "<th>Donated At</th>"
                . "<th>Available Until</th>"
                . "<th>Claimed By</th>"
                . "</tr>"
                . "</thead><tbody>";
        
    
    // Output data of each row.
    while ($row = $result->fetch_assoc()) 
    {
        $ItemID = $row["ItemID"];
        echo "<tr>"
        . "<td>" . $row["Item"] . "</td>"
        . "<td>" . $row["Quantity"] . "</td>"
        . "<td>" . $row["OrgName"] . "</td>"
        . "<td>" . $row["Business_Email"] . "</td>" 
        . "<td>" . $row["Time_Start"] . "</td>"
        . "<td>" . $row["Time_End"] . "</td>" 
        . "<td>" . $row["Claimed_By"] . "</td>"
        . "<td>" ?><form action="claim.php" method="POST">
                   <input type="hidden" name="id" value="<?php echo $ItemID; ?>">
                   <input type="submit" value="Claim"></form><?php
         "</tr>";
    }
    echo "</tbody></table>";
    } 
    else 
    {
        echo "No Donations Have Been Listed.";
    }
    
    
    
    
    // PHP to show what the charity thats currently logged in has claimed.
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
    } 
    
    $sql = "SELECT a.Item, a.Quantity, b.OrgName, a.Business_Email, a.Time_Start, a.Time_End, a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Claimed_By = '$email'";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) 
    {
        echo "<p>Donations Claimed By You.<p>"
             . "<table id=\"donations\">"
                . "<thead>"
                . "<tr>"
                . "<th>Item Description</th>"
                . "<th>Quantity</th>"
                . "<th>Donated By</th>"
                . "<th>Donator Contact</th>"
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
            . "<td>" . $row["OrgName"] . "</td>"
            . "<td>" . $row["Business_Email"] . "</td>" 
            . "<td>" . $row["Time_Start"] . "</td>"
            . "<td>" . $row["Time_End"] . "</td>" 
            . "</tr>";
    }
    echo "</tbody></table>";
    } 
    else 
    {
        echo "<p>You Have Claimed No Donations.<p>";
    }
?>
        <script src="../layout.js"></script>
    </body>
</html>
