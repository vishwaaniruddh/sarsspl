<?php session_start();
include ('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/datedropper/datedropper.min.css">
    <link rel="stylesheet" href="assets/vendor/dropzone/dropzone.css">
    <script>

        function expfunc() {//alert("hii")

            $('#formf').attr('action', 'delegation.php').attr('target', '_self');
            $('#formf').submit();


        }


        function toggle(source) {

            chkboxes = document.getElementsByName('check[]');
            for (var i = 0, n = chkboxes.length; i < n; i++) {
                chkboxes[i].checked = source.checked;

            }

        }




    </script>

</head>

<body class="sidebar-pinned" onload="searchfiltter('','')" id="rightclick">


    <?php include ("vertical_menu.php") ?>
    <main class="admin-main">
        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">

                            <h4 class=""> <span class="btn btn-white-translucent">
                                    <i class="mdi mdi-table "></i></span> View Prospect
                            </h4>


                        </div>
                    </div>
                </div>
            </div>
            <form method="post" id="formf" action="delegation.php">
                <div class="container  pull-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <?php include ("config.php");
                                //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
                                
                                if ($_SESSION['usertype'] == 'Admin' || $_SESSION['usertype'] == 'Fulfillment Team') {
                                    $View = "select * from Leads_table where Status!='3' ";
                                } else {
                                    $View = "select * from Leads_table where Status!='3' and leadEntryef='" . $_SESSION['id'] . "'";
                                }
                                $qrys = mysqli_query($conn, $View);

                                ?>



                                <div class="card-body">

                                    <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Leads </lable>
                                                <select class="form-control" name="Lead" id="Lead"
                                                    onchange="ddl_listStatus()">
                                                    <option value="1">All Leads</option>
                                                    <option value="2">Import Leads</option>
                                                </select>

                                        </div>

                                        <div class="form-group col-md-1">
                                            <label for="inputAddress2">Status </lable>
                                                <select class="form-control" name="LeadAllStatus" id="LeadAllStatus">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Open</option>
                                                    <option value="2">Close</option>
                                                    <option value="5">Member</option>
                                                </select>

                                                <select class="form-control" name="LeadImportStatus"
                                                    id="LeadImportStatus" style="display:none">
                                                    <option value="">Select Status</option>
                                                    <option value="1">No. Of Lead Import</option>
                                                    <option value="2">Duplicate Lead</option>
                                                    <option value="3">Final Import Count</option>
                                                </select>

                                        </div>



                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Lead Source
                                                <select class="form-control" name="Leadfilter" id="Leadfilter">
                                                    <option value="">Select Source</option>
                                                    <?php
                                                    $QuryLead_Sources = mysqli_query($conn, "SELECT * FROM `Lead_Sources` where Active='YES'");
                                                    while ($fetchLead_Sources = mysqli_fetch_array($QuryLead_Sources)) {
                                                        ?>
                                                        <option value="<?php echo $fetchLead_Sources['SourceId']; ?>">
                                                            <?php echo $fetchLead_Sources['Name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Lead Delegated</lable>
                                                <select class="form-control" name="LeadDelegated" id="LeadDelegated">
                                                    <option value="">Select Delegated</option>
                                                    <option value="1">Admin</option>
                                                    </option>
                                                    <?php
                                                    $QuryLead_Sources = mysqli_query($conn, "SELECT SalesmanId,FirstName FROM `SalesAssociate` ");
                                                    while ($fetchLead_Sources = mysqli_fetch_array($QuryLead_Sources)) {
                                                        ?>
                                                        <option value="<?php echo $fetchLead_Sources['SalesmanId']; ?>">
                                                            <?php echo $fetchLead_Sources['FirstName']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">From Date</lable>
                                                <input class="form-control datedropper" id="fromDt" name="fromDt"
                                                    data-large-mode="true" type="text">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">To Date</lable>
                                                <input class="form-control datedropper" id="ToDt" name="ToDt"
                                                    data-large-mode="true" type="text">
                                        </div>





                                        <input type="button" class="btn btn-primary" style="height:30px"
                                            onclick="searchfiltter('','')" value="Search">


                                    </div>

                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                        <div align="right"><button id="myButtonControlID" class="btn btn-primary"
                                                onClick="expfunc();">Delegate</button>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <lable>Checked All :-</lable><input type="checkbox" onClick="toggle(this)" />
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                        </div><?php } ?>


                                    <div class="table-responsive p-t-10">
                                        <!--<table id="example" class="table" style="width:100%"></table>-->
                                        <div id="example1"></div>

                                    </div> <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                        <div align="center"> <button id="myButtonControlID" class="btn btn-primary"
                                                onClick="expfunc();">Delegate</button></div><?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>

    </main>

    <?php include ('belowScript.php'); ?>
    <!--page specific scripts for demo-->
    <script src="assets/vendor/DataTables/datatables.min.js"></script>
    <script src="assets/js/datatable-data.js"></script>


    <script src="assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/vendor/datedropper/datedropper.min.js"></script>
    <script src="assets/vendor/dropzone/dropzone.js"></script>
    <script src="assets/vendor/jquery.mask/jquery.mask.min.js"></script>
    <script src="assets/js/form-data.js"></script>



    <!--====== this is for export to excel,pdf,copy --===================-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
    <!--====== this is for export to excel,pdf,copy --===================-->

    <script>

        function ddl_listStatus() {
            var Lead = document.getElementById('Lead').value;
            if (Lead == 1) {
                $('#LeadAllStatus').show();
                $('#LeadImportStatus').hide();
            } else if (Lead == 2) {
                $('#LeadAllStatus').hide();
                $('#LeadImportStatus').show();
            }


        }

        function searchfiltter(strPage, perpg) {

            var Lead = document.getElementById('Lead').value;
            var Leadfilter = document.getElementById('Leadfilter').value;
            var LeadDelegated = document.getElementById('LeadDelegated').value;
            var LeadAllStatus = document.getElementById('LeadAllStatus').value;
            var LeadImportStatus = document.getElementById('LeadImportStatus').value;
            var fromDt = document.getElementById('fromDt').value;
            var ToDt = document.getElementById('ToDt').value;

            if (Lead == 1) {
                var Status = LeadAllStatus;
            } else if (Lead == 2) {
                var Status = LeadImportStatus;
            }



            perp = perpg;

            var Page = "";
            if (strPage != "") {
                Page = strPage;
            }


            $.ajax({
                type: 'POST',
                url: 'Lead_search_Filtter.php',
                data: 'Page=' + Page + '&perpg=' + perp + '&Lead=' + Lead + '&Leadfilter=' + Leadfilter + '&LeadDelegated=' + LeadDelegated + '&Status=' + Status + '&fromDt=' + fromDt + '&ToDt=' + ToDt,
                success: function (msg) {
                    // alert(msg);
                    document.getElementById("example1").innerHTML = msg;

                    test();
                }
            })


        }

        function test() {
            //$('#example').DataTable();

            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });


        }


    </script>

</body>

</html>