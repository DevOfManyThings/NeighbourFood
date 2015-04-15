<?php

session_start();

if ((!isset($_SESSION['login']) == "charity") || (isset($_SESSION['login']) == ""))
{
    header('Location: login.php');
}

?>
