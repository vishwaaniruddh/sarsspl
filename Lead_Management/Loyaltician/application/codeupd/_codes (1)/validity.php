<?php Session_Start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('header.php');
    include ('config.php');
    $id = $_GET['id'];
    $sql = "select * from validity where validity_id='" . $id . "'";
    $runsql = mysqli_query($conn, $sql);
    $fetch1 = mysqli_fetch_array($runsql);

    $sql2 = "select * from Program where Program_ID='" . $fetch1['Program_ID'] . "'";
    $runsql2 = mysqli_query($conn, $sql2);
    $programname = mysqli_fetch_array($runsql2);

    $sql3 = "select * from Level where Leval_id='" . $fetch1['Leval_id'] . "'";
    $runsql3 = mysqli_query($conn, $sql3);
    $levelname = mysqli_fetch_array($runsql3);
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
                    $('#Level').empty();

                    for (var i = 0; i < jsr.length; i++) {


                        //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                        newoption += '<option id=' + jsr[i]["ids"] + ' value=' + jsr[i]["ids"] + '   >' + jsr[i]["levelname"] + '</option> ';


                    }
                    $('#Level').append(newoption);

                }
            })

        }



        function validation() {
            var Program = document.getElementById("Program").value;
            var Level = document.getElementById("Level").value;

            if (Program == "") {
                swal("Please select Program ");
                return false;
            }
            else if (Level == "") {
                swal("Please enter Level ");
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

                            <h4 class=""> Validity Creation
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
                                    Validity Entry
                                </h5>
                                <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                            </div>
                            <form method="post" action="validity_Process.php" enctype="multipart/form-data"
                                onsubmit="return validation()">
                                <input type="hidden" name="mainid" id="mainid" value="<?php echo $id ?>" />

                                <div class="card-body ">
                                    <div class="form-group">
                                        <label for="inputAddress">Program Name</label>&nbsp;
                                        <select class="form-control" name="Program" id="Program" onfocus="setProgram();"
                                            onchange="levelSet()" <?php if ($id != "") { ?>disabled<?php } ?> required>

                                            <?php if ($id != "") { ?>
                                                <option value="<?php echo $programname['Program_ID']; ?>">
                                                    <?php echo $programname['Progam_name'] ?>
                                                </option>
                                            <?php } else { ?>
                                                <option value="">Select Program * </option>
                                            <?php } ?>

                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Program Level</label>&nbsp;
                                        <select class="form-control" name="Level" id="Level" <?php if ($id != "") { ?>disabled<?php } ?> required>
                                            <?php if ($id != "") { ?>
                                                <option value="<?php echo $levelname['Leval_id']; ?>">
                                                    <?php echo $levelname['level_name'] ?>
                                                </option>
                                            <?php } else { ?>
                                                <option value="">Select Level * </option>
                                            <?php } ?>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Expiry Month</label>&nbsp;
                                        <select class="form-control" name="Month" id="Month" required>
                                            <option value="">Select Month *</option>
                                            <?php
                                            $count = 1;
                                            for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="<?php echo $i; ?>" id="<?php echo $i; ?>" <?php if ($id != "" && $fetch1['Expiry_month'] == $i) { ?>Selected<?php } ?>><?php echo $i; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                    </div>





                                    <br />
                                    <div class="form-group">
                                        <?php if ($id != "") { ?>
                                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        <?php } ?>

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