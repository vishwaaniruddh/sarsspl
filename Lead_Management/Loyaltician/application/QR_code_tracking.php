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

        function toggle(source) {

            chkboxes = document.getElementsByName('check[]');
            for (var i = 0, n = chkboxes.length; i < n; i++) {
                chkboxes[i].checked = source.checked;

            }

        }


    </script>

</head>

<body class="sidebar-pinned" onload="ShowForm();" id="rightclick">

    <?php include ("vertical_menu.php") ?>
    <main class="admin-main">
        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-40">

                            <h4 class=""> <span class="btn btn-white-translucent">
                                    <i class="mdi mdi-table "></i></span> QR CODE TRACKING
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
                                            <label for="inputAddress2" style="text-align: center;">Search</lable>
                                                <select class="form-control" id="ddl_filter" name="ddl_filter"
                                                    onchange="ShowForm()">
                                                    <option value="">Select </option>
                                                    <option value="All">All Voucher Used</option>
                                                    <option value="SingleUser">Single User</option>
                                                </select>

                                        </div>




                                        <div class="form-row ">

                                            <div class="form-group AllUserId col-md-3">
                                                <label for="inputAddress2" style="text-align: center;">From Date</lable>
                                                    <input class="form-control js-datepicker" id="fromDt" name="fromDt"
                                                        data-large-mode="true" type="text">
                                            </div>

                                            <div class="form-group AllUserId col-md-3">
                                                <label for="inputAddress2" style="text-align: center;">To Date</lable>
                                                    <input class="form-control js-datepicker" id="ToDt" name="ToDt"
                                                        data-large-mode="true" type="text">
                                            </div>



                                            <div class="form-group AllUserId col-md-2">
                                                <input type="button" class="btn btn-primary"
                                                    style="height:30px;margin-top: 24px;padding-top: 2px;"
                                                    onclick="searchDatefiltter('','')" value="Search">

                                            </div>

                                            <div class="form-group col-md-2"></div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group SingleUserId col-md-6">
                                                <label for="inputAddress2" style="text-align: center;">Member ID</lable>
                                                    <input type="text" id="MemberId" name="MemberId"
                                                        class="form-control" placeholder="Enter Member Id " required>
                                            </div>

                                            <div class="form-group SingleUserId col-md-6">
                                                <label for="inputAddress2" style="text-align: center;">Member Name
                                                    </lable>
                                                    <input type="text" id="MemberName" name="MemberName"
                                                        class="form-control" placeholder="Enter Member Name" required>




                                            </div>

                                        </div>




                                        <div class="form-row">



                                            <div class="form-group SingleUserId col-md-2">
                                                <label for="inputAddress2" style="text-align: center;">Level</lable>
                                                    <input class="form-control " id="Level" name="Level"
                                                        data-large-mode="true" type="text" readonly>

                                            </div>

                                            <div class="form-group SingleUserId col-md-2">
                                                <label for="inputAddress2" style="text-align: center;">Membership
                                                    Validity</lable>
                                                    <input class="form-control " id="MembershipValidity"
                                                        name="MembershipValidity" data-large-mode="true" type="text"
                                                        readonly>
                                            </div>

                                            <div class="form-group SingleUserId col-md-2">
                                                <label for="inputAddress2" style="text-align: center;">Booklet Series
                                                    </lable>
                                                    <input class="form-control " id="Booklet" name="Booklet"
                                                        data-large-mode="true" type="text" readonly>
                                            </div>

                                            <div class="form-group SingleUserId col-md-2">
                                                <label for="inputAddress2" style="text-align: center;">Used</lable>
                                                    <input class="form-control " id="Used" name="Used"
                                                        data-large-mode="true" type="text" readonly>
                                            </div>
                                            <div class="form-group SingleUserId col-md-2">
                                                <label for="inputAddress2" style="text-align: center;">Unused</lable>
                                                    <input class="form-control " id="Unused" name="Unused"
                                                        data-large-mode="true" type="text" readonly>
                                            </div>


                                        </div>

                                        <div class="table-responsive p-t-10">
                                            <div id="example1"></div>

                                        </div>
                                        <br />
                                        <br />
                                        <div class="row">
                                            <div class="col-md-12"
                                                style="position: relative;padding-left: 15px;border-right-width: 73px;padding-right: 58px;">
                                                <h3 align="center" id="hd_text1" style="display:none">Visits / Covers by
                                                    Month</h3>
                                                <div id="chart"></div>
                                            </div>
                                        </div>


                                    </div>
                                    <br />
                                    <hr />




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
    <!--<script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>-->


    <script src="assets/vendor/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/vendor/datedropper/datedropper.min.js"></script>
    <script src="assets/vendor/dropzone/dropzone.js"></script>
    <script src="assets/vendor/jquery.mask/jquery.mask.min.js"></script>
    <script src="assets/js/form-data.js"></script>

    <script>
        function ShowForm() {

            var filter = $('#ddl_filter').val();


            if (filter == "All") {
                $('.AllUserId').css('display', 'block');
                emptySingleUser();
            } else {
                $('.AllUserId').css('display', 'none');
            }


            if (filter == "SingleUser") {
                $('.SingleUserId').css('display', 'block');
                emptyAllUser(); AutoLoad();
            } else {
                $('.SingleUserId').css('display', 'none');
            }

        }



        function emptySingleUser() {
            $('#MemberId').val('');
            $('#MemberName').val('');
            $('#Level').val('');
            $('#MembershipValidity').val('');
            $('#Booklet').val('');
            $('#Used').val('');
            $('#Unused').val('');
            $('#example1').empty();
        }

        function emptyAllUser() {
            $('#fromDt').val('');
            $('#ToDt').val('');
            $('#example1').empty();
        }

        function searchDatefiltter(strPage, perpg) {

            var fromDt = document.getElementById('fromDt').value;
            var ToDt = document.getElementById('ToDt').value;
            if (fromDt == "") {
                alert("Please select from date");
            } else if (MemberName == "") {
                alert("Please select to date");
            }

            else {

                perp = perpg;

                var Page = "";
                if (strPage != "") {
                    Page = strPage;
                }


                $.ajax({
                    type: 'POST',
                    url: 'QR_code_trackDate_search.php',
                    data: 'Page=' + Page + '&perpg=' + perp + '&fromDt=' + fromDt + '&ToDt=' + ToDt,
                    success: function (msg) {
                        // alert(msg);
                        document.getElementById("example1").innerHTML = msg;

                        testdatatable();


                    }
                })

            }
        }

        function searchfiltter(strPage, perpg) {
            var Booklet = document.getElementById('Booklet').value;
            var MemberId = document.getElementById('MemberId').value;
            var MemberName = document.getElementById('MemberName').value;
            if (MemberId == "") {
                alert("please Enter Member ID ");
            } else if (MemberName == "") {
                alert("please Enter Member Name");
            }
            else if (Booklet == "") {
                alert("Invalid Booklet Or Empty");
            }
            else {

                perp = perpg;

                var Page = "";
                if (strPage != "") {
                    Page = strPage;
                }


                $.ajax({
                    type: 'POST',
                    url: 'QR_code_track_search.php',
                    data: 'Page=' + Page + '&perpg=' + perp + '&MemberId=' + MemberId + '&Booklet=' + Booklet,
                    success: function (msg) {
                        // alert(msg);
                        document.getElementById("example1").innerHTML = msg;

                        testdatatable();


                    }
                })

            }
        }

        function testdatatable() {
            $('#example').DataTable();
        }
    </script>

    <!--======================Auto Complete Function Start =======================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />


    <script>

        function getAllData(id, column) {
            // alert(id)

            $.ajax({
                type: 'POST',
                url: 'GetAllMemberDetails.php',
                data: "id=" + id + '&column=' + column,
                success: function (msg) {
                    // alert(msg);

                    var jsr = JSON.parse(msg);

                    if (id != "") {
                        $('#MemberId').val(jsr[0]['m_id']);
                        $('#MemberName').val(jsr[0]['m_name']);
                        $('#Level').val(jsr[0]['m_level']);
                        $('#MembershipValidity').val(jsr[0]['m_expiry']);
                        $('#Booklet').val(jsr[0]['Booklet']);
                        $('#Unused').val(jsr[0]['AvailBarcode']);
                        $('#Used').val(jsr[0]['UsedBarcod']);
                        searchfiltter('', '');

                    }
                }
            })


        }





        var mid = [];
        var mname = [];
        function AutoLoad() {
            $.ajax({
                type: 'POST',
                url: 'GetMemberId.php',
                data: "",
                success: function (msg) {
                    //  alert(msg);

                    var jsr = JSON.parse(msg);
                    for (var i = 0; i < jsr.length; i++) {
                        mid.push(jsr[i]['m_id']);
                        mname.push(jsr[i]['m_name']);
                    }

                    test();



                }
            })
        }


        function test() {
            $("#MemberId").autocomplete({
                source: mid,
                minLength: 1
            });

            $("#MemberName").autocomplete({
                source: mname,
                minLength: 1
            });


        }

        $(document).ready(function () {
            $('#MemberId').on('autocompletechange change', function () {//alert(this.value)
                getAllData(this.value, 'id');

            }).change();


            $('#MemberName').on('autocompletechange change', function () {//alert(this.value)
                getAllData(this.value, 'name');

            }).change();
        });

    </script>

    <!--======================Auto Complete Function (End)=======================-->

</body>

</html>
<script>
    $(document).ready(function () {
        $("#rightclick").on("contextmenu", function (e) {
            return false;
        });
    }); 
</script>