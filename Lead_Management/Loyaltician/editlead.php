<?php
session_start();
include ('config.php');

$leadid = $_REQUEST['id'];
$sql = "select * from Leads_table where Lead_id='" . $leadid . "'";
$runsql = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($runsql);

$number0 = explode('-', $row['MobileNumber']);
$number1 = explode('-', $row['ContactNo1']);
$number2 = explode('-', $row['ContactNo2']);
$number3 = explode('-', $row['ContactNo3']);

$sql2 = "select state from state where state_id='" . $row['State'] . "'";
$runsql2 = mysqli_query($conn, $sql2);
$sqlfetch = mysqli_fetch_array($runsql2);
//print_r($number1);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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

        function modelnos() {
            //alert("hello");

            var state = document.getElementById("state").value;
            //alert(productname);
            $.ajax({

                type: 'POST',
                url: 'city.php',
                data: 'state=' + state,
                datatype: 'json',
                success: function (msg) {
                    alert(msg);
                    var jsr = JSON.parse(msg);
                    //alert(jsr.length);
                    var newoption = ' <option value="">Select</option>';
                    $('#City').empty();

                    for (var i = 0; i < jsr.length; i++) {


                        //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                        newoption += '<option id=' + jsr[i]["ids"] + ' value=' + jsr[i]["ids"] + '>' + jsr[i]["modelno"] + '</option> ';


                    }
                    $('#City').append(newoption);

                }
            })

        }



    </script>
    <script>
        function validation() {

            var Title = document.getElementById("Title").value;
            var FirstName = document.getElementById("FirstName").value;
            var LastName = document.getElementById("LastName").value;
            var mcode1 = document.getElementById("mcode1").value;
            var mob1 = document.getElementById("mob1").value;
            var Email = document.getElementById("Gmail").value;

            var emailFilter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (Title == "") {
                swal("please Select Title");
                return false;
            }
            else if (FirstName == "") {
                swal("please enter FirstName name");
                return false;
            }
            else if (LastName == "") {
                swal("please enter LastName");
                return false;
            }
            else if (mcode1 == "") {
                swal("please enter Mobile Code");
                return false;
            }
            else if (mob1 == "") {
                swal("please enter Mobile Number");
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
            var Title = document.getElementById("Title").value;
            var FirstName = document.getElementById("FirstName").value;
            var LastName = document.getElementById("LastName").value;
            var mcode1 = document.getElementById("mcode1").value;
            var mob1 = document.getElementById("mob1").value;
            var Contact1code = document.getElementById("Contact1code").value;
            var Contact1 = document.getElementById("Contact1").value;
            var Contact2code = document.getElementById("Contact2code").value;
            var Contact2 = document.getElementById("Contact2").value;
            var Contact3code = document.getElementById("Contact3code").value;
            var Contact3 = document.getElementById("Contact3").value;
            var Country = document.getElementById("Country").value;
            var state = document.getElementById("state").value;
            var City = document.getElementById("City").value;
            var Nationality = document.getElementById("Nationality").value;

            var Company = document.getElementById("Company").value;
            var Designation = document.getElementById("Designation").value;
            var Gmail = document.getElementById("Gmail").value;
            var Relationship = document.getElementById("Relationship").value;
            var Facebook = document.getElementById("Facebook").value;
            var leadid = document.getElementById("leadid").value;
            $.ajax({
                type: 'POST',
                url: 'editlead_process.php',

                data: 'Title=' + Title + '&FirstName=' + FirstName + '&LastName=' + LastName + '&mcode1=' + mcode1 + '&mob1=' + mob1 + '&Contact1code=' + Contact1code + '&Contact1=' + Contact1 + '&Contact2code=' + Contact2code + '&Contact2=' + Contact2 + '&Contact3code=' + Contact3code + '&Contact3=' + Contact3 + '&Country=' + Country + '&state=' + state + '&City=' + City + '&Nationality=' + Nationality + '&Company=' + Company + '&Designation=' + Designation + '&Gmail=' + Gmail + '&Relationship=' + Relationship + '&Facebook=' + Facebook + '&leadid=' + leadid,

                success: function (msg) {


                    //alert(msg);
                    if (msg == 1) {
                        swal("successfully Updated");
                        window.open("viewlead.php", "_self");
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

                            <input type="text" name="leadid" id="leadid" value="<?php echo $leadid; ?>" />
                            <h1>Edit Lead Entry</h1>

                            <fieldset>

                                <label><b>Title:</b></label>
                                <select class="rounded" name="Title" id="Title">
                                    <option value="<?php echo $row['Title']; ?>"><?php echo $row['Title']; ?></option>
                                    <option value="1">Title1</option>
                                    <option value="2">Title2</option>
                                </select>
                                <label for="name"><b>First Name :</b></label>
                                <input type="text" id="FirstName" name="FirstName" placeholder="First Name"
                                    value="<?php echo $row['FirstName']; ?>">

                                <label for="name"><b>Last Name :</b></label>
                                <input type="text" id="LastName" name="LastName" placeholder="Last Name"
                                    value="<?php echo $row['LastName']; ?>">

                                <label for="mobile"><b>Mobile code &nbsp;&nbsp;&nbsp;&nbsp; </b><b>Mobile number:</b>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="rounded" name="mcode1" id="mcode1" maxlength="3"
                                                onkeypress="return isNumber(event)" value="<?php echo $number0[0]; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="mob1" name="mob1" maxlength="10"
                                                onkeypress="return isNumber(event)" placeholder="Mobile number"
                                                value="<?php echo $number0[1]; ?>">
                                        </div>
                                    </div>
                                </label>

                                <label for="mobile"><b>Contact 1 &nbsp;&nbsp;&nbsp;&nbsp; </b><b>Contact 1 :</b>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="rounded" name="Contact1code" id="Contact1code"
                                                onkeypress="return isNumber(event)" maxlength="3"
                                                value="<?php echo $number1[0]; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="Contact1" name="Contact1" maxlength="10"
                                                onkeypress="return isNumber(event)" placeholder="Contact 1"
                                                value="<?php echo $number1[1]; ?>">
                                        </div>
                                    </div>
                                </label>

                                <label for="mobile"><b>Contact 2 &nbsp;&nbsp;&nbsp;&nbsp; </b><b>Contact 2 :</b>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="rounded" name="Contact2code" id="Contact2code"
                                                onkeypress="return isNumber(event)" maxlength="3"
                                                value="<?php echo $number2[0]; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="Contact2" name="Contact2" maxlength="10"
                                                onkeypress="return isNumber(event)" placeholder="Contact 2"
                                                value="<?php echo $number2[1]; ?>">
                                        </div>
                                    </div>
                                </label>

                                <label for="mobile"><b>Contact 3 &nbsp;&nbsp;&nbsp;&nbsp; </b><b>Contact 3 :</b>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="rounded" name="Contact3code" id="Contact3code"
                                                onkeypress="return isNumber(event)" maxlength="3"
                                                value="<?php echo $number3[0]; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="Contact3" name="Contact3" maxlength="10"
                                                onkeypress="return isNumber(event)" placeholder="Contact 3"
                                                value="<?php echo $number3[1]; ?>">
                                        </div>
                                    </div>
                                </label>


                                <label for="state"><b>Country:</b></label>
                                <select class="rounded" name="Country" id="Country">
                                    <option value="<?php echo $row['Country']; ?>"><?php echo $row['Country']; ?>"
                                    </option>
                                    <?php

                                    $abc1 = "select * from Contry ";
                                    $runabc1 = mysqli_query($conn, $abc1);
                                    while ($fetch1 = mysqli_fetch_array($runabc1)) { ?>
                                        <option value="<?php echo $row['state_id']; ?>"><?php echo $row['state'] ?></option>
                                    <?php } ?>
                                </select>

                                <label for="state"><b>State:</b></label>
                                <select class="rounded" name="state" id="state" onchange="modelnos()">
                                    <option value="<?php echo $row['State']; ?>"><?php echo $sqlfetch[0]; ?></option>
                                    <?php

                                    $abc = "select * from state ";

                                    $runabc = mysqli_query($conn, $abc);
                                    while ($fetch = mysqli_fetch_array($runabc)) { ?>
                                        <option value="<?php echo $fetch['state_id']; ?>"><?php echo $fetch['state'] ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <label for="City"><b>City:</b></label>
                                <select class="rounded" name="City" id="City">
                                    <option value="<?php echo $row['City']; ?>"><?php echo $row['City']; ?></option>
                                </select>

                                <label for="board"><b>Nationality:</b></label><label id="label6"></label>
                                <select name="Nationality" id="Nationality" class="rounded">
                                    <option value="<?php echo $row['Nationality']; ?>"><?php echo $row['Nationality']; ?>
                                    </option>
                                    <option value='Indian'>Indian</option>
                                    <option value='African'>African</option>
                                    <option value='Christian'>Christian</option>
                                </select>

                                <label for="mail"><b>Company:</b></label>
                                <input type="text" id="Company" name="Company" placeholder="Company Name"
                                    value="<?php echo $row['Company']; ?>">

                                <label for="mail"><b>Designation:</b></label>
                                <input type="text" id="Designation" name="Designation" placeholder="Designation"
                                    value="<?php echo $row['Designation']; ?>">

                                <label for="mail"><b>Gmail</b></label>
                                <input type="text" id="Gmail" name="Gmail" placeholder="Email ID"
                                    value="<?php echo $row['EmailId']; ?>">

                                <label for="mail"><b>Facebook ID</b></label>
                                <input type="text" id="Facebook" name="Facebook" placeholder="Facebook ID"
                                    value="<?php echo $row['FacebookId']; ?>">

                                <label for="mail"><b>Relationship Status :</b></label>
                                <input type="text" id="Relationship" name="Relationship"
                                    placeholder="Relationship Status" value="<?php echo $row['DelegationStatus']; ?>">
                                <center>
                                    <button type="button" onclick="validation()"
                                        style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">Update</button>
                                </center></br>


                        </form>

                </div>
            </div>

        </div>
    </div>


</body>

</html>
<?php //echo $abc; ?>