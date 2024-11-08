<?php Session_Start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('header.php');
    include ('config.php');
    ?>

    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

    </script>

    <script>
        function setHotel() {


            var Brand = document.getElementById("Brand").value;

            $.ajax({

                type: 'POST',
                url: 'setHotel.php',
                data: 'Brand=' + Brand,
                datatype: 'json',
                success: function (msg) {
                    //alert(msg);
                    var jsr = JSON.parse(msg);
                    //alert(jsr.length);
                    var newoption = ' <option value="">Select Hotel</option>';
                    $('#Hotel').empty();

                    for (var i = 0; i < jsr.length; i++) {

                        newoption += '<option id=' + jsr[i]["hotel_id"] + ' value=' + jsr[i]["hotel_id"] + '>' + jsr[i]["Hotel_Name"] + '</option> ';
                    }
                    $('#Hotel').append(newoption);

                }
            })



        }

        function modelnos() {
            var state = document.getElementById("state").value;

            $.ajax({
                type: 'POST',
                url: 'city.php',
                data: 'state=' + state,
                datatype: 'json',
                success: function (msg) {
                    //alert(msg);
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




        function validation() {
            var Program = document.getElementById("Program").value;
            var HotelName = document.getElementById("HotelName").value;

            if (Program == "") {
                swal("Please select Program ");
                return false;
            }
            else if (HotelName == "") {
                swal("Please enter Hotel Name ");
                return false;
            }
            else {
                return true;
            }

        }

    </script>



</head>

<body class="sidebar-pinned">

    <?php include ("vertical_menu.php") ?>


    <main class="admin-main">
        <!--site header begins-->
        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">
                            <h4 class=""> User Creation</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container  pull-up">
                <div class="row">
                    <div class="col-lg-6">

                        <!--widget card begin-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    User Entry
                                </h5>
                                <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                            </div>
                            <form method="post" action="user_process.php" onsubmit="return validation()">
                                <div class="card-body ">

                                    <div class="form-group">
                                        <label for="inputAddress">User Role</label>&nbsp;
                                        <select class="form-control" name="roll" id="roll" required>
                                            <option value=" ">Select Role *</option>
                                            <?php

                                            $abc = "select * from roll ";

                                            $runabc = mysqli_query($conn, $abc);
                                            while ($fetch = mysqli_fetch_array($runabc)) { ?>
                                                <option value="<?php echo $fetch['id']; ?>"><?php echo $fetch['roll'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control" id="FirstName" name="FirstName"
                                                placeholder="First Name *" required="true">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control" id="LastName" name="LastName"
                                                placeholder="Last Name *" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Designation</label>
                                            <input type="text" class="form-control" id="Designation" name="Designation"
                                                placeholder="Designation *" required="true">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">User Level</label>
                                            <input type="text" class="form-control" id="UserLevel" name="UserLevel"
                                                placeholder="User Level *" required>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail4">Address</label>
                                        <input type="text" class="form-control" id="Address" name="Address"
                                            placeholder="Address *" required="true">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">state</label>
                                            <select name="state" id="state" class="form-control" onchange="modelnos()">
                                                <option value=" ">Select State</option>
                                                <?php

                                                $abc = "select * from state ";

                                                $runabc = mysqli_query($conn, $abc);
                                                while ($fetch = mysqli_fetch_array($runabc)) { ?>
                                                    <option value="<?php echo $fetch['state_id']; ?>">
                                                        <?php echo $fetch['state'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">City</label>
                                            <select class="form-control" name="City" id="City">
                                                <option value=" ">Select City</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Pincode</label>
                                            <input type="text" class="form-control" id="Pincode" name="Pincode"
                                                placeholder="Pincode *" onkeypress="return isNumber(event)"
                                                maxlength="7" required="true">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Contact No</label>
                                            <input type="text" class="form-control" id="ContactNo" name="ContactNo"
                                                placeholder="Contact No *" onkeypress="return isNumber(event)"
                                                maxlength="10" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Location</label>
                                            <input type="text" class="form-control" id="Location" name="Location"
                                                placeholder="Location *" required="true">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Company</label>
                                            <input type="text" class="form-control" id="Company" name="Company"
                                                placeholder="Company *" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Brand</label>
                                            <select class="form-control" name="Brand" id="Brand" onchange="setHotel()"
                                                required>
                                                <option value=" ">Select Brand *</option>
                                                <?php

                                                $abc = "select * from Brand";

                                                $runabc = mysqli_query($conn, $abc);
                                                while ($fetch = mysqli_fetch_array($runabc)) { ?>
                                                    <option value="<?php echo $fetch['Brand_id']; ?>">
                                                        <?php echo $fetch['Brand_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Hotel</label>
                                            <select class="form-control" name="Hotel" id="Hotel">
                                                <option value=" ">Select Hotel</option>
                                            </select>
                                        </div>
                                    </div>




                                    <br /> <br />
                                    <div class="form-group">
                                        <label for="inputAddress">User Name</label>&nbsp;
                                        <input type="text" class="form-control" id="UserName" name="UserName"
                                            placeholder="User Name *" required>

                                    </div>


                                    <div class="form-group">
                                        <label for="inputAddress">Password</label>&nbsp;
                                        <input type="password" class="form-control" id="Password" name="Password"
                                            placeholder="Password *" required>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--widget card ends-->




                    </div>

                </div>


            </div>
        </section>
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
                    </div>Form Control Sizes

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
</body>

</html>