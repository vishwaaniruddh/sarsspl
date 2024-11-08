<?php Session_Start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>


    <?php include ('header.php');
    include ('config.php');
    $Mainid = $_GET['id'];
    if ($Mainid != "") {


        $QuryGetMem = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Mainid . "'");
        $fetchMem = mysqli_fetch_array($QuryGetMem);

        $QuryGetLead = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Mainid . "'");
        $fetchLead = mysqli_fetch_array($QuryGetLead);

        $HOtelNameChk = $fetchLead['Hotel_Name'];


        $QuryDelegate = mysqli_query($conn, "select * from LeadDelegation where LeadId='" . $Mainid . "'");
        $fetchDelegate = mysqli_fetch_array($QuryDelegate);
        if ($QuryDelegate) {
            $QurySalesmanId = mysqli_query($conn, "select * from SalesAssociate where SalesmanId='" . $fetchDelegate['SalesmanId'] . "'");
            $fetchSalesmanId = mysqli_fetch_array($QurySalesmanId);
        }

        $QuryLead_Sources = mysqli_query($conn, "SELECT * FROM `Lead_Sources` where SourceId='" . $fetchLead['LeadSource'] . "' and Active='YES'");
        $fetchLead_Sources = mysqli_fetch_array($QuryLead_Sources);


        /*
        $QuryState=mysqli_query($conn,"select * from state where state_id='".$fetchLead['State']."'");
        $fetchState=mysqli_fetch_array($QuryState);*/
    }
    ?>



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

                            <h4 class=""> Void Member
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
                    <div class="col-lg-12">

                        <!--widget card begin-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    Void Member
                                </h5>
                                <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                            </div>


                            <?

                            $id = $_POST['id'];
                            $void_reason = $_POST['void_reason'];

                            $statement = "update Members set void=1 ,void_reason='" . $void_reason . "' where Static_LeadID='" . $id . "'";

                            if (mysqli_query($conn, $statement)) { ?>

                                <script>
                                    swal("success", "Successfullly Done !", 'success');
                                    setTimeout(function () {

                                        window.location.href = "MemberEdit.php?id=<?php echo $id; ?>";

                                    }, 3000);

                                </script>

                            <?php } else { ?>
                                <script>
                                    swal("error", "Not Done !", 'error');
                                    setTimeout(function () {

                                        window.location.href = "MemberEdit.php?id=<?php echo $id; ?>";

                                    }, 3000);


                                </script>
                            <?php } ?>



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

</body>
You have made no changes to save.

</html>