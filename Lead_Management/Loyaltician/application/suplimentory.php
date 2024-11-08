<?php Session_Start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('header.php');
    include ('config.php'); ?>

    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }


        $(function () {
            $("#Spouse_DOB").datepicker();
            $("#Spouse_DOB").datepicker("option", "dateFormat", "dd-mm-yy");
            $("#Spouse_DOB").datepicker("option", "showAnim", "fold");

        });
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

                            <h4 class=""> New Member
                            </h4>
                            <!-- <p class="opacity-75 ">
                            Examples for form control styles, layout options, and custom components for
                            creating a wide variety of forms elements.
                            <br>
                            we have included dropzone for file uploads, datepicker and select2 for custom controls.
                        </p>-->


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
                                    Suplimentory Member
                                </h5>
                                <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                            </div>


                            <form method="POST" style="padding-left: 9px;padding-right: 9px;"
                                action="suplimentoryMem_Process.php" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="inputEmail4">Member ID</label>
                                    <input type="text" class="form-control" id="Spouse_Memberid" name="Spouse_Memberid"
                                        onblur="chk_memberId()" placeholder="Enter Member ID *">
                                </div>

                                <div id="hd_form" style="display:none">



                                    <input type="hidden" class="form-control" id="Spouse_Level" name="Spouse_Level"
                                        placeholder="Level *" readonly>



                                    <div class="form-group">
                                        <label for="inputAddress2">Title</label>
                                        <select class="form-control" name="Spouse_Title" id="Spouse_Title" required>
                                            <option value="">Select Title</option>
                                            <?php
                                            $titleQry = "select * from Title ";
                                            $runTitle = mysqli_query($conn, $titleQry);
                                            while ($fetchTitle = mysqli_fetch_array($runTitle)) { ?>
                                                <option value="<?php echo $fetchTitle['titleName']; ?>">
                                                    <?php echo $fetchTitle['titleName']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control" id="Spouse_FirstName"
                                                name="Spouse_FirstName" placeholder="First Name *" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control" id="Spouse_LastName"
                                                name="Spouse_LastName" placeholder="Last Name *" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Relationship</label>
                                            <input type="text" class="form-control" id="Spouse_Relationship"
                                                name="Spouse_Relationship" placeholder="Relationship *">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Date Of Birth</label>
                                            <input type="text" class="form-control" id="Spouse_DOB" name="Spouse_DOB"
                                                placeholder="dd-mm-yyyy*">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                        <input type="email" class="form-control" id="Spouse_GmailMArrid1"
                                            name="Spouse_GmailMArrid1" placeholder="Email *">
                                    </div>



                                    <!-- <div class="form-group ">
                                    <label for="inputPassword4">Photo Upload</label>
                                    <input type="file" class="form-control" id="Spouse_PhotoUpload" name="Spouse_PhotoUpload"   >
                                </div>-->
                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="inputEmail4">Mobile Code *</label>
                                            <input type="text" class="form-control" name="mcode1" id="mcode1"
                                                maxlength="3" value="+91" placeholder="eg. 91" required>
                                        </div>
                                        <div class="form-group col-md-8 col-sm-8">
                                            <label for="inputPassword4">Mobile number *</label>&nbsp;<label
                                                id="label5"></label>
                                            <input type="text" class="form-control" id="mob1" name="mob1" maxlength="10"
                                                placeholder="Mobile number" required>
                                        </div>
                                    </div>





                                    <div class="form-group ">
                                        <label for="inputPassword4">Name on the Card</label>
                                        <input type="text" class="form-control" id="Spouse_nameOnTheCardMarried"
                                            name="Spouse_nameOnTheCardMarried" maxlength="22"
                                            placeholder="22 Characters including spaces" required>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Payment Mode</label>
                                            <select class="form-control" name="MembershipDts_PaymentMode"
                                                id="MembershipDts_PaymentMode" onfocus="PaymentMode()" required>
                                                <option value="">Select Mode *</option>
                                                <?php
                                                $runLevel = mysqli_query($conn, "select * from Level");
                                                $fetchLevel = mysqli_fetch_array($runLevel);
                                                $runMode = mysqli_query($conn, "select * from MembershipPaymentMode where Program_ID='" . $fetchLevel['Program_ID'] . "'");
                                                while ($fetchMode = mysqli_fetch_array($runMode)) {
                                                    ?>
                                                    <option value="<?php echo $fetchMode['Payment_mode']; ?>">
                                                        <?php echo $fetchMode['Payment_mode']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Amount</label>
                                            <input type="text" class="form-control" id="Spouse_amount"
                                                name="Spouse_amount" placeholder="Amount *" required>
                                        </div>
                                    </div>


                                    <br /><br />


                                    <!--===================================== if Marital Status Married (end)================================-->


                                    <br />

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
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
    <?php include ('belowScript.php'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function chk_memberId() {
            var memid = document.getElementById("Spouse_Memberid").value;

            $.ajax({
                type: 'POST',
                url: 'chk_memid_json.php',
                data: 'memid=' + memid,
                datatype: 'json',
                success: function (msg) {

                    var jsr = JSON.parse(msg);

                    if (jsr.length > 0) {
                        $("#hd_form").show();
                        document.getElementById("Spouse_Level").value = jsr[0]["Level"];
                    } else {
                        $("#hd_form").hide();
                        swal("Member Id Wrong");
                    }


                }
            });
        }
    </script>
</body>
You have made no changes to save.

</html>