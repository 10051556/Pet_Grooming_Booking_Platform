<?php
header('Content-Type:Application/json');

require_once('database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = [];
    switch ($_GET['type']) {
        case "adminLogin":
            if (isset($_GET['admin_email']) && isset($_GET['admin_password'])) {
                $adminEmail = $_GET['admin_email'];
                $adminPassword = $_GET['admin_password'];

                $sql = "SELECT * FROM administrator WHERE email='$adminEmail' AND password='$adminPassword'";

                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));

                if (mysqli_num_rows($rs) == 1) {
                    $rc = mysqli_fetch_assoc($rs);
                    $result[] = "Valid";
                    $result[] = $rc;

                    $_SESSION['AdminEmail'] = $adminEmail;
                } else {
                    $result[] = "Invalid";
                }
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
        case "dealerLogin":
            if (isset($_GET['dealer_id']) && isset($_GET['dealer_password'])) {
                $dealerID = $_GET['dealer_id'];
                $dealerPassword = $_GET['dealer_password'];

                $sql = "SELECT * FROM dealer WHERE dealerID='$dealerID' AND password='$dealerPassword'";

                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));

                if (mysqli_num_rows($rs) == 1) {
                    $rc = mysqli_fetch_assoc($rs);
                    $result[] = "Valid";
                    $result[] = $rc;

                    $_SESSION['DealerID'] = $dealerID;
                } else {
                    $result[] = "Invalid";
                }
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
        case "getUserInfo":
            if (isset($_SESSION['id'])) {
                $sql = "SELECT first_name,last_name,mobile,email FROM owner WHERE id='" . $_SESSION['id'] . "'";
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                $rc = mysqli_fetch_assoc($rs);
                $result[] = "Valid";
                $result[] = $rc;
                echo json_encode($result, JSON_PRETTY_PRINT);
            }
            break;
        case "getPetInfo":
            if (isset($_SESSION['id'])) {
                $sql = "SELECT pet.owner_id, pet.name, species.species_name, pet.birth_date,pet.id FROM pet, species WHERE pet.species_id = species.id AND pet.owner_id='" . $_SESSION['id'] . "'";
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                while ($rc = mysqli_fetch_assoc($rs)) {
                    $result[] = $rc;
                }
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
        case "getPetSpe":
            $sql = "SELECT * FROM species";
            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));
            while ($rc = mysqli_fetch_assoc($rs)) {
                $result[] = $rc;
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;


        case "getPetName":
            if (isset($_SESSION['id'])) {
                $id= $_GET['id'];
                $sql = "SELECT
    pet.id AS pet_id,
    pet.name,
    pet.species_id,
    owner.id
FROM
    pet,
    owner,
    accepts,
    store
WHERE 
    owner.id = pet.owner_id AND pet.species_id = accepts.species_id AND store.id = accepts.store_id AND owner.id = '" . $_SESSION['id'] . "'AND store.id = '$id'";;
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                while ($rc = mysqli_fetch_assoc($rs)) {
                    $result[] = $rc;
                }
                echo json_encode($result, JSON_PRETTY_PRINT);
                break;
            }

        case "getMPetInfo":
            if (isset($_SESSION['id'])) {
                $id = $_GET['petid'];
                $sql = "SELECT pet . owner_id, pet . name, species . species_name, pet . birth_date,pet . id FROM pet, species WHERE pet . species_id = species . id AND pet . owner_id = '" . $_SESSION['id'] . "' and pet . id = '$id'";
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                while ($rc = mysqli_fetch_assoc($rs)) {
                    $result[] = $rc;
                }
                echo json_encode($result, JSON_PRETTY_PRINT);
                break;
            }
        case "getBooking":
            if (isset($_SESSION['id'])) {
                $sql = "SELECT
    store.id AS store_id,
    store.store_name,
    booking.date,
    booking.start_hour,
    pet.id AS pet_id,
    pet.name AS pet_name,
    pet.species_id,
    booking.total_amount,
    booking.id AS booking_id,
    booking.remarks,
    store.duration,
    store.open_hour,
    store.close_hour,
    store.sat_open_hour,
    store.sat_close_hour,
    store.sun_open_hour,
    store.sun_close_hour,
    owner.id AS owner_id,
    status.status_name,
    booking.selected_services
FROM
    booking,
    OWNER,
    pet,
    store,
    status,
    accepts
WHERE
    booking.owner_id = OWNER.id AND
    booking.pet_id = pet.id AND
    pet.species_id = accepts.species_id AND
    store.id = accepts.store_id AND
    booking.store_id = store.id AND
    booking.status_id = STATUS.id AND
    booking.owner_id ='" . $_SESSION['id'] . "'";
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                while ($rc = mysqli_fetch_assoc($rs)) {
                    $result[] = $rc;
                }
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case "getBookingService":
            if (isset($_SESSION['id'])) {
                $sql = "SELECT service . service_name FROM booking, service, selected, OWNER WHERE booking . id = selected . booking_id AND service . id = selected . service_id AND booking . owner_id = OWNER . id = '" . $_SESSION['id'] . "' AND booking . id = '" . $_GET['booking'];

                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                while ($rc = mysqli_fetch_assoc($rs)) {
                    $result[] = $rc;
                }
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = [];
    switch ($_POST['type']) {
        case "registration":
            $dealerEmail = $_POST['dealer_email'];
            $dealerPassword = $_POST['dealer_password'];
            $dealerFName = $_POST['dealer_fname'];
            $dealerPhone = $_POST['dealer_phone'];
            $dealerLName = $_POST['dealer_lname'];

            $sql = "SELECT * FROM owner WHERE Email='$dealerEmail';";

            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));

            if (mysqli_num_rows($rs) == 1) {
                $result[] = "Invalid";
                $result[] = "Email has been already exists";
            } else {
                $sql = "INSERT INTO owner (Email, password, first_name, mobile, last_name) VALUES ('$dealerEmail','$dealerPassword','$dealerFName','$dealerPhone','$dealerLName');";
                mysqli_query($conn, $sql);
                $result[] = "Valid";
            }

            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case "updateUserInfo":
            $dealerID = $_SESSION['id'];
            $fName = $_POST['fname'];
            $lName = $_POST['lname'];
            $Phone = $_POST['phone'];
            $email = $_POST['email'];
//          $dealerOldPassword = $_POST['dealer_old_password'];
//          if (isset($_POST['dealer_new_password'])) {
//            $dealerNewPassword = $_POST['dealer_new_password'];
//          } else {
//            $dealerNewPassword = $dealerOldPassword;
//          }
//
//          $sql = "SELECT * FROM dealer WHERE dealerID='$dealerID' AND password='$dealerOldPassword'";
//
//          $rs = mysqli_query($conn, $sql)
//          or die(mysqli_error($conn));
//
//          if (mysqli_num_rows($rs) == 1) {
            $sql = "UPDATE owner SET first_name = '$fName', last_name = '$lName', email = '$email', mobile = '$Phone' WHERE id = '$dealerID';";
            mysqli_query($conn, $sql);
            $rs = mysqli_query($conn, $sql);
            $result[] = "Valid";
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case 'userLogin':
            $Email = $_POST['email'];
            $Password = $_POST['password'];

            $sql = "SELECT * FROM owner WHERE email='" . $Email . "' AND password='" . $Password . "'";

            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));

            if (mysqli_num_rows($rs) == 1) {
                $rc = mysqli_fetch_assoc($rs);
                $result[] = "Valid";
                $result[] = $rc['first_name'];
                $_SESSION['id'] = $rc['id'];
            } else {
                $result[] = "Invalid";
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case 'loginCheck':
            if (isset($_SESSION['id'])) {
                $result[] = "Valid";
                $sql = "SELECT right_id FROM owner WHERE id='" . $_SESSION['id'] . "'";
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
                $rc = mysqli_fetch_assoc($rs);
                $result[] = $rc['right_id'];
            } else {
                $result[] = "Invalid";
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case 'addpet':
            if (isset($_SESSION['id'])) {
                $ownerID = $_SESSION['id'];
                $pName = $_POST['petname'];
                $birth = $_POST['birth'];
                $spe = $_POST['spe'];
                $sql = "INSERT INTO pet (name, species_id, birth_date, owner_id) VALUES ('$pName','$spe','$birth','$ownerID');";
                $rs = mysqli_query($conn, $sql);
                $result[] = "Valid";
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case 'addBooking':
           // if (isset($_SESSION['id'])) {
                $sid = $_POST['store_id'];
                $sh = $_POST['start_hour'];
                $d = $_POST['date'];
                $r = $_POST['remarks'];
                $oid = $_POST['owner_id'];
                $pid = $_POST['pet_id'];
                $ta = $_POST['total_amount'];
                $ss = $_POST['selected_services'];
                $st = $_POST['status_id'];
                $sql = "INSERT INTO booking(
    store_id,
    start_hour,
    date,
    remarks,
    id,
    owner_id,
    pet_id,
    status_id,
    total_amount,
    selected_services
)
VALUES(
    '$sid',
    '$sh',
    '$d',
    '$r',
    NULL,
    '$oid',
    '$pid',
    '$st',
    '$ta',
    '$ss'
)";
                $rs = mysqli_query($conn, $sql);
                $result[] = "Valid";
            //}
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case 'delpet':
            if (isset($_SESSION['id'])) {
                $ownerID = $_SESSION['id'];
                $petid = $_POST['petid'];
                foreach ($petid as $k => $v) {
                    $sql = "DELETE FROM pet where id='$v' and owner_id = '$ownerID';";
                    $rs = mysqli_query($conn, $sql);
                }
                $result[] = "Valid";
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;

        case 'modpet':
          if (isset($_SESSION['id'])){
            $ownerID = $_SESSION['id'];
            $petid = $_POST['petid'];
            $petname=$_POST['petname'];
            $spe = $_POST['spe'];
            $birth=$_POST['birth'];
          if ($birth>date("Y-m-d")){
            $result[] = "InValid";
            $result[] = "You can't input birth after today!";
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
          }
            $sql = "UPDATE pet SET name ='$petname', species_id = '$spe', birth_date = '$birth' where owner_id ='$ownerID' and id = $petid;";
            mysqli_query($conn, $sql);
            $rs = mysqli_query($conn, $sql);
            $result[] = "Valid";

          }
          echo json_encode($result, JSON_PRETTY_PRINT);
          break;
        case 'changepass':
            if (isset($_SESSION['id'])) {
                $cupass = $_POST['cupass'];
                $cpass = $_POST['cpass'];
                $npass = $_POST['npass'];
                $id = $_SESSION['id'];

                if ($cpass != $npass) {
                    $result[] = "InValid";
                    $result[] = "Password not match!";
                    echo json_encode($result, JSON_PRETTY_PRINT);
                    break;
                }
                $sql = "select password from owner where id='$id' and password ='$cupass'";
                $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));

                if (mysqli_num_rows($rs) == 1) {
                    $sql2 = "UPDATE owner set password='$npass' where id='$id'";
                    $rs = mysqli_query($conn, $sql2)
                    or die(mysqli_error($conn));
                    $result[] = "Valid";
                    echo json_encode($result, JSON_PRETTY_PRINT);
                } else {
                    $result[] = "InValid";
                    $result[] = "Current Password Error!";
                    echo json_encode($result, JSON_PRETTY_PRINT);
                    break;
                }
            }
    }
}
?>