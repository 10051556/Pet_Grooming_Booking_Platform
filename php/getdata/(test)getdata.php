<?php
//echo $_GET['id'];
$id = $_GET['id'];
$sql[0] = "SELECT * FROM `store` WHERE `id` = '$id'";
$sql[1] = "SELECT `service`.service_name, `service`.description, `provides`.fee
FROM `provides`
INNER JOIN `service`
ON `service`.id = `provides`.service_id
where `provides`.store_id = '$id';";

header('Content-Type:Application/json');
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
$shop = array();
for($i=0; $i< count($sql); $i++){

    $rs = mysqli_query($conn, $sql[$i]) or die(mysqli_error($conn));
    while ($rc = mysqli_fetch_assoc($rs)) {
        $shop[] = $rc;
    }
}
echo json_encode($shop, JSON_PRETTY_PRINT);

mysqli_free_result($rs);
mysqli_close($conn);


?>

