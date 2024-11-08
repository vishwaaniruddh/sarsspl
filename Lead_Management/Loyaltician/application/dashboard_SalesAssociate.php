<?php session_start();
include ('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php"); ?>

</head>

<body class="sidebar-pinned page-home">

    <?php include ("vertical_menu.php") ?>

    <main class="admin-main">
        <!--site header begins-->
        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content">
            <div class="container-fluid bg-dark m-b-30">
                <div class="row">

                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="  "><span class="btn btn-white-translucent"><i
                                    class="mdi mdi-shape-circle-plus "></i></span> <span class="js-greeting"></span>,



                            <?php echo $_SESSION['user']; ?>!
                        </h4>
                        <p class="opacity-75">
                            <?php if ($_SESSION['roll_id'] == "15") { ?>
                                Good Luck for your sells
                            <?php } ?>
                        </p>
                        <!--<a href="#" class="btn btn-white-translucent">View Reports</a>-->

                    </div>
                </div>
            </div>
            <?php
            date_default_timezone_set('Asia/Kolkata');
            $dates = date('Y-m-d');

            $FirstDate = date('Y-m-01');
            $LastDate = date('Y-m-t');

            $start_year = date("Y-1-01");
            $end_year = date("Y-12-t", strtotime($start_year));


            $sql = "select count(Lead_id) from Leads_table where leadEntryef='" . $_SESSION['id'] . "' and date(Creation)='" . $dates . "'";
            $runsql = mysqli_query($conn, $sql);
            $fetchrun = mysqli_fetch_array($runsql);

            $sqlLead = "select count(Lead_id) from Leads_table where leadEntryef='" . $_SESSION['id'] . "' and date(Creation) between '" . $FirstDate . "' and '" . $LastDate . "'";
            $runsqlLead = mysqli_query($conn, $sqlLead);
            $fetchMonthLead = mysqli_fetch_array($runsqlLead);


            /* $yearLead   ="select count(Lead_id) from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation) between '".$start_year."' and '".$end_year."'";
             $yearLead  =mysqli_query($conn,$yearLead);
             $fetchyearLead=mysqli_fetch_array($yearLead);
           
        */

            $qry_reg = mysqli_query($conn, "select reg_id from Users where UserId='" . $_SESSION['id'] . "' ");
            $qry_fetch = mysqli_fetch_array($qry_reg);

            $sqldele = "SELECT COUNT(LeadId) FROM `LeadDelegation` WHERE SalesmanId='" . $qry_fetch['reg_id'] . "' and LeadId  IN (select Lead_id from Leads_table WHERE Status='5') and date(DelegatedTIme)='" . $dates . "'";
            // echo $sqldele;
            $runsqldel = mysqli_query($conn, $sqldele);
            $fetchrundel = mysqli_fetch_array($runsqldel);


            $sqlmo = "SELECT COUNT(LeadId) FROM `LeadDelegation` WHERE SalesmanId='" . $qry_fetch['reg_id'] . "' and LeadId  IN (select Lead_id from Leads_table WHERE Status='5') and  date(DelegatedTIme) between '" . $FirstDate . "' and '" . $LastDate . "'";
            // echo $sqldele;
            $runsqlmo = mysqli_query($conn, $sqlmo);
            $fetchrunmo = mysqli_fetch_array($runsqlmo);




            $qry_reg1 = mysqli_query($conn, "SELECT COUNT(LeadId) FROM `LeadDelegation` WHERE SalesmanId='" . $qry_fetch['reg_id'] . "' and LeadId NOT IN (select Lead_id from Leads_table WHERE Status='5') ");
            $qry_fetch1 = mysqli_fetch_array($qry_reg1);


            $qry_renwal = mysqli_query($conn, "SELECT COUNT(*) FROM `Lead_Renewal_Delegation` WHERE SalesmanId='" . $qry_fetch['reg_id'] . "' ");
            $qry_fetchRenewal = mysqli_fetch_array($qry_renwal);

            //echo $fetchrundel[0];
            
            ?>
            <div class="container-fluid pull-up">
                <div class="row">
                    <a href="prospect_view.php">
                        <div class="col m-b-30">
                            <div class="card ">
                                <div class="   text-center card-body">
                                    <div class="text-success   ">
                                        <div class="avatar avatar-sm ">

                                            <?php if ($fetchrun[0] != 0) { ?>
                                                <span class="avatar-title rounded-circle badge-soft-success"><i
                                                        class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            <?php } else { ?>
                                                <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                            <?php } ?>
                                        </div>
                                        <!-- <h6 class="m-t-5 m-b-0"> 19%</h6>-->
                                    </div>


                                    <div class=" text-center">
                                        <h3><?php echo $fetchrun[0]; ?> </h3>
                                    </div>
                                    <div class="text-overline ">
                                        TODAY'S LEADS
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="prospect_view.php">
                        <div class="col m-b-30">
                            <div class="card ">
                                <div class="   text-center card-body">
                                    <div class="text-danger   ">
                                        <div class="avatar avatar-sm ">
                                            <?php if ($fetchMonthLead[0] != 0) { ?>
                                                <span class="avatar-title rounded-circle badge-soft-success"><i
                                                        class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            <?php } else { ?>
                                                <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                            <?php } ?>
                                        </div>
                                        <!--<h6 class="m-t-5 m-b-0"> 32%</h6>-->
                                    </div>


                                    <div class=" text-center">
                                        <h3><?php echo $fetchMonthLead[0]; ?> </h3>
                                    </div>
                                    <div class="text-overline ">
                                        MONTHLY LEADS
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="SalesAsso_Member.php">
                        <div class="col m-b-30">
                            <div class="card ">
                                <div class="   text-center card-body">
                                    <div class="text-warning   ">
                                        <div class="avatar avatar-sm ">
                                            <?php if ($fetchrundel[0] != 0) { ?>
                                                <span class="avatar-title rounded-circle badge-soft-success"><i
                                                        class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            <?php } else { ?>
                                                <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                            <?php } ?>
                                        </div>
                                        <!--<h6 class="m-t-5 m-b-0"> 74%</h6>-->
                                    </div>


                                    <div class=" text-center">
                                        <h3><?php echo $fetchrundel[0]; ?> </h3>
                                    </div>
                                    <div class="text-overline ">
                                        TODAY'S LEADS CONVERTED
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="SalesAsso_Member.php">
                        <div class="col m-b-30">
                            <div class="card ">
                                <div class="   text-center card-body">
                                    <div class="text-info   ">
                                        <div class="avatar avatar-sm ">
                                            <?php if ($fetchrunmo[0] != 0) { ?>
                                                <span class="avatar-title rounded-circle badge-soft-success"><i
                                                        class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            <?php } else { ?>
                                                <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                            <?php } ?>
                                        </div>
                                        <!--<h6 class="m-t-5 m-b-0"> 36%</h6>-->
                                    </div>


                                    <div class=" text-center">
                                        <h3><?php echo $fetchrunmo[0]; ?> </h3>
                                    </div>
                                    <div class="text-overline ">
                                        MONTHLY LEADS CONVERTED
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="leadupdatebysales.php">
                        <div class="col  m-b-30">
                            <div class="card ">
                                <div class="   text-center card-body">
                                    <div class="text-danger   ">
                                        <div class="avatar avatar-sm ">
                                            <?php if ($fetchyearLead[0] != 0) { ?>
                                                <span class="avatar-title rounded-circle badge-soft-success"><i
                                                        class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            <?php } else { ?>
                                                <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                            <?php } ?>
                                        </div>
                                        <!-- <h6 class="m-t-5 m-b-0"> 49%</h6>-->
                                    </div>


                                    <div class=" text-center">
                                        <h3><?php echo $qry_fetch1[0] ?></h3>
                                        </h3>
                                    </div>
                                    <div class="text-overline ">
                                        DELEGATED LEADS
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="RenewalsLeadupdatebysales.php">
                        <div class="col m-b-30">
                            <div class="card ">
                                <div class="   text-center card-body">
                                    <div class="text-info   ">
                                        <div class="avatar avatar-sm ">
                                            <?php if ($fetchrunmo[0] != 0) { ?>
                                                <span class="avatar-title rounded-circle badge-soft-success"><i
                                                        class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            <?php } else { ?>
                                                <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                            <?php } ?>
                                        </div>
                                        <!--<h6 class="m-t-5 m-b-0"> 36%</h6>-->
                                    </div>


                                    <div class=" text-center">
                                        <h3><?php echo $qry_fetchRenewal[0]; ?> </h3>
                                    </div>
                                    <div class="text-overline ">
                                        RENEWALs
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>






                    <div class="col visible-xlg m-b-30">
                        <div class="card">
                            <div class="text-center card-body">
                                <div class="text-success   ">
                                    <div class="avatar avatar-sm ">
                                        <?php if ($fetchrun[0] != 0) { ?>
                                            <span class="avatar-title rounded-circle badge-soft-success"><i
                                                    class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                        <?php } else { ?>
                                            <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                    class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                        <?php } ?>
                                    </div>
                                    <h6 class="m-t-5 m-b-0"> 85%</h6>
                                </div>


                                <div class=" text-center">
                                    <h3>$82,580 </h3>
                                </div>
                                <div class="text-overline ">
                                    mobile ads
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3 class="">Goals</h3>
                        <!--<p>
                                    <span class="text-success fw-600"> <i class="mdi mdi-arrow-up"></i> 36%  </span>
                                    <span class="text-muted">vs last month</span>
                                </p>-->
                        <hr>
                        <div class="m-b-10">
                            <div class="row">
                                <div class="col">
                                    <p class="m-b-5"><?php echo $fetchrun[0]; ?> <span class="text-muted">Today Leads
                                            Added</span>
                                    </p>
                                </div>
                                <?php if ($fetchrun[0] == "0") {
                                    $width = '0%';
                                } else if ($fetchrun[0] == "1") {
                                    $width = '20%';
                                } else if ($fetchrun[0] == "2") {
                                    $width = '40%';
                                } else if ($fetchrun[0] == "3") {
                                    $width = '60%';
                                } else if ($fetchrun[0] == "4") {
                                    $width = '80%';
                                } else if ($fetchrun[0] == "5") {
                                    $width = '100%';
                                } ?>

                                <div class="col-auto text-right">
                                    <div class="text-muted"><?php echo $width; ?> Complete</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="progress">


                                    <!--<div class="progress-bar" role="progressbar" style="<?php if ($fetchrun[0] == "0") { ?>width: 0% <?php } else if ($fetchrun[0] == "1") { ?>width: 20%<?php } else if ($fetchrun[0] == "2") { ?>width: 40% <?php } else if ($fetchrun[0] == "3") { ?>width: 60%<?php } else if ($fetchrun[0] == "4") { ?>width: 80%<?php } else if ($fetchrun[0] == "5") { ?>width: 100%<?php } ?>"
                                             -->
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $width; ?>"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m-b-10">
                            <div class="row">
                                <div class="col">
                                    <p class="m-b-5"><?php echo $fetchMonthLead[0]; ?> <span class="text-muted">Monthly
                                            Leads Added</span></p>
                                </div>



                                <?php

                                $per = '100' / 75;
                                $widthh = $fetchMonthLead[0] * $per;

                                $yearPer = '100' / 250;
                                $widthYearr = $fetchyearLead[0] * $yearPer;

                                $width1 = round($widthh, 2);
                                $widthYear = round($widthYearr, 2);
                                ?>

                                <div class="col-auto text-right">
                                    <div class="text-muted"><?php echo $width1; ?>% Complete</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width:<?php echo $width1; ?>%" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m-b-10">
                            <div class="row">
                                <div class="col">
                                    <p class="m-b-5"><?php echo $fetchyearLead[0]; ?> <span class="text-muted">Yearly
                                            Leads Added</span>
                                    </p>
                                </div>
                                <div class="col-auto text-right">
                                    <div class="text-muted"><?php echo $widthYear ?>% Complete</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width:<?php echo $widthYear; ?>%" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
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
                                </div>


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
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/atmos.min.js"></script>
    <!--page specific scripts for demo-->
    <!--Additional Page includes-->
    <script src="assets/vendor/apexchart/apexcharts.min.js"></script>
    <!--chart data for current dashboard-->
    <script src="assets/js/dashboard-01.js"></script>
</body>

</html>