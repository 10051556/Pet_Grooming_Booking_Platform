<?php

include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Love Pretty Pet Beauty</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


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
                            '						  <a class="dropdown-item" href="forgetpwd.php">Forgot password</a>');
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
<style>
    body {
        /*background-image: url("../images/bg-pattern.png");*/
    }
</style>
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

<div class="container d-flex view overlay rounded" style="z-index: 1;">

    <!-- Sidebar  -->

    <nav id="sidebar">
<!--
        <div class="sidebar-header">
            <h3>Bootstrap Sidebar</h3>
        </div>
-->
<!--
            <div class="card-group-item">
                <header class="card-header">
                    <h3 class="title"><b>Store Name </b></h3>
                </header>

              --><?php
/*
              $query = "SELECT DISTINCT(store_name) FROM store ORDER BY id";
              $statement = $connect->prepare($query);
              $statement->execute();
              $result = $statement->fetchAll();
              foreach($result as $row)
              {
                */?>

                  <!--
                    <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="common_selector store_name" value="<?php /*echo $row['store_name']; */?>"  > <?php /*echo $row['store_name']; */?></label>
                    </div>
-->
<!--
                  <div class="list-group-item checkbox">
                      <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input store_name" id="customCheck<?php /*echo $row['store_name']; */?>" value="<?php /*echo $row['store_name']; */?>"> <label class="custom-control-label" for="customCheck<?php /*echo $row['store_name']; */?>"><?php /*echo $row['store_name']; */?></label>
                      </div>
                  </div>

                <?php
/*              }
              */?>

            </div>
-->
        <div class="card-group-item">
            <header class="card-header">
                <h3><i class="fas fa-map-marker-alt ml-2" style="font-size: x-large"></i><b> District </b></h3>

            </header>
          <?php

          $query = "SELECT DISTINCT(district) FROM store ORDER BY id";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row)
          {
            ?>

<!--
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector district" value="<?php /*echo $row['district']; */?>" > <?php /*echo $row['district']; */?></label>
            </div>
-->

              <div class="list-group-item checkbox">
                  <div class="custom-control custom-checkbox mb-3">
                      <input type="checkbox" class="custom-control-input district" id="customCheck<?php echo $row['district']; ?>" value="<?php echo $row['district']; ?>"> <label class="custom-control-label" for="customCheck<?php echo $row['district']; ?>"><?php echo $row['district']; ?></label>
                  </div>
              </div>

            <?php
          }
          ?>

        </div>

        <div class="card-group-item">
            <header class="card-header">
                <h3><i class="fas fa-store-alt" style="font-size: x-large"></i><b> Service </b></h3>

            </header>
          <?php
          $query = "SELECT DISTINCT(service_name) FROM service ORDER BY id";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row)
          {
            ?>

<!--
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector service" value="<?php /*echo $row['service_name']; */?>"  > <?php /*echo $row['service_name']; */?></label>
            </div>
-->

              <div class="list-group-item checkbox">
                  <div class="custom-control custom-checkbox mb-3">
                      <input type="checkbox" class="custom-control-input service" id="customCheck<?php echo $row['service_name']; ?>" value="<?php echo $row['service_name']; ?>"> <label class="custom-control-label" for="customCheck<?php echo $row['service_name']; ?>"><?php echo $row['service_name']; ?></label>
                  </div>
              </div>

            <?php
          }
          ?>

        </div>

        <div class="card-group-item">
            <header class="card-header">
                <h3><i class="fas fa-paw ml-1" style="font-size: x-large"></i><b> Species </b></h3>

            </header>
          <?php
          $query = "SELECT DISTINCT(species_name) FROM species ORDER BY id";
          $statement = $connect->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $row)
          {
            ?>

              <!--
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector species" value="<?php /*echo $row['species_name']; */?>"  > <?php /*echo $row['species_name']; */?></label>
            </div>
-->

              <div class="list-group-item checkbox">
                  <div class="custom-control custom-checkbox mb-3">
                      <input type="checkbox" class="custom-control-input species" id="customCheck<?php echo $row['species_name']; ?>" value="<?php echo $row['species_name']; ?>"> <label class="custom-control-label" for="customCheck<?php echo $row['species_name']; ?>"><?php echo $row['species_name']; ?></label>
                  </div>
              </div>

            <?php
          }
          ?>

        </div>

    </nav>
    <div class="container filter_data">
    <!-- filter data result -->
    </div>

</div>

<br>

<div class="view">
    <img src="../images/banner.png" class="img-fluid" alt="">

    <div class="mask flex-center waves-effect waves-light">
        <p class="black-text"><h5><b>© 2019 Copyright</b></h5></p>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $open = 1;
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

<!--
<script type="text/javascript">
    $open = 1;
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            console.log($open);
            if($open == 1){
             //   $('#sidebar').toggle();
                $('#sidebar').toggleClass('active');
                $open = 0;
            }
            else{
               // $('#sidebar').toggle();
                $('#sidebar').toggleClass('active');
                $open = 1;
            }

           // $('#sidebar').toggleClass('active');
        });
    });
-->

</body>

<script>
    $(document).ready(function()
    {

        filter_data();

        function filter_data()
        {
            $('.filter_data').html('<div id="" style="" ></div>');
            var action = 'fetch_data';
//            var minimum_price = $('#hidden_minimum_price').val();
//            var maximum_price = $('#hidden_maximum_price').val();
            var store = get_filter('store_name');
//            console.log(store);
            var district = get_filter('district');
            var species = get_filter('species');
            var service = get_filter('service');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action, store_name:store, district:district, species:species, service:service},
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

        $('.custom-control-input').click(function(){
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
