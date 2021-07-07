<?php
//require_once("../database.php");
//$store_id = $_GET['id'];
//$owner_id = $_SESSION['id'];
//$sql = "  SELECT
//    pet.id AS pet_id,
//    pet.name,
//    pet.species_id,
//    OWNER.id
//FROM
//    pet,
//    OWNER,
//    accepts,
//    store
//WHERE
//    OWNER.id = pet.owner_id AND pet.species_id = accepts.species_id AND store.id = accepts.store_id AND store.id = '$store_id' AND OWNER.id = ' $owner_id '";
//$rs = mysqli_query($conn, $sql)
//or die(mysqli_error($conn));
//while ($rc = mysqli_fetch_assoc($rs)) {
//    $result[] = $rc;
//}
//echo json_encode($result, JSON_PRETTY_PRINT);
//mysqli_free_result($rs);
//mysqli_close($conn);
//?>