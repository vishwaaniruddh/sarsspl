<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php"); ?>

    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>



</head>

<body class="sidebar-pinned ">
    <?php include ("vertical_menu.php") ?>
    <main class="admin-main">
        <!--site header begins-->
        <header class="admin-header">

            <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

            <nav class=" mr-auto my-auto">
                <ul class="nav align-items-center">

                    <li class="nav-item">
                        <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                            <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class=" ml-auto">
                <ul class="nav align-items-center">

                    <li class="nav-item">
                        <div class="dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                                <span class="notification-counter"></span>
                            </a>

                            <div class="dropdown-menu notification-container dropdown-menu-right">
                                <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                                    <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                                    <span class="h5 m-0">Notifications</span>
                                    <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                                </div>
                                <div class="notification-events bg-gray-300">
                                    <div class="text-overline m-b-5">today</div>
                                    <a href="#" class="d-block m-b-10">
                                        <div class="card">
                                            <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All
                                                systems operational.</div>
                                        </div>
                                    </a>
                                    <a href="#" class="d-block m-b-10">
                                        <div class="card">
                                            <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload
                                                successful.</div>
                                        </div>
                                    </a>
                                    <a href="#" class="d-block m-b-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                                            </div>
                                        </div>
                                    </a>


                                </div>

                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-sm avatar-online">
                                <span class="avatar-title rounded-circle bg-dark">V</span>

                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right">
                            <a class="dropdown-item" href="#"> Add Account
                            </a>
                            <a class="dropdown-item" href="#"> Reset Password</a>
                            <a class="dropdown-item" href="#"> Help </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> Logout</a>
                        </div>
                    </li>

                </ul>

            </nav>
        </header>
        <!--site header ends -->
        <section class="admin-content">
            <div class="bg-dark m-b-30">
                <div class="container">
                    <div class="row p-b-60 p-t-60">

                        <div class="col-md-10 mx-auto text-center text-white p-b-30">

                            <h1>Monthly Report</h1>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container pull-up">


                <div class="row">
                    <div class="col-lg-8  m-b-30">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Month Wise Sales Report</div>

                                <div class="card-controls">

                                    <a href="#" class="js-card-refresh icon"> </a>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon mdi  mdi-dots-vertical"></i> </a>

                                        <!-- <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>-->
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">


                                <div id="chart-05"></div>
                            </div>
                            <div class="">
                            </div>
                            <div class="card-footer">
                                <div class="d-flex  justify-content-between">
                                    <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i
                                                class="mdi mdi-information"></i> Restart your Re-targeting
                                            Campaigns</span>
                                    </h6>
                                    <!-- <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 m-b-30">
                        <div class="card full-height d-flex align-items-center justify-content-center  ">
                            <div class="card-controls">

                                <h3>Month wise Sales</h3>


                                <div class="card-body">
                                    <div class="p-b-80">
                                        <div class="font-secondary">

                                        </div>
                                        <label for="myDate">From Date :</label>
                                        <input name="fromDate" id="fromDate" class="monthYearPicker" />
                                        <label for="myDate">To Date :</label>
                                        <input name="toDate" id="toDate" class="monthYearPicker" />
                                        <input type="button" value="Search" onclick="month();">
                                    </div>
                                </div>


                            </div>
                            <div class="text-center">


                            </div>
                            <div class="bg-img m-h-30 w-100" </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="row">
                    <div class="col-md-8 m-b-30">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Break up of Sales by Level</div>

                                <div class="card-controls">

                                    <a href="#" class="js-card-refresh icon"> </a>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon mdi  mdi-dots-vertical"></i> </a>

                                        <!--<div class="dropdown-menu dropdown-menu-right">
                                                <button class="dropdown-item" type="button">Action</button>
                                                <button class="dropdown-item" type="button">Another action</button>
                                                <button class="dropdown-item" type="button">Something else here</button>
                                            </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart-15" class="m-auto chart-canvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 m-b-30">
                        <div class="card full-height d-flex align-items-center justify-content-center  ">
                            <div class="card-controls">

                                <h3>Break up of Sales by Level</h3>


                                <div class="card-body">
                                    <div class="p-b-80">
                                        <div class="font-secondary">

                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="text-center">


                            </div>
                            <div class="bg-img m-h-30 w-100" </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8  m-b-30">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Show a Pie Broken by City and Count</div>

                                <div class="card-controls">

                                    <a href="#" class="js-card-refresh icon"> </a>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon mdi  mdi-dots-vertical"></i> </a>

                                        <!--<div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>-->
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">


                                <div id="chart-11"></div>
                            </div>
                            <div class="">
                            </div>
                            <div class="card-footer">
                                <div class="d-flex  justify-content-between">
                                    <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i
                                                class="mdi mdi-information"></i> Restart your Re-targeting
                                            Campaigns</span>
                                    </h6>
                                    <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 m-b-30">
                        <div class="card full-height d-flex align-items-center justify-content-center  ">
                            <div class="card-controls">

                                <h3>Show a Pie Broken by City and Count</h3>


                                <div class="card-body">
                                    <div class="p-b-80">
                                        <div class="font-secondary">

                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="text-center">


                            </div>
                            <div class="bg-img m-h-30 w-100" </div>
                            </div>
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
                                </div>21.32k


                            </div>
                        </div>
                    </div>

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
    <!--<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
-->
    <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/atmos.min.js"></script>
    <!--page specific scripts for demo-->

    <!--Additional Page includes-->
    <script src="assets/vendor/apexchart/apexcharts.min.js"></script>
    <!--chart data for current dashboard-->
    <script src="assets/js/dashboard-02.js"></script>
    <!--<script src="assets/js/dashboard-04.js"   ></script>
-->


    <!--page specific scripts for demo-->
    <script>
        $(function () {
            $('.monthYearPicker').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'MM yy'
            }).focus(function () {
                var thisCalendar = $(this);
                $('.ui-datepicker-calendar').detach();
                $('.ui-datepicker-close').click(function () {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    thisCalendar.datepicker('setDate', new Date(year, month, 1));
                });
            });
        });
    </script>

    <script>
        function month() {
            var fdate = document.getElementById('fromDate').value;
            var toDate = document.getElementById('toDate').value;

            $.ajax({
                type: 'POST',
                url: 'getCityWiseMonthly_report.php',
                data: 'fdate=' + fdate + '&toDate=' + toDate,

                success: function (msg) {
                    //alert(msg);

                    var month_cityName = [];
                    var month_cityCount = [];
                    var jsr = JSON.parse(msg);
                    for (var i = 0; i < jsr.length; i++) {
                        month_cityName.push(jsr[i]["City"]);
                        month_cityCount.push(parseInt(jsr[i]["Count"]));
                    }


                    $('#chart-11').empty();

                    var options = {
                        chart: {
                            width: '70%',
                            type: 'pie',

                            toolbar: {
                                show: true,
                                tools: {
                                    download: true,
                                    selection: true,
                                    zoom: true,
                                    zoomin: true,
                                    zoomout: true,
                                    pan: true,
                                    reset: true | '<img src="/static/icons/reset.png" width="20">',
                                    customIcons: []
                                },
                                autoSelected: 'zoom'
                            },


                        },
                        series: month_cityCount,
                        labels: month_cityName,
                        theme: {
                            monochrome: {
                                enabled: true
                            }
                        },
                        title: {
                            text: ""
                        },



                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    }

                    var chart = new ApexCharts(
                        document.querySelector("#chart-11"),
                        options
                    );

                    chart.render();
                }
            });




            $.ajax({
                type: 'POST',
                url: 'getMonthlyLevel_report.php',
                data: 'fdate=' + fdate + '&toDate=' + toDate,

                success: function (msg) {
                    //  alert(msg)


                    $('#chart-15').empty();
                    var to = 0;
                    var month_level = [];
                    var jsr = JSON.parse(msg);
                    for (var i = 0; i < jsr.length; i++) {


                        month_level.push(parseInt(jsr[i]["First"]));
                        month_level.push(parseInt(jsr[i]["gold"]));
                        month_level.push(parseInt(jsr[i]["Patinum"]));

                        to = parseInt(jsr[i]["First"]) + parseInt(jsr[i]["gold"]) + parseInt(jsr[i]["Patinum"]);
                    }



                    if ($("#chart-15").length) {


                        var options = {
                            colors: ['#6766e5', '#4db4ff', '#FF0000'],
                            labels: ['First', 'Gold', 'Platinum'],

                            plotOptions: {
                                pie: {
                                    size: undefined,
                                    customScale: 1,
                                    offsetX: 0,
                                    offsetY: 0,
                                    expandOnClick: true,
                                    dataLabels: {
                                        offset: 0,
                                        minAngleToShowLabel: 10
                                    },
                                    donut: {
                                        size: '65%',
                                        background: 'transparent',
                                        labels: {
                                            show: true,
                                            name: {
                                                show: true,
                                                fontSize: '22px',
                                                fontFamily: 'Helvetica, Arial, sans-serif',
                                                color: undefined,
                                                offsetY: -10
                                            },
                                            value: {
                                                show: true,
                                                fontSize: '16px',
                                                fontFamily: 'Helvetica, Arial, sans-serif',
                                                color: undefined,
                                                offsetY: 16,
                                                formatter: function (val) {
                                                    return val
                                                }
                                            },
                                            total: {
                                                show: true,
                                                label: 'Total',
                                                color: '#373d3f',
                                                formatter: function (w) {
                                                    return to
                                                }
                                            }
                                        }
                                    },
                                }
                            },


                            chart: {
                                width: '70%',
                                type: 'donut',

                                toolbar: {
                                    show: true,
                                    tools: {
                                        download: true,
                                        selection: true,
                                        zoom: true,
                                        zoomin: true,
                                        zoomout: true,
                                        pan: true,
                                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    autoSelected: 'zoom'
                                },



                            },
                            series: month_level,
                            dataLabels: {
                                enabled: true,

                                enabledOnSeries: undefined,
                                formatter: function (val) {
                                    // alert(val)

                                    var v = Math.round(val);
                                    return v + "%"
                                },
                                textAnchor: 'middle',
                                offsetX: 0,
                                offsetY: 0,
                                style: {
                                    fontSize: '14px',
                                    fontFamily: 'Helvetica, Arial, sans-serif',
                                    colors: undefined
                                },
                                dropShadow: {
                                    enabled: false,
                                    top: 1,
                                    left: 1,
                                    blur: 1,
                                    opacity: 0.45
                                }





                            },
                            legend: {

                                position: 'bottom',
                            }

                        }

                        var chart = new ApexCharts(
                            document.querySelector("#chart-15"),
                            options
                        );

                        chart.render();
                    }




                }
            });



            $.ajax({
                type: 'POST',
                url: 'getMonth_report.php',
                data: 'fdate=' + fdate + '&toDate=' + toDate,

                success: function (msg) {
                    //  alert(msg);
                    $('#chart-05').empty();

                    var month_yer = [];
                    var memCnt = [];
                    var jsr = JSON.parse(msg);
                    for (var i = 0; i < jsr.length; i++) {
                        month_yer.push(jsr[i]["month_year"]);
                        memCnt.push(parseInt(jsr[i]["member"]));
                    }
                    //alert(month_yer);
                    //alert(memCnt);
                    //  alert(jsr[0]["month_year"])



                    if ($("#chart-05").length) {
                        var options = {
                            chart: {

                                type: 'bar',
                            },
                            colors: colors[0],
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            series: [{
                                name: 'Members',
                                data: memCnt

                            }],
                            xaxis: {
                                categories: month_yer,
                            },
                            yaxis: {},
                            tooltip: {}
                        };

                        var chart = new ApexCharts(
                            document.querySelector("#chart-05"),
                            options
                        );
                        chart.render();
                    }

                }

            });
        }
    </script>
</body>

</html>