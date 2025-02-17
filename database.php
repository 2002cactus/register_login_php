<?php
    $hostName = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "login_register";
    $conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);
    if (!$conn)
    {
        die("Something went wrong!");
    }
?>
