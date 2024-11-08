<?php session_start();
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("header.php");?>

</head>
<body class="sidebar-pinned page-home">
    
    <?php include("vertical_menu.php")?>
    
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
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
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
                                    <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All systems operational.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload successful.</div>
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
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark">V</span>

                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"   >
                   <!-- <a class="dropdown-item" href="#">  Add Account
                    </a>-->
                   <!-- <a class="dropdown-item" href="#">  Reset Password</a>
                    <a class="dropdown-item" href="#">  Help </a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
<!--site header ends -->    <section class="admin-content">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4 class="  "><span class="btn btn-white-translucent"><i
                                    class="mdi mdi-shape-circle-plus "></i></span> <span class="js-greeting"></span>,
                        
                        
                        
                        <?php echo $_SESSION['user'];?>!</h4>
                    <p class="opacity-75 ">
                       
                        Thank you for participating in the lead generation exercise for the membership of your hotel.<br /> Start by clicking on new Prospect or track your productivity on the dashboard. Good luck.
                    </p>
                    <!--<a href="#" class="btn btn-white-translucent">View Reports</a>-->

                </div>
            </div>
        </div>
        <?php
       date_default_timezone_set('Asia/Kolkata');
       $dates = date('Y-m-d');
       
       $FirstDate=date('Y-m-01');
       $LastDate=date('Y-m-t');
       
      $start_year= date("Y-1-01");
     $end_year = date("Y-12-t", strtotime($start_year));

       
        $sql   ="select count(Lead_id) from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation)='".$dates."'";
        $runsql  =mysqli_query($conn,$sql);
        $fetchrun=mysqli_fetch_array($runsql);
        
        $sqlLead   ="select count(Lead_id) from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation) between '".$FirstDate."' and '".$LastDate."'";
        $runsqlLead  =mysqli_query($conn,$sqlLead);
        $fetchMonthLead=mysqli_fetch_array($runsqlLead);
        
         
        $yearLead   ="select count(Lead_id) from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation) between '".$start_year."' and '".$end_year."'";
       //echo $yearLead;
        $yearLead  =mysqli_query($conn,$yearLead);
        $fetchyearLead=mysqli_fetch_array($yearLead);
      
      
        $data=array();
        
        $sql   ="select Lead_id from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation)='".$dates."'";
        $runsql  =mysqli_query($conn,$sql);
        while($fetchrundd=mysqli_fetch_array($runsql)){
        $data[]=$fetchrundd[0];
         }
         $sqldele  ="select count(DelegationId) from LeadDelegation where LeadId IN('".$data[0]."') and date(DelegatedTIme)='".$dates."'";
        // echo $sqldele;
        $runsqldel  =mysqli_query($conn,$sqldele);
        $fetchrundel=mysqli_fetch_array($runsqldel);
        
        
        $data1=array();
        
        $sqlMoCon   ="select Lead_id from Leads_table where leadEntryef='".$_SESSION['id']."' and date(Creation) between '".$FirstDate."' and '".$LastDate."'";
        $moConsql  =mysqli_query($conn,$sqlMoCon);
        while($fetchrMoCon=mysqli_fetch_array($moConsql)){
        $data1[]=$fetchrMoCon[0];
         }
         $sqlmo  ="select count(DelegationId) from LeadDelegation where LeadId IN('".$data1[0]."') and  date(DelegatedTIme) between '".$FirstDate."' and '".$LastDate."'";
        // echo $sqldele;
        $runsqlmo  =mysqli_query($conn,$sqlmo);
        $fetchrunmo=mysqli_fetch_array($runsqlmo);
        
        
        //echo $fetchrundel[0];
      
        ?>
        <div class="container-fluid pull-up">
            <div class="row">
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-success   ">
                                <div class="avatar avatar-sm ">
                                    
                                   <?php if($fetchrun[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                               <!-- <h6 class="m-t-5 m-b-0"> 19%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchrun[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                                TODAY'S LEADS
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-danger   ">
                                <div class="avatar avatar-sm ">
                                    <?php if($fetchMonthLead[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <!--<h6 class="m-t-5 m-b-0"> 32%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchMonthLead[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                                MONTHLY LEADS
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-warning   ">
                                <div class="avatar avatar-sm ">
                                    <?php if($fetchrundel[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <!--<h6 class="m-t-5 m-b-0"> 74%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchrundel[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                                TODAY'S LEADS CONVERTED
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-info   ">
                                <div class="avatar avatar-sm ">
                                     <?php if($fetchrunmo[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                <!--<h6 class="m-t-5 m-b-0"> 36%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchrunmo[0];?> </h3>
                            </div>
                            <div class="text-overline ">
                               MONTHLY LEADS CONVERTED
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-lg-block d-none m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                          <div class="text-danger   ">
                                <div class="avatar avatar-sm ">
                                   <?php if($fetchyearLead[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
                                     <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-arrow-down-bold mdi-18px"></i> </span>
                                    <?php } ?>
                                </div>
                                 <!-- <h6 class="m-t-5 m-b-0"> 49%</h6>-->
                            </div>


                            <div class=" text-center">
                                <h3><?php echo $fetchyearLead[0]?></h3> </h3>
                            </div>
                            <div class="text-overline ">
                                YEARLY LEADS
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col visible-xlg m-b-30">
                    <div class="card">
                        <div class="text-center card-body">
                            <div class="text-success   ">
                                <div class="avatar avatar-sm ">
                                    <?php if($fetchrun[0]!=0){?>
                                    <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                    <?php }else{ ?>
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
                                        <div class="col"><p class="m-b-5"><?php echo $fetchrun[0];?> <span class="text-muted">Today Leads Added</span>
                                            </p></div>
<?php if($fetchrun[0]=="0"){$width='0%'; }
else if($fetchrun[0]=="1"){$width='20%'; }
else if($fetchrun[0]=="2"){$width='40%'; }
else if($fetchrun[0]=="3"){$width='60%'; }
else if($fetchrun[0]=="4"){$width='80%';}
else if($fetchrun[0]=="5"){$width='100%';}?>
                                            
                                        <div class="col-auto text-right">
                                            <div class="text-muted"><?php echo $width; ?> Complete</div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="progress">
                                            
                                            
                                            <!--<div class="progress-bar" role="progressbar" style="<?php if($fetchrun[0]=="0"){?>width: 0% <?php }else if($fetchrun[0]=="1"){?>width: 20%<?php }else if($fetchrun[0]=="2"){?>width: 40% <?php }else if($fetchrun[0]=="3"){?>width: 60%<?php }else if($fetchrun[0]=="4"){?>width: 80%<?php }else if($fetchrun[0]=="5"){?>width: 100%<?php }?>"
                                             -->
                                             <div class="progress-bar" role="progressbar" style="width: <?php echo $width;?>"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="m-b-10">
                                    <div class="row">
                                        <div class="col"><p class="m-b-5"><?php echo $fetchMonthLead[0];?> <span
                                                        class="text-muted">Monthly Leads Added</span></p></div>
                                                        
                                                        
                                                        
<?php

$per='100'/75;
$widthh= $fetchMonthLead[0]*$per;

$yearPer='100'/250;
$widthYearr= $fetchyearLead[0]*$yearPer;

 $width1= round($widthh,2); 
 $widthYear= round($widthYearr,2); 
?>
                                       
                                        <div class="col-auto text-right">
                                            <div class="text-muted"><?php echo $width1;?>% Complete</div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width:<?php echo $width1;?>%"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-b-10">
                                    <div class="row">
                                        <div class="col"><p class="m-b-5"><?php echo $fetchyearLead[0];?> <span class="text-muted">Yearly Leads Added</span>
                                            </p></div>
                                        <div class="col-auto text-right">
                                            <div class="text-muted"><?php echo $widthYear?>% Complete</div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width:<?php echo $widthYear;?>%"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                               <!-- <div class="m-b-10">
                                    <div class="row">
                                        <div class="col"><p class="m-b-5">$6,650 <span class="text-muted">Funds </span>
                                            </p></div>
                                        <div class="col-auto text-right">
                                            <div class="text-muted">10% Used</div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-b-10">
                                    <div class="row">
                                        <div class="col"><p class="m-b-5"> Customer Satisfaction </p></div>
                                        <div class="col-auto text-right">
                                            <div class="text-muted">32%</div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 32%"
                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>-->

                            </div>
                        </div>
                        <!--widget card ends-->



<!--
            <div class="row">
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Quarterly User Growth</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div id="chart-01"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Country Wise Distribution</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-02"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Top grossing Products</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-03"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Gender Based</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-04"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>-->
        <!--    <div class="row">
                <div class="col-lg-8 m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">User Renewals</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-hover table-sm ">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Team</th>
                                    <th>location</th>
                                    <th>Progress</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-middle">
                                        <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span></td>

                                    <td class="align-middle"><span class="badge badge-soft-danger badge-light"> System Architect</span>
                                    </td>
                                    <td class="align-middle">Edinburgh</td>
                                    <td class="align-middle">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 12%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Connect</a></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-2.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Garrett Rose</span></td>

                                    <td class="align-middle"><span class="badge badge-soft-success"> Accounts</span>
                                    </td>
                                    <td class="align-middle">Tokyo</td>
                                    <td class="align-middle">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 80%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Connect</a></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="avatar avatar-sm avatar-offline"><img
                                                    src="assets/img/users/user-3.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Ashton Cox</span></td>

                                    <td class="align-middle"><span class="badge badge-soft-primary"> Development</span>
                                    </td>
                                    <td class="align-middle">San Francisco</td>
                                    <td class="align-middle">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 60%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Connect</a></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="avatar avatar-sm avatar-offline"><img
                                                    src="assets/img/users/user-4.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Cedric Kelly</span></td>

                                    <td class="align-middle"><span class="badge badge-soft-primary"> Development</span>
                                    </td>
                                    <td class="align-middle">Edinburgh</td>
                                    <td class="align-middle">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 56%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Connect</a></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-5.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Airi Satou</span></td>

                                    <td class="align-middle"><span class="badge badge-soft-primary"> Development</span>
                                    </td>
                                    <td class="align-middle">Tokyo</td>
                                    <td class="align-middle">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Connect</a></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="avatar avatar-sm avatar-offline"><img
                                                    src="assets/img/users/user-6.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Brielle Will</span></td>

                                    <td class="align-middle"><span class="badge badge-soft-dark"> Integration </span>
                                    </td>
                                    <td class="align-middle">New York</td>
                                    <td class="align-middle">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 20%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Connect</a></td>
                                </tr>


                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i>  List based on your communication history.</span>
                                </h6>
                                <a href="#!" class="btn btn-dark">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 m-b-30">
                    <div class="card ">
                        <div class="card-header">
                            <div class="card-title">Files Library</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="list-group list-group-flush ">


                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="assets/img/social/s5.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Recess.jpg</div>
                                    <div class="text-muted">350 Kb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="assets/img/social/s4.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Outing.jpg</div>
                                    <div class="text-muted">1.2 Mb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="assets/img/logos/nytimes.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Client.png</div>
                                    <div class="text-muted">45 Mb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i
                                                    class="mdi mdi-24px mdi-file-pdf"></i></div>
                                    </div>
                                </div>
                                <div class="">
                                    <div>SRS Document</div>
                                    <div class="text-muted">25.5 Mb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
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
                                    <div>Design Guide.pdf</div>
                                    <div class="text-muted">9 Mb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm ">
                                            <div class="avatar-title  rounded"><i
                                                        class="mdi mdi-24px mdi-code-braces"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div>response.json</div>
                                    <div class="text-muted">15 Kb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm ">
                                            <div class="avatar-title bg-green rounded"><i
                                                        class="mdi mdi-24px mdi-file-excel"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div>June Accounts.xls</div>
                                    <div class="text-muted">6 Mb</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>-->


        </div>
    </section>
</main>

<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
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
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="assets/img/users/user-3.jpg" alt="user-image"></div>
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
                                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
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
<script src="assets/js/dashboard-01.js"   ></script>
</body>
</html>