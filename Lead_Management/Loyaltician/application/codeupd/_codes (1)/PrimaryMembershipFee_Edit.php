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



        function setProgram() {


            $.ajax({
                type: 'POST',
                url: 'setProgram.php',
                data: '',
                datatype: 'json',
                success: function (msg) {
                    //alert(msg);
                    var jsr = JSON.parse(msg);

                    var newoption = ' <option value="">Select Program *</option>';
                    $('#Program').empty();

                    for (var i = 0; i < jsr.length; i++) {


                        //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                        newoption += '<option id=' + jsr[i]["Program_ID"] + ' value=' + jsr[i]["Program_ID"] + '   >' + jsr[i]["Progam_name"] + '</option> ';


                    }
                    $('#Program').append(newoption);

                }
            })

        }



        function levelSet() {

            var Program = document.getElementById("Program").value;
            //alert(state);
            $.ajax({
                type: 'POST',
                url: 'levelset.php',
                data: 'Program=' + Program,
                datatype: 'json',
                success: function (msg) {
                    //alert(msg);
                    var jsr = JSON.parse(msg);

                    var newoption = ' <option value="">Select Level *</option>';
                    $('#P_Level').empty();

                    for (var i = 0; i < jsr.length; i++) {


                        //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                        newoption += '<option id=' + jsr[i]["ids"] + ' value=' + jsr[i]["ids"] + '   >' + jsr[i]["levelname"] + '</option> ';


                    }
                    $('#P_Level').append(newoption);

                }
            })

        }





        function validation() {
            var Program = document.getElementById("Program").value;
            var P_Level = document.getElementById("P_Level").value;
            var NewMembership = document.getElementById("NewMembership").value;
            var RenewalMembership = document.getElementById("RenewalMembership").value;
            var gst = document.getElementById("gst").value;

            if (Program == "") {
                swal("Please Select Program ");
                return false;
            }
            else if (P_Level == "") {
                swal("Please select level");
                return false;
            }
            else if (NewMembership == "") {
                swal("Please Enter NewMembership Fee");
                return false;
            }
            else if (RenewalMembership == "") {
                swal("Please Enter RenewalMembership Fee");
                return false;
            }
            else if (gst == "") {
                swal("Please select GST");
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

                            <h4 class=""> Primary Membership Fee Edit
                            </h4>


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
                                    Primary Membership Fee Edit
                                </h5>
                                <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                            </div>
                            <?php
                            $id = $_GET['id'];
                            $Qdt = mysqli_query($conn, "SELECT * FROM `PrimaryMembershipFee` where MembershipFee_id='" . $id . "' ");
                            $Fdt = mysqli_fetch_array($Qdt);

                            $Qdt1 = mysqli_query($conn, "SELECT Progam_name FROM `Program` where Program_ID='" . $Fdt['Program_id'] . "' ");
                            $Fdt1 = mysqli_fetch_array($Qdt1);

                            $Qdt2 = mysqli_query($conn, "SELECT level_name FROM `Level` where Leval_id='" . $Fdt['P_Level_id'] . "' ");
                            $Fdt2 = mysqli_fetch_array($Qdt2);
                            ?>



                            <form method="post" action="PrimaryMembershipFee_Edit_process.php"
                                onsubmit="return validation()">
                                <div class="card-body ">
                                    <div class="form-group">
                                        <label for="inputAddress">Program Name</label>&nbsp;
                                        <input type="hidden" id="getid" name="getid" value="<?php echo $_GET['id']; ?>">
                                        <input type="text" class="form-control"
                                            value="<?php echo $Fdt1['Progam_name']; ?>" name="Program" id="Program"
                                            required readonly>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Program Level</label>&nbsp;

                                        <input type="text" class="form-control"
                                            value="<?php echo $Fdt2['level_name']; ?>" name="P_Level" id="P_Level"
                                            required readonly>

                                    </div>



                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">New Membership Fee</label>
                                            <input type="text" class="form-control" id="NewMembership"
                                                name="NewMembership" value="<?php echo $Fdt['NewMembership']; ?>"
                                                placeholder="New Membership Fee*" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Renewal Membership Fee</label>
                                            <input type="text" class="form-control" id="RenewalMembership"
                                                name="RenewalMembership" value="<?php echo $Fdt['RenewalMembership']; ?>"
                                                placeholder="Renewal Membership Fee*" required>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputAddress">GST %</label>&nbsp;
                                        <select class="form-control" name="gst" id="gst" required>
                                            <option value="">Select GST %</option>
                                            <option value="3" <?php if ($Fdt['GST'] == 3) { ?> Selected <?php } ?>> 3
                                            </option>
                                            <option value="5" <?php if ($Fdt['GST'] == 5) { ?> Selected <?php } ?>>5
                                            </option>
                                            <option value="12" <?php if ($Fdt['GST'] == 12) { ?> Selected <?php } ?>>12
                                            </option>
                                            <option value="18" <?php if ($Fdt['GST'] == 18) { ?> Selected <?php } ?>>18
                                            </option>
                                            <option value="25" <?php if ($Fdt['GST'] == 25) { ?> Selected <?php } ?>>25
                                            </option>
                                            <option value="28" <?php if ($Fdt['GST'] == 28) { ?> Selected <?php } ?>>28
                                            </option>

                                        </select>

                                    </div>


                                    <br />


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
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
</body>

</html>