<!DOCTYPE html>
<html>

<head>
  <!-- REQUIRED META TAGS -->
  <meta charset="utf-8" />

  <title>Love Pretty Pet Beauty</title>
  <link rel="stylesheet" href="../css/test.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/gh/PascaleBeier/bootstrap-validate@v2.2.0/dist/bootstrap-validate.js">
  </script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/e2c06272fd.js"></script>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.min.css" rel="stylesheet">
	<!-- icon css -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- JQuery -->
	<!-- Bootstrap tooltips -->
	<script type="text/javascript"
	        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<!-- MDB core JavaScript -->
	<script type="text/javascript"
	        src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/js/mdb.min.js"></script>
<script type="text/javascript" src="https://rawcdn.githack.com/ablanco/jquery.pwstrength.bootstrap/8c9b7680111544983d4e5ea6d21be6f0032982fa/dist/pwstrength-bootstrap.js"></script>
<script>
      $(document).ready(function() {
checklogin();
    });
     accountManagement = 'account.php';

    function userRegistration() {
        cleanAlertMessage();
//getting InputField data
         dealerEmail = $('#signUpEmailInputField').val();
         dealerPassword = $('#signUpPasswordInputField').val();
         dealerFName = $('#signUpFirstNameInputField').val();
         dealerLName = $('#signUpLastNameInputField').val();
         dealerPhone = $('#signUpPhoneNoInputField').val();
         data = {};
        data.type = "registration";
// check user input null  empty Field
        if (dealerEmail !== "")
            data.dealer_email = dealerEmail;
        else {
          $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");
            return;
        }
        if (dealerPassword !== "")
            data.dealer_password = dealerPassword;
        else {
                    $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");
            return;
        }
        if (dealerFName !== "")
            data.dealer_fname = dealerFName;
        else {
                    $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");

            return;
        }
        if (dealerPhone !== "")
            data.dealer_phone = dealerPhone;
        else {
                    $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");

            return;
        }
        if (dealerLName !== "")
            data.dealer_lname = dealerLName;
        else {
          $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill all the Field</div>");
            return;
        }
      // use post method to send the account.php 
        $.ajax({
            type: 'POST',
            url: accountManagement,
            data: data,
            dataType: 'json',
            success: function(result) {
                if (result[0] === "Valid") {
                    cleanRegistrationInfo();
                    $("#alert").html("<div class=\"alert alert-success\" role=\"alert\" style=\"text-align: center; ;\">Registration Successful</div>");//show the success message
                } else if (result[0] === "Invalid") {
                   $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\"><h4 class=\"alert-heading\">Registration Failure!</h4>"+result[1]+"</div>");
                  //show the fail message
                }
            }
        });
    }

    function cleanAlertMessage() {
                 $("#alert").html("");
    }

    function cleanRegistrationInfo() {
        $('#signUpDealerIDInputField').val("");
        $('#signUpPasswordInputField').val("");
        $('#signUpNameInputField').val("");
        $('#signUpPhoneNoInputField').val("");
        $('#signUpAddressInputField').val("");
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
              success: function(result) {
                  if (result[0] === 'Valid') {
                      alert("login successfully! Welcome "+ result[1]+" !");
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
<style type="text/css">
  .form {
    max-width: 600px;
    padding: 20px 40px 40px;
    margin: 0 auto;
    background-color: #fff;
    border: 2px solid rgba(0, 0, 0, 0.1);
    font-size: 16px;
}
  </style>

</head>

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

<div class="" style="background-image: url('../images/bg-pattern.png')">
    <div class="form" >
    
     <br>

      <form onsubmit="return false">
        <div class="form-group">
        <label for="signUpEmailInputField">Email</label>

        <input type="email" id="signUpEmailInputField" placeholder="Enter Email"  class="form-control" required>
        </div>
        <label for="signUpPasswordInputField">Password</label>
 <div class="form-group">
        <input type="password" id="signUpPasswordInputField"  placeholder="Enter Password" title="Must contain at least 8 or more characters."  class="form-control" required>
        </div>
        <label for="signUpConfirmPasswordInputField">Confirm Password</label>
 <div class="form-group">
        <input type="password" id="signUpConfirmPasswordInputField"  placeholder="Enter Password" title="Must contain at least 8 or more characters."  class="form-control" required>
        </div>
        
        
        <div class="form-group">
          <label for="signUpNameInputField">First Name</label>

          <input type="text" id="signUpFirstNameInputField" class="form-control" placeholder="Enter First Name" maxlength="50" title="Just accept alphabet." required></div>
        <div class="form-group"> <label for="signUpNameInputField">Last Name</label>

          <input type="text" id="signUpLastNameInputField" class="form-control" placeholder="Enter Last Name" maxlength="50" title="Just accept alphabet." required></div>
        <div class="form-group">
          <label for="signUpPhoneNoInputField">Phone Number</label><br>

          <input type="tel" id="signUpPhoneNoInputField" placeholder="Enter Phone Number" maxlength="8" pattern="\d{8}" title="Just accept numeral." class="form-control" required></div>

        <button type="button" class="btn btn-success"id="submit" onclick="userRegistration()">Sign Up</button>
        <br><br>
        <span id="alert"></span>
      </form>
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
    bootstrapValidate(
        ['#signUpFirstNameInputField', '#signUpLastNameInputField'], 'required:Please fill out this field!|alpha:You can only input alphabetic characters!', //checking user input
        function (isValid) {
            // if not valid, disabled the button
            if (isValid) {
                document.getElementById("submit").disabled = false;
            } else {
                document.getElementById("submit").disabled = true;
            }
        });

    bootstrapValidate(
        '#signUpEmailInputField', 'email:Please enter the correct email!|required:Please fill out this field!',
        function (isValid) {
            if (isValid) {
                document.getElementById("submit").disabled = false;
            } else {
                document.getElementById("submit").disabled = true;
            }
        });
    bootstrapValidate(
        '#signUpPhoneNoInputField', 'regex:[0-9]{8}:Please enter the correct phone number!|required:Please fill out this field!',
        function (isValid) {
            if (isValid) {
                document.getElementById("submit").disabled = false;
            } else {
                document.getElementById("submit").disabled = true;
            }
        });
    bootstrapValidate(
        '#signUpPasswordInputField', 'regex:[a-zA-Z0-9]{8,}:Please enter 8 digit password|required:Please fill out this field!',
        function (isValid) {
            if (isValid) {
                document.getElementById("submit").disabled = false;
            } else {
                document.getElementById("submit").disabled = true;
            }
        });
    bootstrapValidate(
        '#signUpConfirmPasswordInputField', 'matches:#signUpPasswordInputField:Your passwords should match',
        function (isValid) {
            if (isValid) {
                document.getElementById("submit").disabled = false;
            } else {
                document.getElementById("submit").disabled = true;
            }
        });
    $('#signUpPasswordInputField').pwstrength({
        ui: { showVerdictsInsideProgressBar: true }
    });

</script>
</html>
