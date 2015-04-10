<?php
include ("connection.php");
include ("checkBusinessLogin.php")
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



<div class="navigation">
    <ul class = "Links">

        <li class = "default"><a href = "login.php" class="nav">Home</a></li>

    </ul>

    <body>
        <p>Logout</p>
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </body>



    <body>
        <!-- Navigate to donate page for business -->
        <button onclick="navTo('donate.html')"> Donate Food </button>

        <!-- Table displaying the business' current donations & their status -->
        <table>
            <thead>
                <tr>
                    <th>
                        Name   
                    </th>
                    <th>
                        Quantity  
                    </th>
                    <th>
                        Start Time     
                    </th>
                    <th>
                        End Time     
                    </th>
                    <th>
                        Status     
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- TODO Php: Make new <tr> for each item donated -->
                <tr>
                    <td>
                        Donated Item i: Attribute "Name"  
                    </td>
                    <td>
                        Donated Item i: Attribute "Quantity"
                    </td>
                    <td>
                        Donated Item i: Attribute "Start Time" 
                    </td>
                    <td>
                        Donated Item i: Attribute "End Time"
                    </td>
                    <td>
                        Donated Item i: Attribute "Claimed/Not claimed"
                    </td>
                </tr>

            </tbody>
        </table>

    </body>
</html>