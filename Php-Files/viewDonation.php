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

echo "<!-- Navigation -->"
 . "<form method=\"POST\" action=\"charity.php\"></button>"
 . "<input class=\"button\" type=\"submit\" value=\"Home\"></form>";

$ItemID = $_POST['id'];

// Attempt to get single item ItemId and the details of the business that donated it
$sql = "SELECT a.Item, 
               a.Quantity, 
               DATE_FORMAT(a.Time_Start, '%H:%i') AS Time_Start,
               DATE_FORMAT(a.Time_End, '%H:%i') AS Time_End, 
               b.OrgName, 
               b.Email, 
               b.Number, 
               b.Street, 
               b.Postcode, 
               a.Claimed_By
            FROM Food_Details a
            INNER JOIN Client_Details b ON a.Business_Email = b.Email
            WHERE a.ItemId = '$ItemID'";
            
$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    //Print result
      while ($row = $result->fetch_assoc()) {
          echo "<h2 id=\"mainHeading\">Donation Information</h2>"
          . "<section><h2 id=\"heading\">Item Information</h2>"
          . "<table class=\"frame\">"
          . "<tr><td><p>Item Description:</p> </td><td><p>" . $row["Item"] . "</p></td></tr>"
          . "<tr><td><p>Quantity:</p> </td><td><p>" . $row["Quantity"] . "</p></td></tr>"
          . "<tr><td><p>Time Available:</p> </td><td><p>" . $row["Time_Start"] . " - " . $row["Time_End"] . "</p></td></tr>"
          . "</table></section>"
          . "<section><h2 id=\"heading\">Donator Information</h2>"
          . "<table class=\"frame\">"
          . "<tr><td><p>Name:</p> </td><td><p>" . $row["OrgName"] . "</p></td></tr>"
          . "<tr><td><p>Email:</p> </td><td><p>" . $row["Email"] . "</p></td></tr>"
          . "<tr><td><p>Address:</p> </td><td><p>" . $row["Number"] . " " . $row["Street"] . "</p></td></tr>"
          . "<tr><td><p>Post Code:</p> </td><td><p>" . $row["Postcode"] . "</p></td></tr>"
          . "</table></section>"
                  . "<section>";
          $status = $row["Claimed_By"];
          if($status == "Unclaimed"){
              echo "<form action=\"claim.php\" method=\"POST\">
                   <input type=\"hidden\" name=\"id\" value=\"$ItemID\">
                   <input type=\"submit\" value=\"Claim This\"></form>";
          }else{
                   echo "<form action=\"unclaim.php\" method=\"POST\">
                   <input type=\"hidden\" name=\"id\" value=\"$ItemID\">
                   <input type=\"submit\" value=\"Cancel Claim\"></form>";
          }
           
                   echo "</section>";
      }
} 
else 
{
    echo "<p>Error: This donation has been removed<p>";
}

?>
        <script src="../layout.js"></script>
        
</body>
</html>


