<?php

if (isset($_SESSION['id'])) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- REQUIRED META TAGS -->
    <meta charset="utf-8"/>
    <title>Love Pretty Pet Beauty</title>
    <link ref="stylesheet" href="../css/test.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/e2c06272fd.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.min.css" rel="stylesheet">
    <!--	icon css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/PascaleBeier/bootstrap-validate@v2.2.0/dist/bootstrap-validate.js">
    </script>
    <script src="https://rawcdn.githack.com/ablanco/jquery.pwstrength.bootstrap/8c9b7680111544983d4e5ea6d21be6f0032982fa/dist/pwstrength-bootstrap.js"></script>
    <!-- JQuery -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <!-- MDB core JavaScript -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/js/mdb.min.js"></script>

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
            getuserinfo();
            getBooking();
            getpetinfo();
            getpetspe();
            checklogin();

            $('.pet-list').click(function () {
                getpetinfo();
            });
            $("#myModal").on("shown.bs.modal", function (e) {
                petid = [];
                $('#pettable input[type=checkbox]:checked').each(function (i) {
                    petid[i] = $(this).val();
                });
                if (petid.length == 0) {
                    alert('Please choose the pet!');
                    $('#myModal').modal('hide');
                    return;
                }
                if (petid.length > 1) {
                    alert("Sorry, You can't modify pet information in one time!");
                    $('#myModal').modal('hide');
                    return;
                }
                $.ajax({
                    type: 'get',
                    url: 'account.php',
                    data: {
                        type: "getMPetInfo",
                        petid: petid[0]
                    },
                    datatype: "json",
                    success: function (result) {
                        $('#cpetname').val(result[0]['name']);
                        $('#cbirth').val(result[0]['birth_date']);
                        Cookies.set('pet', "'" + result[0]['id'] + "'");
                    }
                })
            });
        })

        function getuserinfo() {
            $.ajax({
                type: 'get',
                url: 'account.php',
                data: {
                    type: "getUserInfo",
                },
                datatype: "json",
                success: function (result) {
                    $('#fname').val(result[1]['first_name']);
                    $('#lname').val(result[1]['last_name']);
                    $('#email').val(result[1]['email']);
                    $('#phone').val(result[1]['mobile']);
                }
            })
        }

        function getpetinfo() {
            $.ajax({
                type: 'get',
                url: 'account.php',
                data: {
                    type: "getPetInfo",
                },
                datatype: "json",
                success: function (result) {
                    var table = '<table class="table table-hover" id="pettable">' +
                        '  <thead>' +
                        '    <tr>' +
                        '      <th scope="col">#</th>' +
                        '      <th scope="col">Name</th>' +
                        '      <th scope="col">species</th>' +
                        '      <th scope="col">Birthdate</th>' +
                        '    </tr>' +
                        '  </thead>' +
                        '  <tbody>';
                    for (i = 0; i < result.length; i++) {
                        if (result.length == 0)
                            break;
                        table += '<th scope="row"><input type="checkbox" name="pet" value="' + result[i]['id'] + '"></th>';
                        table += '<td>' + result[i]['name'] + '</td>';
                        table += '<td>' + result[i]['species_name'] + '</td>';
                        table += '<td>' + result[i]['birth_date'] + '</td></tr>';
                    }
                    table += '</tbody></table>';
                    $("#petinfo").html(table);
                }
            })
        }

        function getBooking() {
            $.ajax({
                type: 'get',
                url: 'account.php',
                data: {
                    type: "getBooking"
                },
                datatype: "json",
                success: function (result) {
                    var radio = '';
                    var table = '<table class="table table-striped " id="booktable">' +
                        '  <thead>' +
                        '    <tr>' +
                        '      <th scope="col">Store Name</th>' +
                        '      <th scope="col">Booking Date</th>' +
                        '      <th scope="col">Booking Time</th>' +
                        '      <th scope="col">Pet</th>' +
                        '      <th scope="col">Total Amount</th>' +
                        '      <th scope="col">Service</th>' +
                        '      <th scope="col">Booking Status</th>' +
                        // '      <th scope="col"></th>' +
                        '    </tr>' +
                        '  </thead>' +
                        '  <tbody>';
                    for (i = 0; i < result.length; i++) {
                        if (result.length == 0)
                            break;


                        table += '<td><a href="shopinfo.php?id=' + result[i]['store_id'] + '" target="_self"  class=" d-flex  ">' + result[i]['store_name'] + "&nbsp&nbsp&nbsp" + '<i class="fas fa-external-link-alt"></i></a></td>';
                        table += '<td>' + result[i]['date'] + '</td>';
                        table += '<td>' + result[i]['start_hour'] + '</td>';
                        table += '<td>' + result[i]['pet_name'] + '</td>';
                        table += '<td>' +"$" + result[i]['total_amount'] + '</td>';
                        table += '<td>' + result[i]['selected_services'] + '</td>';
                        table += '<td>' + result[i]['status_name'] + '</td></tr>';
                        table += '<td colspan="7">' + result[i]['remarks'] + '</td></tr>';
                        // table += '<td> <button type="button" id="bookingBtn" class="btn btn-outline-secondary waves-effect" data-toggle="modal" data-target="#bookingModal"> Booking Form </button></td></tr>';


                        radio +=
                            '<div class="custom-control custom-radio">' +
                            '<input type="radio" class="custom-control-input" onclick="setPet()" name="petName" id="' + result[i]['pet_name'] + '" value="' + result[i]['pet_id'] + '">' +
                            '<label class=" custom-control-label  text-primary font-weight-bold" for="' + result[i]['pet_name'] + '"> ' + result[i]['pet_name'] + '</label></div>';


                        var today = new Date();
                        var tomorrow = new Date();
                        tomorrow.setDate(today.getDate() + 1);
                        var duration = result[i].duration * 1; //store.duration
                        var operation = function (currentDateTime) {
                            switch (currentDateTime.getDay()) {
                                case 6:
                                    this.setOptions({
                                        minTime: result[i].sat_open_hour,//store.sat_open_hour
                                        maxTime: result[i].sat_close_hour //store.sat_close_hour
                                    });
                                    break;
                                case 0:
                                    this.setOptions({
                                        minTime: result[i].sun_open_hour,//store.sat_open_hour
                                        maxTime: result[i].sun_close_hour //store.sat_close_hour
                                    });
                                    break;
                                default:
                                    this.setOptions({
                                        minTime: result[i].open_hour, //store.open_hour
                                        maxTime: result[i].close_hour//store.close_hour
                                    });
                            }
                        }
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
                                $('#booking_date').val($input.val().slice(0, 10));
                            },
                            onSelectTime: function (dp, $input) {
                                $('#booking_start_hour').val($input.val().slice(11, 16));

                            }
                        })
                    }

                    table += '</tbody></table>';
                    $("#bookRecord").html(table);
                    $("#petRadio").html(radio);
                }
            })
        }


        function getBookingDetails() {
            bookid = [];
            $('#booktable input[type=checkbox]:checked').each(function (i) {
                bookid[i] = $(this).val();
            });

            // $.ajax({
            // type: 'get',
            // url: 'account.php',
            // data: {
            //     type: "getBookingDetails",
            // },
            // datatype: "json",
            // success: function (result) {
            //     var table = '<table class="table table-hover">' +
            //         '  <thead>' +
            //         '    <tr data-toggle="collapse" da>' +
            //         '      <th scope="col">#</th>' +
            //         '      <th scope="col">Store Name</th>' +
            //         '      <th scope="col">Booking Date</th>' +
            //         '      <th scope="col">Booking Time</th>' +
            //         '      <th scope="col">Pet</th>' +
            //         '      <th scope="col">Total Amount</th>' +
            //         // '      <th scope="col">Service</th>' +
            //         '      <th scope="col">Booking Status</th>' +
            //         '    </tr>' +
            //         '  </thead>' +
            //         '  <tbody>';
            //     for (i = 0; i < result.length; i++) {
            //         console.log(result[i]['id']);
            //         if (result.length == 0)
            //             break;
            //         //else if()
            //
            //         table += '<th scope="row"><input type="checkbox" name="booking" value="' + result[i]['id'] + '"></th>';
            //         table += '<td>' + result[i]['store_name'] + '</td>';
            //         table += '<td>' + result[i]['date'] + '</td>';
            //         table += '<td>' + result[i]['start_hour'] + '</td>';
            //         table += '<td>' + result[i]['name'] + '</td>';
            //         table += '<td>' + result[i]['total_amount'] + '</td>';
            //         // table += '<td>' + result[i]['service_name'] + '</td>';
            //         table += '<td>' + result[i]['status_name'] + '</td></tr>';
            //
            //     }
            //     table += '</tbody></table>';
            //     $("#bookRecord").html(table);
            //     }
            // })
            console.log(bookid);
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

            if (petname == "" || birth == "") {
                alert("Please fill in all the Field!");
                return;
            }
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
                        alert("booking added unsuccessfully!");
                        document.getElementById("addBookingBtn").disabled = true;
                    } else if (result[0] == 'InValid') {
                        alert(result[1]);

                    }
                }

            });

        }
        function getpetspe() {
            $.ajax({
                type: 'get',
                url: 'account.php',
                data: {
                    type: "getPetSpe",
                },
                datatype: "json",
                success: function (result) {
                    var select = '<select name="spe" id="spe" class="form-control">'
                    var select2 = '<select name="spe2" id="spe2" class="form-control">'
                    for (i = 0; i < result.length; i++) {
                        select += '  <option value="' + result[i]['id'] + '">' + result[i]['species_name'] + '</option>';
                        select2 += '  <option value="' + result[i]['id'] + '">' + result[i]['species_name'] + '</option>';

                    }
                    select += '</select>'
                    select2 += '</select>'

                    $("#species").html(select);
                    $("#species2").html(select2);

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
                        window.location.replace("index.php");
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
                        alert("login successfully! Welcome " + result[1] + " !");
                        location.reload();
                    } else {
                        alert('email or password is incorrect')
                    }
                }
            })
        }

        function changeUserInfo() {
            Email = $('#email').val();
            FName = $('#fname').val();
            LName = $('#lname').val();
            Phone = $('#phone').val();
            if (Email == "") {
                $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");
                return;
            }
            if (FName == "") {
                $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");
                return;
            }
            if (LName == "") {
                $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");
                return;
            }
            if (Phone == "") {
                $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please fill in all the Field</div>");
                return;
            }

            $.ajax({
                type: 'post',
                url: 'account.php',
                data: {
                    type: "updateUserInfo",
                    email: Email,
                    fname: FName,
                    lname: LName,
                    phone: Phone
                },
                datatype: "json",
                success: function (result) {
                    if (result[0] == 'Valid') {
                        alert('information changed successfully');
                    }

                }
            })
        }

        function addpets() {
            petname = $('#petname').val();
            birth = $('#birth').val();
            spe = $('#spe').val();
            if (petname == "" | birth == "") {
                alert("Please fill in all the Field!");
                return;
            }
            $.ajax({
                type: 'post',
                url: 'account.php',
                data: {
                    type: "addpet",
                    petname: petname,
                    birth: birth,
                    spe: spe
                }, datatype: "json",
                success: function (result) {
                    if (result[0] == 'Valid') {
                        alert("pet added successfully!");
                        document.getElementById("addpet").disabled = true;
                        getpetinfo();
                    } else if (result[0] == 'InValid') {
                        alert(result[1]);
                    }
                }

            })

        }

        function deletepet() {
            petid = [];
            $('#pettable input[type=checkbox]:checked').each(function (i) {
                petid[i] = $(this).val();
            })
            if (petid.length == 0) {
                $("#alert").html("<div class=\"alert alert-danger\" role=\"alert\" style=\"text-align: center;\">Please choose the pet!'</div>");
                return;
            }
            $.ajax({
                type: 'post',
                url: 'account.php',
                data: {
                    type: "delpet",
                    petid: petid
                }, datatype: "json",
                success: function (result) {
                    if (result[0] == 'Valid') {
                        alert("pet delete successfully!");
                        document.getElementById("deletepet").disabled = true;
                        getpetinfo();
                    } else {
                        alert('Something wrong, please try again');
                    }
                }

            });
        }

        function modpet() {
            petname = $('#cpetname').val();
            birth = $('#cbirth').val();
            spe = $('#spe2').val();
            id = Cookies.get('pet');
            if (petname == "" | birth == "") {
                alert("Please fill in all the Field!");
                return;
            }
            $.ajax({
                type: 'post',
                url: 'account.php',
                data: {
                    type: "modpet",
                    petid: id,
                    birth: birth,
                    spe: spe,
                    petname: petname

                },
                datatype: "json",
                success: function (result) {
                    if (result[0] == 'Valid') {
                        alert('pet modify successfully!');
                        $('#myModal').modal('hide');
                        Cookies.remove('pet');
                    } else if (result[0] == 'InValid') {
                        alert(result[1]);
                    }
                }

            })

        }

        function changepass() {
            cpass = $('#cpassword').val();
            npass = $('#npassword').val();
            cupass = $('#cupassword').val();

            if (cpass == "" | npass == "" | cupass == "") {
                alert("Please fill in all the Field!");
                return;
            }
            $.ajax({
                type: 'post',
                url: 'account.php',
                data: {
                    type: "changepass",
                    cpass: cpass,
                    npass: npass,
                    cupass: cupass,
                },
                datatype: "json",
                success: function (result) {
                    if (result[0] == 'Valid') {
                        alert('Password changed successfully! ')
                    } else if (result[0] == 'InValid') {
                        alert(result[1])
                    }
                }
            })
        }


        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })


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
<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
       aria-controls="nav-home" aria-selected="true"><i class="fas fa-info-circle"> User Info</i></a>
    <a class="nav-item nav-link " id="nav-book-tab" data-toggle="tab" href="#nav-book" role="tab"
       aria-controls="nav-book" aria-selected="false"><i class="fa fa-calendar-check-o"> Booking Record</i></a>
    <a class="nav-item nav-link" id="nav-book-tab" data-toggle="tab" href="#nav-profile" role="tab"
       aria-controls="nav-profile" aria-selected="false"><i class="fas fa-paw"> Pet List</i></a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
       aria-controls="nav-contact" aria-selected="false"><i class="fas fa-plus-square"> Add Pet</i></a>
    <a class="nav-item nav-link password" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab"
       aria-controls="nav-password" aria-selected="false"><i class="fas fa-shield-alt"> Change Password</i></a>

</div>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <!-- form user info -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0" style="text-align:center;">User Information</h3>
            </div>
            <div class="card-body">
                <form class="form" role="form" autocomplete="off">
                    <div class="form-group">
                        <label class="form-control-label">First name</label>
                        <div class="">
                            <input class="form-control" type="text" value="" id="fname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Last name</label>
                        <input class="form-control" type="text" value="" id="lname">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input class="form-control" type="email" value="" id="email">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Phone</label>
                        <input class="form-control" type="text" value="" id="phone" maxlength="8">
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="button" class="btn btn-danger" value="Cancel" onclick="getuserinfo();">
                            <input type="button" class="btn btn-primary" value="Save Changes" id="save"
                                   onclick="changeUserInfo();">
                        </div>
                        <span id="alert"></span>
                    </div>

                </form>
            </div>
        </div>
        <!-- /form user info -->
    </div>
    <div class="tab-pane fade" id="nav-book" role="tabpanel" aria-labelledby="nav-book-tab">
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0" style="text-align:center;">Booking Record</h3>
            </div>
            <div class="card-body"><span id="bookRecord"></span>
                <!--                <input type="button" class="btn btn-primary" value="View Detail" id="viewdetail"-->
                <!--                       onclick="getBookingDetails()">-->
                <!--                <button type="button" class="btn btn-primary" id="markComplete" onclick="updateRecord()">Mark As-->
                <!--                    Complete-->
                <!--                </button>-->

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0" style="text-align:center;">Pet Information</h3>
            </div>
            <div class="card-body"><span id="petinfo"></span>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">modify
                </button>
                <button type="button" class="btn btn-danger" id="deletepet" onclick="deletepet()">delete</button>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <!-- form user info -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0" style="text-align:center;">Add Pet Information</h3>
            </div>
            <div class="card-body">
                <form class="form" role="form" autocomplete="off">
                    <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <div class="">
                            <input class="form-control" type="text" value="" id="petname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Birth date</label>
                        <input class="form-control" type="date" value="" id="birth"
                               max="<?php echo date("Y-m-d") ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Species</label>
                        <span id="species"></span></div>

                    <div class="form-group">
                        <label class="form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="reset" class="btn btn-danger" value="Cancel">
                            <input type="button" class="btn btn-primary" value="Add Pet" id="addpet"
                                   onclick="addpets()">
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- /form user info -->

    <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
        <div class="card-header">
            <h3 class="mb-0" style="text-align:center;">Change Password</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off">
                <div class="form-group">
                    <label class=" form-control-label">Current password</label>
                    <div class="">
                        <input class="form-control" type="password" value="" id='cupassword'>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" form-control-label">New Password</label>
                    <div class="">
                        <input class="form-control" type="password" value="" id='npassword'>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Confirm Password</label>
                        <div class="">
                            <input class="form-control" type="password" value="" id='cpassword'>
                        </div>
                        <input type="button" class="btn btn-danger" value="save" id="save2" onclick="changepass()">
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modify information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form class="form" role="form" autocomplete="off">
                        <div class="form-group">
                            <label class="form-control-label">Name</label>
                            <div class="">
                                <input class="form-control" type="text" value="" id="cpetname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Birth date</label>
                            <input class="form-control" type="date" value="" id="cbirth"
                                   max="<?php echo date("Y-m-d") ?>" required>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Species</label>
                            <div class="">
                                <span id="species2"></span></div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label"></label>
                            <div class="col-lg-9">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="button" class="btn btn-primary" value="Modify pet" id="modpet" onclick="modpet()">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="multi-step" id="bookingModal">
</div>

<div class=""></div>

</div>

<div class="view">
    <img src="../images/banner.png" class="img-fluid" alt="">

    <div class="mask flex-center waves-effect waves-light">
        <p class="black-text"><h5><b>© 2019 Copyright</b></h5></p>
    </div>
</div>

</body>
<script type="text/javascript">
    bootstrapValidate(
        ['#fname', '#lname'], 'required:Please fill out this field!|alpha:You can only input alphabetic characters!', //checking user input
        function (isValid) {
            if (isValid) { //if not valid, disabled the button
                document.getElementById("save").disabled = false;
            } else {
                document.getElementById("save").disabled = true;
            }
        });

    bootstrapValidate(
        '#email', 'email:Please enter the correct email!|required:Please fill out this field!',
        function (isValid) {
            if (isValid) {
                document.getElementById("save").disabled = false;
            } else {
                document.getElementById("save").disabled = true;
            }
        });
    bootstrapValidate(
        '#phone', 'regex:[0-9]{8}:Please enter the correct phone number!|required:Please fill out this field!',
        function (isValid) {
            if (isValid) {
                document.getElementById("save").disabled = false;
            } else {
                document.getElementById("save").disabled = true;
            }
        });
    bootstrapValidate(
        '#cpassword', 'matches:#password:Your passwords should match',
        function (isValid) {
            if (isValid) {
                document.getElementById("save").disabled = false;
            } else {
                document.getElementById("save").disabled = true;
            }
        });
    bootstrapValidate(
        '#petname', 'required:Please fill out this field!|alpha:You can only input alphabetic characters',
        function (isValid) {
            if (isValid) {
                document.getElementById("addpet").disabled = false;
            } else {
                document.getElementById("addpet").disabled = true;
            }
        });
    bootstrapValidate(
        '#cpassword', 'matches:#npassword:Your passwords should match',
        function (isValid) {
            if (isValid) {
                document.getElementById("save2").disabled = false;
            } else {
                document.getElementById("save2").disabled = true;
            }
        });
    $('#npassword').pwstrength({
        ui: {showVerdictsInsideProgressBar: true}
    });

</script>

</html>
