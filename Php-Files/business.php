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
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="navigate.js"></script>
</head>

    <body>
        <form method="POST" action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </body>



    <body>
        <!-- Navigate to donate page for business -->
        <button onclick="navTo('donate.php')">Donate</button>
        <script src="layout.js"></script>
    </body>
</html>

<?php     

    // PHP to show the donations.
    $sql = "SELECT a.Item, a.Quantity, b.OrgName, a.Business_Email, a.Time_Start, a.Time_End, a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) 
    {
        echo "<p>Donations</p><table><tr><th>Item Description</th></tr><tr><th>Quantity</th><th><tr><th>Business Name</th><th><tr><th>Business Email</th><th><tr><th>Donation Date</th><th><tr><th>Donation Available Until</th><th><tr><th>Claimed By</th><th>";
    
    // Output data of each row.
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr><td>" . $row["Item"] . " " . $row["Quantity"] . " " . $row["OrgName"] . " " . $row["Business_Email"] . " " . $row["Time_Start"] . " " . $row["Time_End"] . " " . $row["Claimed_By"] .  "</td></tr>";
    }
    echo "</table>";
    } 
    else 
    {
        echo "No Donations Have Been listed.";
    }
    
     
    // PHP to show what the business thats currently logged in has donated.
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
    } 
    $sql = "SELECT a.Item, a.Quantity, b.OrgName, a.Business_Email, a.Time_Start, a.Time_End
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.Business_Email = '$email'";

    $result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) 
    {
        echo "<br><br>Donations Made By You.</br></br><table><tr><th>Item Description</th></tr><tr><th>Quantity</th><th><tr><th>Business Name</th><th><tr><th>Business Email</th><th><tr><th>Donation Date</th><th><tr><th>Donation Available Until</th><th>";
    
    // Output data of each row.
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr><td>" . $row["Item"] . " " . $row["Quantity"] . " " . $row["OrgName"] . " " . $row["Business_Email"] . " " . $row["Time_Start"] . " " . $row["Time_End"] . "</td></tr>";
    }
    echo "</table>";
    } 
    else 
    {
        echo "You Have Made No Donations.";
    }
?>
