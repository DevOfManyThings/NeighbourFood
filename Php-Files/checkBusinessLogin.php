<?php

session_start();

if ((!isset($_SESSION['login']) == "business") || (isset($_SESSION['login']) == ""))
{
    header('Location: https://devweb2014.cis.strath.ac.uk/~ckb12185/CS317/NeighbourFood/login.php');
}

?>

