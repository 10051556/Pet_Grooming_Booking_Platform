<?php

//fetch_data.php

include('connection.php');
//print_r($_POST);
if (isset($_POST["action"])) {
  $query = "SELECT * FROM store WHERE store.id > 0";
  /*  if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
    {
      $query .= "
     AND store_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
    ";
    }*/
  if (isset($_POST["store_name"])) {
    $store_filter = implode("','", $_POST["store_name"]);
    $query .= "
   AND store_name IN('" . $store_filter . "')
  ";
  }
  if (isset($_POST["district"])) {
    $district_filter = implode("','", $_POST["district"]);
    $query .= "
   AND district IN('" . $district_filter . "')
  ";
  }

  $service = "";
  if (isset($_POST["service"])) {
    $service_filter = implode("','", $_POST["service"]);
//    $query .= " AND service_name IN('" . $service_filter . "')";
    $service = $service_filter;
  }

  $species = "";
  if (isset($_POST["species"])) {
    $species_filter = implode("','", $_POST["species"]);
//    $query .= " AND species_name IN('" . $species_filter . "')";
    $species = $species_filter;
  }


  $query .= " ORDER BY store.id DESC";

//  echo $query;

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '';

  if ($total_row > 0) {
    foreach ($result as $row) {
      $output .= '

			<!--Grid row-->
			<hr class="mb-lg-5">
			
			<!--Grid row-->
			<div class="row mt-3 wow fadeIn">
				<!--Grid column-->
				<div class="col-lg-5 col-xl-4 mb-4">
					<!--Featured image-->
					<div class="view overlay rounded">
            <img src="../images/' . $row['imagePath'] . '" alt="" class="img-responsive img-fluid" >
						<a href="shopinfo.php?id=' . $row['id'] . '"
						   target="_self">
							<div class="mask rgba-white-slight"></div>
						</a>
					</div>
				</div>
				<!--Grid column-->

				<!--Grid column-->
				<div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
					<h3 class="mb-3 font-weight-bold dark-grey-text">
						<strong>&nbsp;' . $row['store_name'] . '</strong>
					</h3>

					<ul class="list-group list-unstyled">
						<li>
							<i class="fas fa-map-marker-alt ml-2" style="font-size: x-large"></i>
							&nbsp;' . $row['address'] . '
						</li>
            <br>
            <li>

							<i class="fas fa-paw ml-1" style="font-size: x-large"></i>
                &nbsp;' . getSpecies($row['id'],$species) . '
<!--

							<i class="fas fa-cat "></i>
							<i class="fas fa-dog "></i>
							<i class="fas fa-dove"></i>
							<i class="fas fa-horse"></i>
-->

						</li>
            <br>
            <li>
							<i class="fas fa-store-alt" style="font-size: x-large"></i>
                &nbsp;' . getService($row['id'],$service) . '
            </li>
						<br>
<!--
            <li>
							<i class="fas fa-dollar-sign m" style="font-size: x-large"></i>
							~$200
						</li>
-->
					</ul>
				</div>

				<a href="shopinfo.php?id=' . $row['id'] . '" target="_self"
				   class="btn btn-success btn-md">Show Detial
					<i class="fas fa-play ml-2"></i>
				</a>

				<a href="shopinfo.php?id=' . $row['id'] . '" target="_self"
				   class="btn btn-danger btn-md">Start Booking
					<i class="fas fa-play ml-2"></i>
				</a>

			</div>
			<!--Grid row-->

   

   ';

    }
  } else {
    $output = '<br><h3 style="text-align: center">No Data Found</h3>';
  }
  echo $output;
}

function getService($id,$service){
  $sql = "SELECT service.service_name FROM provides, service, store WHERE provides.store_id = store.id AND provides.service_id = service.id AND store.id = '$id'
";
  if($service != "")
    $sql .= "AND service_name IN('$service')";
  $connect = new PDO("mysql:host=localhost;dbname=projectdb", "root", "");
  $statement = $connect->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = "";
  $i = 1;
  if ($total_row > 0) {
    foreach ($result as $row) {
      $a = ($total_row == $i? " " : ", ");
      $output .= $row['service_name'].$a;
      // echo $output;
      $i++;
    }
  } else {
    $output = 'No Data Found';
  }
  // echo $service;
  return $output;
}

function getSpecies($id,$species){
  $sql = "SELECT species.species_name FROM accepts, species, store WHERE accepts.store_id = store.id AND accepts.species_id = species.id AND store.id = '$id'
";
  if($species != "")
  $sql .= "AND species_name IN('$species')";
  $connect = new PDO("mysql:host=localhost;dbname=projectdb", "root", "");
  $statement = $connect->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = "";
  $i = 1;
  if ($total_row > 0) {
    foreach ($result as $row) {
      $a = ($total_row == $i? " " : ", ");
      $output .= $row['species_name'].$a;
      // echo $output;
      $i++;
    }
  } else {
    $output = 'No Data Found';
  }
  // echo $species;
  return $output;
}

?>
