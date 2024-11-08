<?php session_start();
include ("config.php");
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
  <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> View Assigned Renewals
                        </h4>
                        

                    </div>
                </div>
            </div>
        </div>
 <form  method="post" id="formf" action="delegation.php">
        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php 
//   if($_SESSION['register_id']=='1'){
    //   $View="select a.LeadId,a.SalesmanId,b.Lead_id,b.FirstName,b.LastName,b.MobileNumber,b.EmailId,b.Country,b.State,b.City,b.LeadSource,b.Status,b.Nationality,b.Title,b.Company,b.LeadSource from Lead_Renewal_Delegation a,Leads_table b where a.LeadId=b.Lead_id and b.renewalStatus!='1'";
      
      $View = "select * from RenewalLeadUpdates a, Leads_table b where a.LeadId = b.Lead_id order by a.UpdateId desc"; 

//  }
//  else{
//  $View="select a.LeadId,a.SalesmanId,b.Lead_id,b.FirstName,b.LastName,b.MobileNumber,b.EmailId,b.Country,b.State,b.City,b.LeadSource,b.Status,b.Nationality,b.Title,b.Company,b.LeadSource,b.PinCode from Lead_Renewal_Delegation a,Leads_table b where a.LeadId=b.Lead_id and a.SalesmanId='".$_SESSION['register_id']."' and b.renewalStatus!='1' ";
//  }
// echo $View;
	$qrys=mysqli_query($conn,$View);
?>
                             <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                        			    <th>LeadID</th>
                                        				<th>Title</th>
                                        				<th>FirstName</th>
                                        				<th>LastName</th>
                                        				<th>MobileNumber</th>
                                        				<th>EmailId</th>
                                        				<?php if($_SESSION['roll_id']!="15"){ ?><th>Country</th>
                                        				<th>State</th>
                                        				<th>City</th>
                                        				<th>Nationality</th>
                                        				<th>Company</th><?php }?>
                                        				<th>Lead Source</th>
                                        				<th>Status</th>
                                        				<th>View Comments</th>
                                        				<th>Update Lead</th>
                                         			    <th>Payment</th>
                                       	                <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{

	
	$sql3="select Name from Lead_Sources where SourceId='".$_row['LeadSource']."'";
	$runsql3=mysqli_query($conn,$sql3);
	$sql2fetch3=mysqli_fetch_array($runsql3);
	
	
  ?>
                             <tr>
	<td><?php echo $srn; ?></td>
	<td><?php echo $_row['Title']; ?></td>
	<td><?php echo $_row['FirstName']; ?></td>
	<td><?php echo $_row['LastName']; ?></td>
	<td><?php echo $_row['MobileNumber']; ?></td>
	<td><?php echo $_row['EmailId']; ?></td>
	
                   <?php if($_SESSION['roll_id']!="15"){ ?>
                                        <td><?php echo $_row['Country']; ?></td>
                                    	<td><?php echo $_row['State']; ?></td>
                                    	<td><?php echo $_row['City']; ?></td>
                                    	<td><?php echo $_row['Nationality']; ?></td>
                                    	<td><?php echo $_row['Company']; ?></td>
                         	<?php } ?>
                         	
	<td><?php echo $sql2fetch3[0]; ?></td>
	<td><?php 
        	if($_row['Status']=='0'){ echo "Done";}
        	if($_row['Status']==' '){ echo "Incomplete";}
            if($_row['Status']=='1'){ echo "Open" ;}
        	 if($_row['Status']=='2'){ echo "Closed" ;}
        	 if($_row['Status']=='3'){ echo "Suspense" ;} 
    	     if($_row['Status']=='7'){ echo "Ready For Payment";}
    	     if($_row['Status']=='6'){ echo "Payment in Process";}
    	        if($_row['Status']=='5'){ echo "Member";}
    	      if($_row['Status']=='4'){ echo "Payment Done";}?>
	</td>
	
	
	<td><?php 
  $leadUpdt=mysqli_query($conn,"select * From LeadUpdates where LeadId='".$_row['Lead_id']."'");
  
  $leadCount=mysqli_num_rows($leadUpdt);
	if($leadCount>0){ ?>
	
	<input type="button" id="qtnview<?php echo $srn;?>" class="btn btn-primary"  onclick="window.open('updateRenewalComment.php?ids=<?php echo $_row['Lead_id'];?>', '_blank', 'location=yes,height=400,width=600,left=400,top=200,scrollbars=yes,status=yes');" value="View">
	
	<?php } ?> 
	
	</td>
	
	
	
	<td><?php if($_row['Status']!='4'){?><input type="button" class="btn btn-primary"  id="qtnview<?php echo $srn;?>" onclick="window.open('Renewals_leadupdate.php?id=<?php echo $_row['LeadId'];?>','_self');" value="Lead Update"><?php } ?> </td>

		<td><?php if($_row['Status']!='4'){?><input type="button" class="btn btn-primary"  id="qtnview<?php echo $srn;?>" onclick="window.open('member_Payment_Renewal.php?id=<?php echo $_row['LeadId'];?>','_self');" value="Payment"> <?php } ?></td>

 <td><input type="button" class="btn btn-primary" onclick="window.open('lead_entry1.php?id=<?php echo $_row['Lead_id'];?>&excelid=0','_self');" value="Edit"></td>

	
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
                                
                                    </tbody>
                                </table>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
                        
        </div>
        </form>
    </section>

</main>
<?php include('belowScript.php');?>
<!--page specific scripts for demo-->
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
</body>
</html>