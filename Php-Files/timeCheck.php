<?php

include ("connection.php");

//$timezone = date_default_timezone_get();
//echo "The current server timezone is: " . $timezone;

$currentTime = date('H:i', time());

$sql = "SELECT DATE_FORMAT(Time_End, '%H:%i') AS Time_End
               FROM Food_Details";

$result = mysqli_query($connection, $sql) or trigger_error("Query Failed: " . mysql_error());

$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
        $timeEnd = $row["Time_End"];

        if ($currentTime >= $timeEnd) {
            $sql = "DELETE FROM Food_Details
                WHERE Time_End = '$timeEnd'";

            mysqli_query($connection, $sql);
        }
    }
}
?>
