<?php

include ("connection.php");
include ("checkCharityLogin.php");


echo "<header>"
 . "<h2><!-- We could put currently logged on charity name here --> </h2>"
 . "</header>"
 . "<!-- Navigation -->"
 . "<form method=\"POST\" action=\"charity.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Home\"></form>";


// PHP to show what the charity thats currently logged in has claimed.
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

$sql = "SELECT a.Item, 
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
    . "<th>Donated By</th>"
    . "<th>Contact</th>"
    . "<th>Available</th>"
    . "</tr>"
    . "</thead><tbody>";


    // Output data of each row.
    while ($row = $result->fetch_assoc()) {
        echo "<tr>"
        . "<td>" . $row["Item"]. " (" . $row["Quantity"]. ")</td>"
        . "<td>" . $row["OrgName"] . "</td>"
        . "<td>" . $row["Business_Email"] . "</td>"
        . "<td>" . $row["Time_Start"] . " - " . $row["Time_End"] . "</td>"
        . "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>You Have Claimed No Donations.<p>";
}

?>
