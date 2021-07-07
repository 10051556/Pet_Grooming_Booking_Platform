<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "projectdb";
    $port = "3306";
    $conn = mysqli_connect($hostname, $username, $password, $db, $port)
    or die(mysqli_connect_error());
?>
