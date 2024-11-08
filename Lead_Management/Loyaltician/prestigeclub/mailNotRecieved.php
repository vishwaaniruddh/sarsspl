<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body class="sidebar-pinned" id="rightclick">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Members not Recieved Mails
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php include("config.php");

// $sql = mysqli_query($conn,"select * from Members");

// while($sql_result = mysqli_fetch_assoc($sql)){
    
//     $id = $sql_result['mem_id'];
//     $entryDate = $sql_result['entryDate'];
//  $update = "update Members set member_since = '".$entryDate."' where mem_id = '".$id."'";
// mysqli_query($conn,$update);    
//     echo '<br>';
// }


// return;
  //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
 	  $View="select distinct(mem_id) from testcatchdata  where mem_id IN (SELECT lead_id FROM `Leads_table` where Status='5') ";
      $qrys=mysqli_query($conn,$View);

?>
                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>LeadID </th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Updated By</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <form action="sendmail_new.php" method="POST" enctype="multipart">
                                        	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
			    $sql2="select * from Leads_table where lead_id='".$_row['mem_id']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
  ?>
  <?php 
	 if($_row['status']==0)
	 {
	     $status = "Mail Not Sent";
	 }
	 else if($_row['status']==1)
	 {
	     $status = "Mail Sent";
	 }
	 ?>
                             <tr>
    <td><?php echo $srn;?></td>
	<td><?php echo $_row['mem_id']; ?></td>
	<td><?php echo $sql2fetch['FirstName']; ?></td>
	<td><?php echo $sql2fetch['LastName']; ?></td>
	<td><?php echo $status; ?></td>
	<td>
	    <!--<input type = "submit"  id="sendmail" class="btn btn-primary" value="Send Mail" />-->
	    <input type = "submit" id="update" class="btn btn-secondary" value="Update" />
	</td>
    <th><?php echo $_row['created_by'];?></th>
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
			</form>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th> LeadID</th>
                                        <th> First Name</th>
                                        <th> Last Name</th>
                                        <th> Status</th>
                                        <th>Action</th>
                                        <th>Updated By</th>
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
<?php include('belowScript.php');?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
<script>
    
    
    
</script>


</body>
</html>