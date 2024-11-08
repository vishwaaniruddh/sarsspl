<?php
session_start();
include ('config.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>location</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        .rounded {
            border-radius: 20px;
            height: 40px;
        }
    </style>
    <script>


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function test() {
            alert('kk');
        }
    </script>
    <style>
        .busy * {
            cursor: wait !important;
        }

        .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button2 {
            .button {
                background-color: #FBBA00;
                border: none;
                color: white;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s;
                /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
            }
        }

        .button1 {
            background-color: #FBBA00;
            color: #fff;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 22px;
            padding: 8px 10px;
        }




        /* unvisited link */
        .test2:link {
            color: #5B5B5B;
            text-decoration: none;
        }
        }

        /* visited link */
        .test2:visited {
            color: #5B5B5B;
        }

        /* mouse over link */
        .test2:hover {
            color: #00A0E3;
            text-decoration: underline;
        }

        /* selected link */
        .test2:active {
            color: #5B5B5B;
        }

        .col-md-6 {
            width: 33%;
        }

        .col-md-offset-3 {
            margin-left: 34%;
        }
    </style>


    <script>
        function validation() {

            var Name = document.getElementById("Name").value;
            var Address = document.getElementById("Address").value;
            var Contact1 = document.getElementById("Contact1").value;
            var Contact2 = document.getElementById("Contact2").value;
            var ContactPerson = document.getElementById("ContactPerson").value;
            var Email = document.getElementById("Gmail").value;

            var emailFilter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (Name == "") {
                swal("please fill up Name");
                return false;
            }
            else if (Address == "") {
                swal("please fill up Address");
                return false;
            }
            else if (Contact1 == "") {
                swal("please enter Contact1");
                return false;
            }
            else if (ContactPerson == "") {
                swal("please enter Contact Person Name");
                return false;
            }

            else if (Email == "") {
                swal(" please fill email id ");
                return false;

            }
            else if (!emailFilter.test(Email)) {

                swal("invalid email ")
                return false;
            }
            else {

                sumitfunc();
                return true;

            }

        }
    </script>
    <script>
        function sumitfunc() {
            var Name = document.getElementById("Name").value;
            var Address = document.getElementById("Address").value;
            var Contact1 = document.getElementById("Contact1").value;
            var Contact2 = document.getElementById("Contact2").value;
            var ContactPerson = document.getElementById("ContactPerson").value;
            var Email = document.getElementById("Gmail").value;

            $.ajax({
                type: 'POST',
                url: 'location_process.php',

                data: 'Name=' + Name + '&Address=' + Address + '&Contact1=' + Contact1 + '&Contact2=' + Contact2 + '&ContactPerson=' + ContactPerson + '&Email=' + Email,

                success: function (msg) {


                    //alert(msg);
                    if (msg == 1) {
                        swal("Location Added Successfully");
                        window.open("viewlocation.php", "_self");
                    } else {
                        swal("error");
                    }


                }
            })
        }
    </script>
</head>

<body>
    <?php include 'menu.php' ?>

    <div class="row" style="margin-right:0px;">
        <div class="col-md-12" style="
    right: 15px;
">

            <div class="row" style="margin-top:2%;">
                <div class="col-md-6 col-md-offset-3" style="border: 1px solid #bfbfbf;">
                    <form class="login" action="process_admin_login.php" method="post" style="
    margin-bottom: 0px;
    margin-top: 0px;
    padding-bottom: 0px;
">
                        <form method="post">


                            <h1>Location Entry</h1>

                            <fieldset>

                                <label for="name"><b>Name :</b></label>
                                <input type="text" id="Name" name="Name" placeholder="Name">

                                <label for="name"><b>Address:</b></label>
                                <input type="text" id="Address" name="Address" placeholder="Address">


                                <label for="mail"><b>Contact1:</b></label>
                                <input type="text" id="Contact1" name="Contact1" placeholder="Contact1" maxlength="10"
                                    onkeypress="return isNumber(event)">

                                <label for="mail"><b>Contact2:</b></label>
                                <input type="text" id="Contact2" name="Contact2" placeholder="Contact2" maxlength="10"
                                    onkeypress="return isNumber(event)">

                                <label for="mail"><b>ContactPerson</b></label>
                                <input type="text" id="ContactPerson" name="ContactPerson" placeholder="Contact Person">

                                <label for="mail"><b>Email</b></label>
                                <input type="text" id="Gmail" name="Gmail" placeholder="Email ID">

                                <center>
                                    <button type="button" onclick="validation()"
                                        style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">Submit</button>
                                </center></br>


                        </form>

                </div>
            </div>

        </div>
    </div>


</body>

</html>
<?php //echo $abc; ?>