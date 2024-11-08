<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('header.php'); ?>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }



        var bool = false;
        function chkmailexs() {


            var email = document.getElementById('email').value;

            if (email != "") {

                var exs = "0";
                //alert(email);
                $.ajax({

                    type: 'POST',
                    url: 'checkemail.php',
                    data: 'email=' + email + '&Table=' + 'HotelUsers' + '&column=' + 'emailid',

                    /* error: function() {
                        
                     },*/

                    success: function (data) {

                        //alert(data);

                        if (data == "1") {

                            document.getElementById("label3").innerHTML = "Email id Already Exists !";
                            document.getElementById("label3").style.color = "Red";
                            document.getElementById('email').focus();
                            bool = false;
                        }
                        else {
                            document.getElementById("label3").innerHTML = "";
                            bool = true;
                        }

                    }
                    /*,error: function (data) {
                              bool = false;
                          }*/

                });

            }
            /*else
            {
            bool = true;
            
            }*/

            return bool;
        }


        var bool1 = false;
        function chkmobile() {
            var mob = document.getElementById('mob').value;

            if (mob != "") {
                $.ajax({
                    type: 'POST',
                    url: 'checkMobile.php',
                    async: false,
                    data: 'mob=' + mob + '&Table=' + 'HotelUsers' + '&column=' + 'mobile',
                    success: function (data) {
                        //alert(data);
                        if (data == "1") {
                            swal("Mobile Number Already Exists");
                            document.getElementById("label5").innerHTML = "Mobile Number Already Exists !";
                            document.getElementById("label5").style.color = "Red";
                            //document.getElementById('mob').focus();
                            bool1 = false;
                        }
                        else {
                            document.getElementById("label5").innerHTML = "";
                            bool1 = true;
                        }

                    }

                });

            }

            return bool1;

        }



        function validation() {


            var name = document.getElementById('name').value;

            var lname = document.getElementById('lname').value;
            var mob = document.getElementById('mob').value;
            var Department = document.getElementById('Department').value;
            var email = document.getElementById('email').value;


            var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            if (name == "") {
                swal("Enter Your Hotel Name!");
                document.getElementById("label1").innerHTML = "Enter Your Hotel Name !";
                document.getElementById("label1").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label1").innerHTML = "";
            }

            if (lname == "") {
                swal("Enter Your Name !");
                document.getElementById("label2").innerHTML = "Enter Your Name !";
                document.getElementById("label2").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label2").innerHTML = "";
            }

            if (Department == "") {
                swal("Enter  Department Name!");
                document.getElementById("label6").innerHTML = "Enter  Department Name!";
                document.getElementById("label6").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label6").innerHTML = "";
            }


            if (email == "") {
                swal("Enter Your Email !");
                document.getElementById("label3").innerHTML = "Enter Your Email !";
                document.getElementById("label3").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label3").innerHTML = "";
            }

            if (!re.test(email)) {
                swal("Enter Your Valid Email !");
                document.getElementById("label3").innerHTML = "Enter Your Valid Email !";
                document.getElementById("label3").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label3").innerHTML = "";
            }


            if (mob == "") {
                swal("Enter Your Mobile No. !");
                document.getElementById("label5").innerHTML = "Enter Your Mobile No. !";
                document.getElementById("label5").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label5").innerHTML = "";
            }
            if (mob.length <= 9) {
                swal("Please Enter 10 Digits Mobile Number !");
                document.getElementById("label5").innerHTML = "Please Enter 10 Digits Mobile Number !";
                document.getElementById("label5").style.color = "Red";

                return false;
            }
            else {
                document.getElementById("label5").innerHTML = "";
            }


            return true;


        }


        function sumitfunc() {

            if (validation()) {
                if (chkmobile()) {
                    if (chkmailexs()) {

                        document.getElementById('mydata').submit();
                        return true;

                    }
                }
            }
        }




        /*
        function sumitfunc()
        {
           // alert(chkmailexs())
        //    alert(chkmobile())
          //  alert(validation())
            
            if(chkmailexs())
            
        {
            if(chkmobile())
            {
        if(validation())
        {
        //document.getElementById('mydata').submit();
        return true;
        }
        else{
            return false;
        }
        
        }else{return false;}
        }else{return false;}
        }
        */


    </script>

</head>

<body class="jumbo-page">

    <main class="admin-main  ">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4  bg-white">
                    <div class="row align-items-center m-h-100">
                        <div class="mx-auto col-md-8">
                            <form name="mydata" id="mydata" method="post" class="needs-validation"
                                action="process_reg.php" onsubmit="return">
                                <?php include ('logo.php'); ?>
                                <h3 class="text-center p-b-20 fw-400">Register</h3>

                                <div class="form-row">

                                    <div class="form-group floating-label col-md-12">
                                        <label id="label1">Hotel Name</label>
                                        <!--  <input type="text" required class="form-control" id="name" name="name" style="text-align: center" placeholder="Hotel Name *">-->
                                        <select class="form-control" id="name" name="name" required>
                                            <option value="">Select Hotel Name *</option>
                                            <option value="The Orchid Hotel Pune">The Orchid Hotel Pune</option>
                                            <option value="Fort Jadhav Gadh">Fort Jadhav Gadh</option>
                                        </select>
                                    </div>


                                    <div class="form-group floating-label col-md-12">
                                        <label id="label2">Employee Name</label>
                                        <input type="text" required class="form-control " id="lname" name="lname"
                                            style="text-align: center" placeholder="Employee Name *">
                                    </div>
                                </div>

                                <div class="form-group floating-label">
                                    <label id="label4">Employee Number</label>
                                    <input type="text" class="form-control" id="enumber" name="enumber" maxlength="10"
                                        onkeypress="return isNumber(event)" style="text-align: center"
                                        placeholder="Employee Number">

                                </div>

                                <div class="form-group floating-label">
                                    <label id="label6">Department</label>
                                    <input type="text" class="form-control" id="Department" name="Department"
                                        style="text-align: center" placeholder="Department*">

                                </div>

                                <div class="form-group floating-label">
                                    <label id="label3">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        onblur="chkmailexs();" style="text-align: center" placeholder="Email *">
                                </div>

                                <div class="form-group floating-label">
                                    <label id="label5">Mobile Number</label>
                                    <input type="text" class="form-control" placeholder="Mobile Number*" id="mob"
                                        name="mob" maxlength="10" onkeypress="return isNumber(event)"
                                        onblur="chkmobile();" style="text-align: center">
                                </div>

                                <!--<p class="">
                                <label class="cstm-switch">
                                    <input type="checkbox" checked name="option" value="1" class="cstm-switch-input">
                                    <span class="cstm-switch-indicator "></span>
                                    <span class="cstm-switch-description">  I agree to the Terms and Privacy. </span>
                                </label>


                            </p>-->

                                <button type="button" onClick="sumitfunc()"
                                    class="btn btn-primary btn-block btn-lg">Create Account</button>

                            </form>
                            <p class="text-right p-t-10">
                                <a href="login.php" class="text-underline">Already a user?</a>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('assets/img/auth.svg');">

                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog"
        aria-labelledby="siteSearchModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body p-all-0" id="site-search">
                    <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots">
                        <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                        <div class="container-fluid">
                            <div class="col-md-10 p-t-10 m-auto">
                                <input type="search" placeholder="Search Something"
                                    class=" search form-control form-control-lg">

                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                            results
                        </div>
                        <div class="list-group list  ">


                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                            src="assets/img/users/user-3.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Eric Chen</div>
                                    <div class="text-muted">Developer</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                            src="assets/img/users/user-4.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Sean Valdez</div>
                                    <div class="text-muted">Marketing</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                            src="assets/img/users/user-8.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Marie Arnold</div>
                                    <div class="text-muted">Developer</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-pdf"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">SRS Document</div>
                                    <div class="text-muted">25.5 Mb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">Design Guide.pdf</div>
                                    <div class="text-muted">9 Mb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm  ">
                                            <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">response.json</div>
                                    <div class="text-muted">15 Kb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm ">
                                            <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">June Accounts.xls</div>
                                    <div class="text-muted">6 Mb</div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/vendor/popper/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/listjs/listjs.min.js"></script>
    <script src="assets/vendor/moment/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/atmos.min.js"></script>
    <!--page specific scripts for demo-->
    <script src="assets/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="assets/js/form-validate.js"></script>
</body>

</html>