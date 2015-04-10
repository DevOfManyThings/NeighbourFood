<?php

// Connect to Database Server
$connection = mysqli_connect("devweb2014.cis.strath.ac.uk", "ypb12171", "thouthri", "ypb12171") or die("MySQL Error: " . mysql_error());
  
// Choose Database
mysqli_select_db($connection, "ypb12171") or die("MySQL Error: " . mysql_error());

?>
