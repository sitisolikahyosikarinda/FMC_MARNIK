<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("location: login.php");
    exit;
}
?>