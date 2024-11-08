<?php session_start();
include ('config.php'); ?>
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

        function expfunc() {

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

<body class="sidebar-pinned" onload="searchfiltter('','')">


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
                                    <i class="mdi mdi-table "></i></span> Visits by Geography
                            </h4>


                        </div>
                    </div>
                </div>
            </div><br /><br /><br />
            <!-- <form  method="post" id="formf" action="delegation.php">-->
            <form>
                <div class="container  pull-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">



                                <div class="card-body">





                                    <div class="form-row">


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





                                        <input type="button" class="btn btn-primary"
                                            style="height:30px;margin-top: 24px;padding-top: 2px;"
                                            onclick="searchfiltter('','')" value="Search">


                                    </div>

                                    <div class="table-responsive p-t-10">
                                        <div id="example1"></div>

                                    </div>

                                    <br />
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


            var fromDt = document.getElementById('fromDt').value;
            var ToDt = document.getElementById('ToDt').value;
            perp = perpg;

            var Page = "";
            if (strPage != "") {
                Page = strPage;
            }


            $.ajax({
                type: 'POST',
                url: 'FandB_Report6_search.php',
                data: 'Page=' + Page + '&perpg=' + perp + '&FromDt=' + fromDt + '&ToDt=' + ToDt,
                success: function (msg) {
                    //alert(msg);
                    document.getElementById("example1").innerHTML = msg;

                    test();


                }
            })


        }

        function test() {
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