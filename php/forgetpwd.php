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

        <!--/.Carousel Wrapper-->
        var code = Math.floor((Math.random() * 1000000) + 1);
        let check = true;

        function showAlertText(type, strong, message) {
            $("#content").prepend("        <div class=\"alert alert-" + type + " alert-dismissible fade show mt-3\">\n" +
                "            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n" +
                "            <strong>" + strong + "</strong> " + message + " \n" +
                "        </div>");
        }


        function checkEmail(email) {
            $.ajax({
                type: 'GET',
                url: 'checkEmail.php',
                data: {email: email},
                /*url: 'getdata/getshopdata.php',*/
                dataType: 'json',
                success: function (result) {
                    //  console.log(result['check']);
                    if (result['check']) {
                        sendCode(email);
                        showAlertText("success","Success!!!","The user email is sent!!!");
                    } else {
                        showAlertText("danger","Warning!!!","The user email isn't existed!!!");
                    }
                },
                error: function () {
                    console.log("no good");
                }
            });
        }

        function checkVerification() {
            var email = $('#email').val();
            if (email == "")
               // alert("Please enter email!!");
               showAlertText("warning","Warning!!!","Please enter email!!");
            else
                checkEmail(email);
        }


        function sendCode(email) {
            $.ajax({
                type: 'post',
                url: '../PHPMailer-master/test1.php',
                data: {
                    email: email,
                    code: code
                },
                datatype: "json",
                success: function (result) {
                    //  console.log("ok");
                }
            });
        }

        function checkCode() {
            if (code == $('#ver').val()) {
            //    alert("correct");
                showAlertText("success","Success!!!","The code is correct.");
                window.location.replace("changepwd.php?email=" + $('#email').val());
            } else {
              //  alert("no correct");
                showAlertText("danger","Danger!!","The code is no correct.");
            }
        }

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

<div class="container">
    <div id="content">
        <!--        <div class="alert alert-success alert-dismissible fade show mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> This alert box could indicate a successful or positive action.
                </div>-->
        <br>
        <h2 class="text-info font-weight-bold">Forget Password:</h2>
        <br>
        <form role="form">
            <div class="form-group">
                <label for="email" class="text-primary" style="font-size: 20px;">Please enter user email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <button type="button" class="btn btn-primary ml-0" onclick="checkVerification();">Send Verification Code
            </button>
            <br>
            <br>
            <div class="form-group">
                <label for="pwd" class="text-primary" style="font-size: 20px;">Confirm Verification Code:</label>
                <input type="password" class="form-control" id="ver" placeholder="Enter Verification">
            </div>
            <button type="button" class="btn btn-success ml-0" onclick="checkCode();">Submit</button>
        </form>
        <br>
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
