<?php
header('Content-Type:Application/json');

$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());

$sql = "SELECT * FROM `owner` WHERE `email` = '$_GET[email]';";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

/*$order = array();
while ($rc = mysqli_fetch_assoc($rs)) {
    $order[] = $rc;
}*/
$rowcount = mysqli_num_rows($rs);
//printf("Result set has %d rows.\n", $rowcount);
//echo $sql;
$result = array();
if ($rowcount > 0)
    $result['check'] = true;
else
    $result['check'] = false;


echo json_encode($result, JSON_PRETTY_PRINT);

mysqli_free_result($rs);
mysqli_close($conn);