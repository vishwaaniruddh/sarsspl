<?php
include("config.php");
$dateDD=date('Y-m-d');
if($_SESSION['register_id']=='1'){
    $qrysNum="0";
    
      $View="select a.LeadId,a.SalesmanId,b.Lead_id,b.FirstName,b.LastName,b.MobileNumber,b.EmailId,b.Country,b.State,b.City,b.LeadSource,b.Status,b.Nationality,b.Title,b.Company,b.LeadSource from LeadDelegation a,Leads_table b where a.LeadId=b.Lead_id and b.Status='1' and b.Lead_id IN (select LeadId from LeadUpdates where NextUpdate='".$dateDD."' ) ";

 }else{
 $View="select a.LeadId,a.SalesmanId,b.Lead_id,b.FirstName,b.LastName,b.MobileNumber,b.EmailId,b.Country,b.State,b.City,b.LeadSource,b.Status,b.Nationality,b.Title,b.Company,b.LeadSource,b.PinCode from LeadDelegation a,Leads_table b where a.LeadId=b.Lead_id and a.SalesmanId='".$_SESSION['register_id']."' and  b.Status!='5' and b.Status='1' and b.Lead_id IN (select LeadId from LeadUpdates where NextUpdate='".$dateDD."' ) ";
 }
// echo $View;
	$qrys=mysqli_query($conn,$View);

	if($qrys){
   $qrysNum=mysqli_num_rows($qrys);
	}
	?>

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
                   <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo $qrysNum;?>  <i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>

                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notifications </span>
                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            <div class="text-overline m-b-5">today</div>
                            <a href="todayCall_List.php" class="d-block m-b-10" target="_blank">
                                <div class="card">
                                    <div class="card-body"> <i class="mdi mdi-circle text-success"></i> Today Call List - <?php echo $qrysNum;?> </div>
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
                    </a>
                    <a class="dropdown-item" href="#">  Reset Password</a>
                    <a class="dropdown-item" href="#">  Help </a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
<!--site header ends -->