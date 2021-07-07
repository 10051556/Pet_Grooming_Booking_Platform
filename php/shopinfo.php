<?php

include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
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


    <link rel="stylesheet" type="text/css"
          href="../datetimepicker/jquery.datetimepicker.css"/>
    <script src="../datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <script src="../datetimepicker/build/jquery.datetimepicker.min.js"></script>
    <script src="../datetimepicker/jquery.datetimepicker.js"></script>

    <link rel="stylesheet" type="text/css"
          href="../multi-step-modal-wizard/dist/css/MultiStep.min.css"/>
    <link rel="stylesheet" type="text/css" href="../multi-step-modal-wizard/dist/css/MultiStep-theme.min.css">
    <script src="../multi-step-modal-wizard/dist/js/MultiStep.min.js"></script>


    <script>

        $(document).ready(function () {

            $.ajax({
                type: 'GET',
                url: 'getdata/(test)getdata.php',
                data: {id:<?php echo $_GET['id'] ?>},
                dataType: 'json',
                success: function (result) {

                    getPetName();
                    insertData(result);


                },
                error: function () {
                    console.log("no good");
                }
            })
        })

        function getPetName() {
            $.ajax({
                type: 'get',
                url: 'account.php',
                data: {
                    type: "getPetName",
                    id:<?php echo $_GET['id'] ?>
                },
                datatype: "json",
                success: function (result) {
                    try {
                        $('#me').val(result[0]['id']);

                    } catch (e) {
                        document.getElementById("radioTitle").innerText = "Please add an applicable Pet";
                    }


                    var radio = '';
                    for (i = 0; i < result.length; i++) {
                        if (result.length == 0) {
                            radio += "";
                        } else {
                            radio +=
                                '<div class="custom-control custom-radio">' +
                                '<input type="radio" class="custom-control-input" onclick="setPet()" name="petName" id="' + result[i]['name'] + '" value="' + result[i]['pet_id'] + '">' +
                                '<label class=" custom-control-label  text-primary font-weight-bold" for="' + result[i]['name'] + '"> ' + result[i]['name'] + '</label></div>';
                        }
                    }
                    $("#petRadio").html(radio);
                }
            })
        }


        function insertData(result) {

            $('#store_name').text(result[0].store_name);
            $('#address').text(result[0].address);
            $('#district').text(result[0].district);
            $('#open_hour').text(result[0].open_hour);
            $('#close_hour').text(result[0].close_hour);
            $('#contact_person').text(result[0].contact_person);
            $('#phone').text(result[0].phone);
            $('#email').text(result[0].email);
            $('#description').text(result[0].description);
            $('#image').attr("src", "../images/" + (result[0].imagePath));
            $('#map').attr("src", "https://www.google.com/maps/embed?pb=" + (result[0].mapPath));

            $('#bookingModal').MultiStep({

                title: `<div><h4 id=store_name2 class="font-weight-bold align-left" ><h4></div>`,
                data: [
                    {
                        label: "Step 1 Pet",
                        content:
                            `<form id="bookingForm" name="bookingForm">
                                         <h4><i class="fas" id ="radioTitle">Pick your Pet</i></h4>
                                         <span id="petRadio" ></span>
                                         <input type="hidden" id="pet_id" name="pet_id" required>
                                           <input type="hidden" id="me" name="owner_id"  placeholder="ownerid" required/>
                                        <input type="hidden" id="thisStore" name="store_id" placeholder="storeid" value="<?php echo $_GET['id'] ?>" required/>

`
                    },
                    {
                        label: " Step 2 Service",
                        content:
                            `<h4><i class="fas" >Select Services</i></h4>
                                    <?php
                            $query =
                                "SELECT
        DISTINCT(store.store_name), service.id, service.service_name, provides.fee
    FROM
        `provides`,
        `service`,
        `store`
    WHERE
        store.id = provides.store_id AND service.id = provides.service_id AND store_id = '$_GET[id]'";
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            $total_row = $statement->rowCount();
                            $output = '';
                            if ($total_row > 0) {
                            $i = 0;
                            foreach ($result as $row) {
                            ?>

                        <div class = "custom-control custom-checkbox mb-0" >
                            <input class = "custom-control-input"
                        id = "<?php echo $row['service_name']; ?>"
                        name = "product[]"
                        value = "<?php echo $row['fee']; ?>"
                        type = "checkbox"
                        onclick = "amountCount();" required / >
                        <label class = "custom-control-label"
                    for = "<?php echo $row['service_name']; ?>" > <?php echo $row['service_name']; ?> </label>
                    <label class = "text-primary font-weight-bold" > <?php echo "$" . $row['fee']; ?> </label>
                    </div>

                    <?php
                            $i++;
                            }
                            ?>
                    <?php
                            }
                            ?>
                    <div class = "input-group mb-3">
                    <div class = "input-group-prepend">
                    <span class = "input-group-text">$</span>
                    </div>
                    <input id = "total_amount" type = "text" class = "form-control"
                    aria-label = "Amount (to the nearest dollar)"
                    value = "0.00" readonly = "readonly" type = "hidden"
                    name = "total_amount">
                    <input type="hidden" class="form-control" id = "selected_services"
                    name = "selected_services" >
                    </div>`

                    },
                    {
                        label: " Step 3 Date & Time",
                        content: `
                                        <h4><i class="fas">Select Date and Hour</i></h4>
                                        <input type="hidden" id="cleanDatetimepicker"/>

                                        <div class="md-form mb-4 pink-textarea active-pink-textarea">
                                            <textarea id="booking_date" class="md-textarea form-control" rows="0" name="date" rows="3" required placeholder="Selected Date" readonly></textarea>
                                        </div>

                                        <div class="md-form amber-textarea active-amber-textarea">
                                                <textarea id="booking_start_hour" class="md-textarea form-control" rows="0" name="start_hour" required placeholder="Selected Hour" readonly></textarea>
                                        </div>
                                                <input type="hidden" id="status_id" name="status_id" value="1" required>`


                    }
                ],
                final: `

                <h4><i class="fas">Remarks</i></h4><div class="form-group shadow-textarea">
                                                        <textarea name="remarks" class="form-control z-depth-1" id="remarks"
                                                         rows="3" placeholder="Leave special instruction here..."></textarea>
                                                         </div><input type="button" class="btn  aqua-gradient btn-block" value="Submit Booking"
                                                         id="addBookingBtn"
                                                          onclick="addBooking()"></form>`,

                finishText: 'Leave'
            });
            $('#store_name2').text(result[0].store_name);

            var today = new Date();
            var tomorrow = new Date();
            tomorrow.setDate(today.getDate() + 1);
            var duration = result[0].duration * 1; //store.duration
            var operation = function (currentDateTime) {
                switch (currentDateTime.getDay()) {
                    case 6:
                        this.setOptions({
                            minTime: result[0].sat_open_hour,//store.sat_open_hour
                            maxTime: result[0].sat_close_hour //store.sat_close_hour
                        });
                        break;
                    case 0:
                        this.setOptions({
                            minTime: result[0].sun_open_hour,//store.sat_open_hour
                            maxTime: result[0].sun_close_hour //store.sat_close_hour
                        });
                        break;
                    default:
                        this.setOptions({
                            minTime: result[0].open_hour, //store.open_hour
                            maxTime: result[0].close_hour//store.close_hour
                        });
                }
            };


            $('#cleanDatetimepicker').datetimepicker({
                inline: true,
                defaultSelect: false,
                todayButton: false,
                minDate: tomorrow,
                minTime: true,
                maxTime: true,
                yearStart: 2019,
                step: duration,
                onChangeDateTime: operation,
                onShow: operation,
                onSelectDate: function (dp, $input) {
                    console.log($input.val().slice(0, 10));
                    $('#booking_date').val($input.val().slice(0, 10));
                },
                onSelectTime: function (dp, $input) {
                    $('#booking_start_hour').val($input.val().slice(11, 16));

                },


            });


            for (var i = 1; i < result.length; i++) {
                var text = "<div class=\"text-left\">" +
                    "<h5>" + result[i].service_name + "</h5>" +
                    "<p class=\"m-0\">" + result[i].description + "</p>" +
                    "<p class=\"text-primary font-weight-bold\">" + "$" + result[i].fee + "</p>" +

                    "</div>";

                $('#service2').after(text);

            }


        }

        function dropLogin() {
            var x = document.getElementById("userDropdownMenu").getAttribute("aria-expanded");
            var y = document.getElementById("dropdrop");
            if (x == "true" && y == "show") {
                x = "false"
                y = "";
            } else {
                x = "true";
                y = "show";
            }
            document.getElementById("userDropdownMenu").setAttribute("aria-expanded", x);
            document.getElementById("dropdrop").classList.toggle(y);
        }


        function servicehtml() {
            var text = "<div class=\"text-left\">\n" +
                "         <h5>hair cut</h5>\n" +
                "         <p class=\"m-0\">This is destiption.</p>\n" +
                "         <p class=\"text-warning\">$100</p>\n" +
                "        </div>";
            return text;
        }


        function amountCount() {
            var input = document.getElementsByName("product[]");
            var total = 0;
            for (var i = 0; i < input.length; i++) {
                if (input[i].checked) {
                    total += parseFloat(input[i].value);
                    document.querySelector('input[name="total_amount"]').value = +total.toFixed(2);
                    var value = $("input:radio[name=total_amount]:checked").val();
                    console.log(value);
                }
            }
            var item = [];
            $.each($("input[name='product[]']:checked"), function () {
                item.push($(this).attr('id'));
            });
            $('#selected_services').val(item.join(", "));
            console.log(item.join(", "));
        }

        function serviceCount() {
            var item = [];
            $.each($("input[name='product[]']:checked"), function () {
                item.push($(this).attr('id'));
            });
            alert("The selected service: " + item.join(", "));
        }


        function setPet() {
            $('#pet_id').val($("input:radio[name=petName]:checked").val());
        }


        function addBooking() {
            var owner_id = parseInt($('#me').val());
            //console.log(typeof owner_id);
            var store_id = parseInt($('#thisStore').val());
            //console.log(typeof store_id);

            var date = $('#booking_date').val();
            //console.log(typeof date);

            var start_hour = $('#booking_start_hour').val();
            //console.log(typeof start_hour);

            var selected_services = $('#selected_services').val();
            //console.log(typeof selected_services);

            var total_amount = parseFloat($('#total_amount').val());
            //console.log(typeof total_amount);

            var pet_id = parseInt($('#pet_id').val());
            //console.log(typeof pet_id);

            var remarks = $('#remarks').val();
            // console.log(typeof remarks);

            var status_id = parseInt($('#status_id').val());
            //console.log(typeof status_id);

            if (pet_id > 0) {

                if (date == "") {
                    alert("Please select a date!");
                    return;
                }
                if (start_hour == "") {
                    alert("Please select a time!");
                    return;
                }
                if (selected_services == "") {
                    alert("Please select at least one service!");
                    return;
                } else {

                    $.ajax({
                        type: 'post',
                        url: 'account.php',
                        data: {
                            type: "addBooking",
                            store_id: store_id,
                            start_hour: start_hour,
                            date: date,
                            remarks: remarks,
                            owner_id: owner_id,
                            pet_id: pet_id,
                            total_amount: total_amount,
                            selected_services: selected_services,
                            status_id: status_id

                        }, datatype: "json",
                        success: function (result) {
                            if (result[0] == 'Valid') {
                                alert("booking added successfully!");
                                document.getElementById("addBookingBtn").disabled = true;
                            } else if (result[0] == 'InValid') {
                                alert(result[1]);

                            }
                        }

                    });
                    location.reload();
                }

            } else {
                alert("Please select a pet!");
                return;
            }
        }
    </script>

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
                            '						  <a class="dropdown-item" href="#">Forgot password</a>');
                        $('#loginBtn').show();
                        $('#bookingBtn').hide();

                    } else if (result[0] == 'Valid' && result[1] == '1') {
                        $("#dropdown-menu").html(' <a class="dropdown-item" href="userinfo.php">User infomation</a>' +
                            '						  <a class="dropdown-item" href="../php/logout.php">Logout</a>');
                        $('#loginBtn').hide();
                        $('#bookingBtn').show();

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

                        <div class="dropdown-menu" id="dropdrop">
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
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form onsubmit="return false">
                    <label for="signInUsernameInputField">Username:</label><br>
                    <input type="text" id="signInUsernameInputField" pattern="[a-zA-Z0-9]{8,}" maxlength="20"
                           placeholder="Enter Username" required>
                    <br>
                    <label for="signInPasswordInputField">Password:</label><br>
                    <input type="password" id="signInPasswordInputField" pattern="[a-zA-Z0-9]{8,}" maxlength="20"
                           placeholder="Enter Password" required>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Login</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <input type="text" hidden="" id="1">
    <div class="card flex-row mt-3">
        <div class="card-header border-0" style="background-color: white">
            <img id="image" width="200" height="200" alt="">
        </div>
        <div class="card-block px-2">
            <h3 class="card-title mt-3 store_name" id="store_name"></h3>
            <p class="card-text mb-0" id="description">Pet-grooming services for dogs include a bathing package of
                shampoo, ear cleaning,
                belly undercoat shaving, claw trimming, gland expression and more ($150-$538). Cat-grooming prices range
                from $280-$460. Members receive 10 per cent discount.</p>
            <button type="button" id="bookingBtn" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#bookingModal">
                Start
                Booking
            </button>
            <button type="button" id="loginBtn" class="btn btn-primary float-right" onclick="dropLogin()">
                Login To Start Booking
            </button>


        </div>
    </div>
</div>

<!-- The Modal -->
<div class="multi-step" id="bookingModal">
</div>

<div class="container d-flex">
    <div class="card-deck d-flex flex-column w-25 mt-3">
        <div class="card">
            <div class="card-body text-center">

                <h6 class="card-title text-left">District</h6>
                <p class="card-text text-left" id="district"></p>
                <hr>
                <h6 class="card-title text-left">Open Hour</h6>
                <p class="card-text text-left" id="open_hour"></p>
                <hr>
                <h6 class="card-title text-left">Close hour</h6>
                <p class="card-text text-left" id="close_hour"></p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body text-center">
                <h6 class="card-title text-left">Contact Person</h6>
                <p class="card-text text-left" id="contact_person"></p>
                <hr>
                <h6 class="card-title text-left">Phone</h6>
                <p class="card-text text-left" id="phone"></p>
                <hr>
                <h6 class="card-title text-left">Email</h6>
                <p class="card-text text-left" id="email"></p>
            </div>
        </div>
    </div>

    <div class="card-deck d-flex flex-column w-75 mt-3 ml-5">

        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title text-left" id="service2">Service</h6>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Address</h4>
                <iframe id="map" style="border: 0;" class="w-100 h-100"></iframe>
                <p class="ml-3" id="address"></p>
            </div>
        </div>
    </div>
</div>
<br>

<div class="view">
    <img src="../images/banner.png" class="img-fluid" alt="">

    <div class="mask flex-center waves-effect waves-light">
        <p class="black-text"><h5><b>© 2019 Copyright</b></h5></p>
    </div>
</div>

</body>
</html>
