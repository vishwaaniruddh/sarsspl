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
                                        <select class="form-control" name="Spouse_Title" id="Spouse_Title">
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
                                                name="Spouse_FirstName" placeholder="First Name *">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control" id="Spouse_LastName"
                                                name="Spouse_LastName" placeholder="Last Name *">
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label for="inputAddress">Email</label>&nbsp;<label id="label3"></label>
                                        <input type="email" class="form-control" id="Spouse_GmailMArrid1"
                                            name="Spouse_GmailMArrid1" placeholder="Email *">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Email-ID (Gmail)</label>&nbsp;<label
                                            id="label3"></label>
                                        <input type="email" class="form-control" id="Spouse_GmailMArrid2"
                                            name="Spouse_GmailMArrid2" placeholder="Email-id (Gmail) *">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputPassword4">Photo Upload</label>
                                        <input type="file" class="form-control" id="Spouse_PhotoUpload"
                                            name="Spouse_PhotoUpload">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="inputEmail4">Mobile Code *</label>
                                            <input type="text" class="form-control" name="Spouse_mcode1Married1"
                                                id="Spouse_mcode1Married1" maxlength="3" value="+91"
                                                placeholder="eg. 91">
                                        </div>
                                        <div class="form-group col-md-8 col-sm-8">
                                            <label for="inputPassword4">Mobile number *</label>&nbsp;<label
                                                id="label5"></label>
                                            <input type="text" class="form-control" id="Spouse_mob1MArid1"
                                                name="Spouse_mob1MArid1" maxlength="10" placeholder="Mobile number">
                                        </div>
                                    </div>



                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="inputEmail4">Mobile Code *</label>
                                            <input type="text" class="form-control" name="Spouse_mcode1Married2"
                                                id="Spouse_mcode1Married2" maxlength="3" value="+91"
                                                placeholder="eg. 91">
                                        </div>
                                        <div class="form-group col-md-8 col-sm-8">
                                            <label for="inputPassword4">Mobile number *</label>&nbsp;<label
                                                id="label5"></label>
                                            <input type="text" class="form-control" id="Spouse_mob1MArid2"
                                                name="Spouse_mob1MArid2" maxlength="10" placeholder="Mobile number">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="inputEmail4">Contact1 Code</label>
                                            <input type="text" class="form-control" name="Spouse_Contact1codeMArid"
                                                id="Spouse_Contact1codeMArid" maxlength="3" value="022"
                                                placeholder="eg. 022">
                                        </div>
                                        <div class="form-group col-md-8 col-sm-8">
                                            <label for="inputPassword4">Contact1 Number</label>
                                            <input type="text" class="form-control" id="Spouse_Contact1Married"
                                                name="Spouse_Contact1Married" maxlength="10"
                                                placeholder="Contact1 For Married">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="inputEmail4">Contact2 Code</label>
                                            <input type="text" class="form-control" name="Spouse_Contact2codeMArid"
                                                id="Spouse_Contact2codeMArid" value="022" maxlength="3"
                                                placeholder="eg. 022">
                                        </div>
                                        <div class="form-group col-md-8 col-sm-8">
                                            <label for="inputPassword4">Contact2 Number</label>
                                            <input type="text" class="form-control" id="Spouse_Contact2Married"
                                                name="Spouse_Contact2Married" maxlength="10"
                                                placeholder="Contact Number">
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="inputPassword4">Name on the Card</label>
                                        <input type="text" class="form-control" id="Spouse_nameOnTheCardMarried"
                                            name="Spouse_nameOnTheCardMarried" maxlength="22"
                                            placeholder="22 Characters including spaces">
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
                    //alert(jsr.length)
                    var jsr = JSON.parse(msg);

                    if (jsr.length > 0 && jsr[0]["SpouseGmail"] == "" && jsr[0]["Level"] != "") {
                        $("#hd_form").show();
                        document.getElementById("Spouse_Level").value = jsr[0]["Level"];
                    } else {
                        $("#hd_form").hide();

                        if (jsr.length > 0) {
                            if (jsr[0]["SpouseGmail"] != "" && jsr[0]["Level"] != "") {
                                swal("Spouse Details allready exist");
                            }
                        } else {


                            swal("Member Id Wrong");
                        }
                    }


                }
            });
        }
    </script>
</body>
You have made no changes to save.

</html>