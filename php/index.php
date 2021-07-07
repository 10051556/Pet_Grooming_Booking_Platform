<?php

require_once('database.php');
session_start();

?>

<?php

include('connection.php');
if ((isset($_SESSION['id']))) {
//    echo "id stored";

}
else
//    echo "no id stored"

?>

<!DOCTYPE html>
<html lang="en">

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
        $(document).ready(function () {
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
                success: function (result) {
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
                success: function (result) {
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
    <style>
        /*        .footer {
                    background-image: url('../images/banner.jpg');
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: bottom;
                    !*background-size: cover;*!
                }*/
        body {
            /*background-image: url("../images/bg-pattern.png");*/
        }
    </style>
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

<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>

<br>
<!--/.Carousel Wrapper-->

<div class="container">

    <h2><b>Most Popular Shop</b></h2>
    <br>

    <div class="card-columns">

        <?php

        $query = "SELECT * FROM store;";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
        $output = '';

        if ($total_row > 0) {
            foreach ($result as $row) {
                $output .= '
    <div class="card">
        <div class="card-body border-dark">
            <h5 style="text-align: center;"><b>' . $row['store_name'] . '</b></h5>
            <div class="view overlay zoom">
                <a href="shopinfo.php?id=' . $row['id'] . '"><img class="card-img-bottom img-fluid" src="../images/' . $row['imagePath'] . '"
                                                 alt=' . $row['imagePath'] . '></a>
            </div>
        </div>
    </div>
    ';
            }
            echo $output;
        }

        ?>

    </div>

    <!--
        <div class="card-deck">

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Mega Pet</b></p></h5>
                <div class="view overlay zoom">
                    <a href="shopinfo.php?id=1"><img class="card-img-bottom img-fluid" src="../images/Mega Pet.jpg"
                                                     alt="Mega Pet"></a>
                </div>
            </div>

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Kennel Van Dego</b></p></h5>
                <div class="view overlay zoom">
                    <a href="shopinfo.php?id=2"><img class="card-img-bottom" src="../images/Kennel Van Dego.jpg"
                                                     alt="Kennel Van Dego"></a>
                </div>
            </div>

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>SPCA Hong Kong</b></p></h5>
                <div class="view overlay zoom">
                    <a href="shopinfo.php?id=3"><img class="card-img-bottom" src="../images/SPCA.jpg" alt="SPCA Hong Kong"></a>
                </div>
            </div>


        </div>
        <br>

        <div class="card-deck">

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Pet Oasis</b></p></h5>
                <div class="view overlay zoom">
                    <a href="shopinfo.php?id=4"><img class="card-img-bottom" src="../images/Pet Oasis.jpg" alt="Pet Oasis"></a>
                </div>
            </div>

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Pets World Resort</b></p></h5>
                <div class="view overlay zoom">
                    <a href="shopinfo.php?id=5"><img class="card-img-bottom" src="../images/Pets World Resort.jpg"
                                                     alt="Pets World Resort"></a>
                </div>
            </div>

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>TOKYO DOG Grooming Salon</b></p></h5>
                <div class="view overlay zoom">
                    <a href="shopinfo.php?id=6"><img class="card-img-bottom  img-fluid"
                                                     src="../images/bDOG TOKYO DOG Grooming Salon.jpg"
                                                     alt="TOKYO DOG Grooming Salon"></a>
                </div>
            </div>

        </div>
    -->

    <br><br>
    <h2><b>Most Popular Service</b></h2>
    <br>

    <!--
        <h2><b>Most Popular Service</b></h2>
        <br>
        <div class="card-deck">
            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Bath</b></p></h5>
                <div class="view overlay zoom">
                    <img class="card-img-bottom" src="../images/Bath.jpg" alt="Bath">
                </div>
            </div>

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Dental</b></p></h5>
                <div class="view overlay zoom">
                    <img class="card-img-bottom" src="../images/Dental.jpg" alt="Dental">
                </div>
            </div>

            <div class="card border-dark">
                <h5><p class="card-text" style="text-align: center"><b>Hair Cutting</b></p></h5>
                <div class="view overlay zoom">
                    <img class="card-img-bottom" src="../images/Hair Cutting.jpg" alt="Hair Cutting">
                </div>
            </div>
        </div>
    -->

    <div class="card-columns">

        <?php

        $query = "SELECT * FROM service;";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
        $output = '';

        if ($total_row > 0) {
            foreach ($result as $row) {
                $output .= '
    <div class="card">
        <div class="card-body border-dark">
            <h5 style="text-align: center;"><b>' . $row['service_name'] . '</b></h5>
            <div class="view overlay zoom">
                <img class="card-img-bottom img-fluid" src="../images/' . $row['imagePath'] . '"
                                                 alt=' . $row['imagePath'] . '>
            </div>
        </div>
    </div>
    ';
            }
            echo $output;
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

</html>
