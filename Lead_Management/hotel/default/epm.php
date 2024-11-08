<?php session_start();

include('eng_config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body class="sidebar-pinned">


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
                  
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
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

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php 
    $View="select * from leads where status=1 order by id desc";
 	$qrys=mysqli_query($eng_con,$View);

?>
                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Full Name</th>
                                        <th>Email-Id</th>
                                        <th>Country Code</th>
                                        <th>Mobile Number</th>
                                        <th>Verified</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
			    $is_verify = $_row['is_verify'];
			    
			    $originalDate = $_row['created_at'];
$newDate = date("d-m-Y", strtotime($originalDate));


			    if($is_verify==1){
			        $verify='Yes';
			    }else{
			        $verify='No';
			    }

  ?>
                             <tr>
<td><?php echo $srn;?></td>
	<td><?php echo $_row['fname']." ".$_row['lname']; ?></td>
	<td><?php echo $_row['email']; ?></td>
	<td><?php echo $_row['ccode']; ?></td>
	<td><?php echo $_row['phone']; ?></td>
		<td><?php echo $verify ?></td>
		<td><?php echo $newDate; ?></td>
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Full Name</th>
                                        <th>Email-Id</th>
                                        <th>Country Code</th>
                                        <th>Mobile Number</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
</body>
</html>