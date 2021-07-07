<?php

include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Love Pretty Pet Beauty</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.min.css" rel="stylesheet">
    <!-- icon css -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/js/mdb.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            checklogin();
        });
        function login() {
            email = $('#loginEmail').val();
            password = $('#loginPassword').val();
            $.ajax({
                type: 'post',
                url: 'account.php',
                data: {
                    type: "userLogin",
                    email: email,
                    password: password
                },
                datatype: "json",
                success: function(result) {
                    if (result[0] === 'Valid') {
                        alert("login successfully!")
                        location.reload();
                    } else {
                        alert('email or password is incorrect')
                    }
                }
            })
        }
        function checklogin() {
            $.ajax({
                type: 'post',
                url: '../php/account.php',
                data: {
                    type: "loginCheck",
                },
                datatype: "json",
                success: function(result) {
                    if (result[0] == 'Invalid') {
                        $("#dropdown-menu").html('<form class="px-4 py-3">' +
                            '							  <div class="form-group">' +
                            '								  <label for="exampleDropdownFormEmail1">Email address</label>' +
                            '								  <input type="email" class="form-control" id="loginEmail"' +
                            '								         placeholder="email@example.com">' +
                            '							  </div>' +
                            '							  <div class="form-group">' +
                            '								  <label for="Password">Password</label>' +
                            '								  <input type="password" class="form-control" id="loginPassword"' +
                            '								         placeholder="Password">' +
                            '							  </div>' +
                            '							  <div class="form-check">' +
                            '								  <input type="checkbox" class="form-check-input" id="dropdownCheck">' +
                            '								  <label class="form-check-label" for="dropdownCheck">' +
                            '									  Remember me' +
                            '								  </label>' +
                            '							  </div>' +
                            '							  <button type="submit" class="btn btn-primary" onclick="login();">Sign in</button>' +
                            '						  </form>' +
                            '						  <div class="dropdown-divider"></div>' +
                            '						  <a class="dropdown-item" href="signup.php">Sign up</a>' +
                            '						  <a class="dropdown-item" href="#">Forgot password</a>');
                    } else if (result[0] == 'Valid' && result[1] == '1') {
                        $("#dropdown-menu").html(' <a class="dropdown-item" href="userinfo.php">User infomation</a>' +
                            '						  <a class="dropdown-item" href="../php/logout.php">Logout</a>');
                    } else if (result[0] == 'Valid' && result[1] == '2') {
                        $("#dropdown-menu").html(' <a class="dropdown-item" href="userinfo.php">Admin infomation</a>' +
                            '						  <a class="dropdown-item" href="../php/logout.php">Logout</a>');
                    }
                }
            })
        }
    </script>
</head>

<body>
<div class="container">
    <a href="index.php"><img class="img-fluid" src="../images/full_logo.png"></a>
</div>
<nav class="mb-1 navbar navbar-expand-lg navbar-dark blue sticky-top">
    <div class="container">
        <a id="sidebarCollapse" class="navbar-brand" href="#">Pet Care Platform</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="service.php">Shop</a>
                </li>
                <!--
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">Dropdown
                                    </a>
                                    <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </li>
                -->
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdownMenu" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown">

                        <div class="dropdown-menu">
                            <span id="dropdown-menu"></span>
                        </div>
                    </div>
                </li>
            </ul>

            <form class="form-inline my-1" action="search.php" method="post">
                <div class="md-form form-sm my-0">
                    <input class="form-control form-control-sm mr-sm-2 mb-0" type="text" name="search" required>
                </div>
                <input class="btn btn-outline-white btn-sm my-0" type="submit" value="Search">
            </form>
        </div>
    </div>
</nav>

<div class="container d-flex">

    <div class="card col-3" >

        <div class="card-group-item">
            <header class="card-header">
                <h3 class="title"><b>Store Name </b></h3>
            </header>

          <?php

          $query = "SELECT DISTINCT(store_name) FROM store ORDER BY id";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row)
          {
            ?>
              <div class="list-group-item checkbox">
                  <label><input type="checkbox" class="common_selector store_name" value="<?php echo $row['store_name']; ?>"  > <?php echo $row['store_name']; ?></label>
              </div>
            <?php
          }

          ?>

        </div>

        <div class="card-group-item">
            <header class="card-header">
                <h3 class="title"><b>District </b></h3>
            </header>
          <?php

          $query = "SELECT DISTINCT(district) FROM store ORDER BY id";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row)
          {
            ?>
              <div class="list-group-item checkbox">
                  <label><input type="checkbox" class="common_selector district" value="<?php echo $row['district']; ?>" > <?php echo $row['district']; ?></label>
              </div>
            <?php
          }

          ?>
        </div>

        <div class="card-group-item">
            <header class="card-header">
                <h3 class="title"><b>Service </b></h3>
            </header>
          <?php
          $query = "SELECT DISTINCT(service_name) FROM service ORDER BY id";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row)
          {
            ?>
              <div class="list-group-item checkbox">
                  <label><input type="checkbox" class="common_selector service" value="<?php echo $row['service_name']; ?>"  > <?php echo $row['service_name']; ?></label>
              </div>
            <?php
          }
          ?>
        </div>

    </div>

    <div class="card-group-item">
        <header class="card-header">
            <h3 class="title"><b>Species </b></h3>
        </header>
      <?php
      $query = "SELECT DISTINCT(species_name) FROM species ORDER BY id";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      foreach($result as $row)
      {
        ?>
          <div class="list-group-item checkbox">
              <label><input type="checkbox" class="common_selector service" value="<?php echo $row['species_name']; ?>"  > <?php echo $row['species_name']; ?></label>
          </div>
        <?php
      }
      ?>
    </div>

    <div class="container filter_data">
        <!-- filter data result -->
      <?php
      if (isset($_POST['search'])) {
        $keyword = $_POST['search'];
        $sql[0] = "SELECT * FROM `store` WHERE store_name LIKE '$keyword%' OR store_name LIKE '%$keyword' OR store_name LIKE '%$keyword%'";
        //echo $sql[0];
        /*        $sql[1] = "
                          SELECT `service`.service_name, `service`.description, `provides`.fee
                          FROM `provides`, `store`
                          INNER JOIN `service`
                          ON `service`.id = `provides`.service_id
                          WHERE `provides`.store_id = '$keyword'
                          ";
              }*/
        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb") or die(mysqli_connect_error());
        $shop = array();
        for ($i = 0; $i < count($sql); $i++) {

          $rs = mysqli_query($conn, $sql[$i]) or die(mysqli_error($conn));
          if ($rc = mysqli_fetch_assoc($rs)) {
            $shop[] = $rc;
            echo "<br>";

            //echo "<script>"."window.location.replace(shopinfo.php?id=.{$shop[0]['id']});"."</script>";
            echo "<script> location.href='shopinfo.php?id={$shop[0]['id']}'; </script>";

            echo "<br>";
            echo json_encode($shop, JSON_PRETTY_PRINT);
          }
          else {
            echo '<br><h3 style="text-align: center">No Data Found</h3>';
          }
        }
          mysqli_free_result($rs);
          mysqli_close($conn);
        }
      ?>
    </div>

</div>

<div class="view">
    <img src="../images/banner.png" class="img-fluid" alt="">

    <div class="mask flex-center waves-effect waves-light">
        <p class="black-text"><h5><b>© 2019 Copyright</b></h5></p>
    </div>
</div>

</body>

<script>
    $(document).ready(function(){

        filter_data();

        function filter_data()
        {
            $('.filter_data').html('<div id="" style="" ></div>');
            var action = 'fetch_data';
//            var minimum_price = $('#hidden_minimum_price').val();
//            var maximum_price = $('#hidden_maximum_price').val();
            var store = get_filter('store_name');
            console.log(store);
            var district = get_filter('district');
            var service = get_filter('service');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action, store_name:store, district:district, service:service},
                success:function(data){
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name)
        {
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function(){
            filter_data();
        });

        /*
                $('#price_range').slider({
                    range:true,
                    min:1000,
                    max:65000,
                    values:[1000, 65000],
                    step:500,
                    stop:function(event, ui)
                    {
                        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                        $('#hidden_minimum_price').val(ui.values[0]);
                        $('#hidden_maximum_price').val(ui.values[1]);
                        filter_data();
                    }
                });
        */

    });
</script>

</html>
