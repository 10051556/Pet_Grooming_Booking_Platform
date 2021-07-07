<?php
header('Content-Type:Application/json');

$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
$password =  $_POST['password'];
$email =  $_POST['email'];
$sql = "UPDATE `owner` SET `password`= '$password' WHERE `email`= '$email'";
echo $sql;
mysqli_query($conn, $sql) or die(mysqli_error($conn));


mysqli_close($conn);

?>