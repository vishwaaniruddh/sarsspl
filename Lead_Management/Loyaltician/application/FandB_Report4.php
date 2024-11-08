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

<body class="sidebar-pinned" onload="searchfiltter('','');AutoLoad();">


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
                                    <i class="mdi mdi-table "></i></span> Member Spend History
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
                                <?php include ("config.php");
                                $q1 = mysqli_query($conn, "SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table`  ");
                                $f1 = mysqli_fetch_array($q1);


                                $q2 = mysqli_query($conn, "SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table`  ");
                                $f2 = mysqli_fetch_array($q2);

                                $revenu2 = $f2['FoodAmt'] + $f2['SoftBevAmt'] + $f2['IndianLiqAmt'] + $f2['ImpLiqAmt'] + $f2['No_of_MiscAmt'];
                                $discount2 = $f2['FoodDiscAmt'] + $f2['SoftBevDiscAmt'] + $f2['IndianLiqDiscAmt'] + $f2['ImpLiqDiscAmt'] + $f2['MiscDiscAmt'];
                                $netRevenue2 = $revenu2 - $discount2;


                                if ($revenu2 > 0) {
                                    $percent2 = ($discount2 * 100) / $revenu2;
                                    $disPer2 = number_format($percent2) . '%';
                                }

                                $APCcount = $netRevenue2 / $f1['No_of_paxClose'];
                                $APC = number_format($APCcount);
                                ?>



                                <div class="card-body">



                                    <div class="container-fluid">
                                        <div class="row d-none  pull-up d-lg-flex">
                                            <div class="col m-b-30">
                                                <div class="card ">

                                                    <div class="card-body">

                                                        <div class="text-center p-t-30 p-b-20">
                                                            <div class="text-overline text-muted opacity-75"
                                                                style="font-size: 13px;">COVERS</div>
                                                            <h1 class="text-success"><?php echo $f1['No_of_paxClose']; ?>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col m-b-30">
                                                <div class="card ">

                                                    <div class="card-body">

                                                        <div class="text-center p-t-30 p-b-20">
                                                            <div class="text-overline text-muted opacity-75"
                                                                style="font-size: 13px;">Net Revenue</div>
                                                            <h1 class="text-danger"><?php echo $netRevenue2; ?></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col m-b-30">
                                                <div class="card ">

                                                    <div class="card-body">

                                                        <div class="text-center p-t-30 p-b-20">
                                                            <div class="text-overline text-muted opacity-75"
                                                                style="font-size: 13px;"> Discount</div>
                                                            <h1 class="text-success"> <?php echo $disPer2; ?> </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col m-b-30">
                                                <div class="card ">

                                                    <div class="card-body">

                                                        <div class="text-center p-t-30 p-b-20">
                                                            <div class="text-overline text-muted opacity-75"
                                                                style="font-size: 13px;">APC</div>
                                                            <h1 class="text-danger"> <?php echo $APC; ?></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Member ID</lable>
                                                <input type="text" id="MemberId" name="MemberId" class="form-control"
                                                    placeholder="Enter ATM ID " required>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Member Name</lable>
                                                <input type="text" id="MemberName" name="MemberName"
                                                    class="form-control" placeholder="Enter ATM ID " required>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">From Date</lable>
                                                <input class="form-control datedropper" id="fromDt" name="fromDt"
                                                    data-large-mode="true" type="text" style="background-color: white;">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">To Date</lable>
                                                <input class="form-control datedropper" id="ToDt" name="ToDt"
                                                    data-large-mode="true" type="text" style="background-color: white;">
                                        </div>


                                        <div class="form-group col-md-4">
                                            <input type="button" class="btn btn-primary"
                                                style="height:30px;margin-top: 24px;padding-top: 2px;"
                                                onclick="searchfiltter('','')" value="Search">

                                        </div>






                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Level</lable>
                                                <input class="form-control " id="Level" name="Level"
                                                    data-large-mode="true" type="text" readonly>

                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Membership Validity</lable>
                                                <input class="form-control " id="MembershipValidity"
                                                    name="MembershipValidity" data-large-mode="true" type="text"
                                                    readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Designation</lable>
                                                <input class="form-control " id="Designation" name="Designation"
                                                    data-large-mode="true" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">Company</lable>
                                                <input class="form-control " id="Company" name="Company"
                                                    data-large-mode="true" type="text" readonly>
                                        </div>


                                    </div>




                                    <button onclick="myFunction()">Print this page</button>

                                    <script>
                                        function myFunction() {
                                            window.print();
                                        }
                                    </script>

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
                                    <br />
                                    <hr />


                                    <script src="assets/vendor/apexchart/apexcharts.min.js"></script>

                                    <script>


                                        function graph1(FromDt, Todt, MemberId) {


                                            $.ajax({
                                                type: 'POST',
                                                url: 'getFandB4_GraphProcess.php',
                                                data: 'FromDt=' + FromDt + '&Todt=' + Todt + '&MemberId=' + MemberId + '&graph=graph1',

                                                success: function (msg) {
                                                    //  alert(msg);

                                                    $("#chart").empty();
                                                    $('#hd_text1').show();


                                                    if (msg != "") {

                                                        var MonthName = [];
                                                        var Cover = [];
                                                        var jsr = JSON.parse(msg);
                                                        for (var i = 0; i < jsr.length; i++) {
                                                            MonthName.push(jsr[i]["MonthName"]);
                                                            Cover.push(parseInt(jsr[i]["Cover"]));
                                                        }


                                                        var options = {
                                                            chart: {
                                                                height: 350,
                                                                type: 'line',
                                                                zoom: {
                                                                    enabled: false
                                                                }
                                                            },
                                                            series: [{
                                                                name: "Cover",
                                                                data: Cover
                                                            }],
                                                            dataLabels: {
                                                                enabled: false
                                                            },
                                                            stroke: {
                                                                curve: 'straight'
                                                            },
                                                            title: {
                                                                text: 'Trends by Month',
                                                                align: 'left'
                                                            },
                                                            grid: {
                                                                row: {
                                                                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                                                    opacity: 0.5
                                                                },
                                                            },
                                                            xaxis: {
                                                                categories: MonthName,
                                                            }
                                                        }

                                                        var chart = new ApexCharts(
                                                            document.querySelector("#chart"),
                                                            options
                                                        );

                                                        chart.render();
                                                    }
                                                }
                                            })



                                        }


                                    </script>

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


        function setMemberName() {
            var Level = document.getElementById('Level_Filtter').value;

            $.ajax({
                type: 'POST',
                url: 'setDropdownMember.php',
                data: 'Level=' + Level,
                success: function (msg) {
                    // alert(msg);
                    document.getElementById("example1").innerHTML = msg;


                }
            })
        }


        function searchfiltter(strPage, perpg) {


            var fromDt = document.getElementById('fromDt').value;
            var ToDt = document.getElementById('ToDt').value;
            var MemberId = document.getElementById('MemberId').value;
            if (MemberId == "") {
                alert("please Enter Member ID / Member Name");
            } else {

                perp = perpg;

                var Page = "";
                if (strPage != "") {
                    Page = strPage;
                }


                $.ajax({
                    type: 'POST',
                    url: 'FandB_Report4_search.php',
                    data: 'Page=' + Page + '&perpg=' + perp + '&FromDt=' + fromDt + '&ToDt=' + ToDt + '&MemberId=' + MemberId,
                    success: function (msg) {
                        alert(msg);
                        document.getElementById("example1").innerHTML = msg;
                        graph1(fromDt, ToDt, MemberId);
                        testdatatable();


                    }
                })

            }
        }

        function testdatatable() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
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

                    $('#MemberId').val(jsr[0]['m_id']);
                    $('#MemberName').val(jsr[0]['m_name']);
                    $('#Level').val(jsr[0]['m_level']);
                    $('#MembershipValidity').val(jsr[0]['m_expiry']);
                    $('#Designation').val(jsr[0]['m_desig']);
                    $('#Company').val(jsr[0]['m_comp']);


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