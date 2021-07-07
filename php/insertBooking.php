<?php
require_once ("database.php");
$sql = "SELECT store_name FROM `store` WHERE id= 1";
//'" . $_GET['id'] . "'";
$rs = mysqli_query($conn, $sql)
or die(mysqli_error($conn));
while ($rc = mysqli_fetch_assoc($rs)) {
$result[] = $rc;
}
echo json_encode($result, JSON_PRETTY_PRINT);