<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
   <!-- <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">-->
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<script>
function searchfiltter(){
   var  FromDt=document.getElementById('FromDt').value;
    var  Todt=document.getElementById('Todt').value;
   
    if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }
   else{
   
             $.ajax({
                    type:'POST',
                    url:'MonthWiseSearch_Filtter_test.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt,
                    
                    success:function(msg){
                        // alert(msg);
                        // console.log(msg);
                        $('#setTable').empty();
                             var json=$.parseJSON(msg);
                             console.log(json);
                             for(var i=0;i<json.length;++i){
                          //  alert(json[i].FirstName)

                            var srno=i+1;
                            
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].GenerateMember_Id+'</td><td>'+json[i].FirstName+'</td><td>'+json[i].LastName+'</td><td>'+json[i].MembershipDetails_Level+'</td><td>'+json[i].Expirydate+'</td> <td>'+json[i].MobileNumber+'</td><td>'+json[i].Primary_DateOfBirth+'</td><td>'+json[i].Primary_Anniversary+'</td><td>'+json[i].Primary_Pincode+'</td><td>'+json[i].Primary_mob2+'</td><td>'+json[i].Primary_nameOnTheCard+'</td><td>'+json[i].Primary_AddressType1+'</td><td>'+json[i].Primary_BuldNo_addrss+'</td><td>'+json[i].Primary_Area_addrss+'</td><td>'+json[i].Primary_Landmark_addrss+'</td><td>'+json[i].Primary_MaritalStatus+'</td><td>'+json[i].Spouse_GmailMArrid1+'</td><td>'+json[i].Spouse_DateOfBirth+'</td><td>'+json[i].Spouse_nameOnTheCardMarried+'</td><td>'+json[i].MembershipDetails_Fee+'</td><td>'+json[i].MembershipDts_GST+'</td><td>'+json[i].MembershipDts_GrossTotal+'</td><td>'+json[i].MembershipDts_PaymentDate+'</td><td>'+json[i].MembershipDts_PaymentMode+'</td><td>'+json[i].MembershipDts_InstrumentNumber+'</td><td>'+json[i].booklet_Series+'</td><td>'+json[i].entryDate+'</td><td>'+json[i].sales_associate+'</td><td>'+json[i].type+'</td></tr>');
                          }
                     
                      document.getElementById('qr').value="";
                      document.getElementById('qr').value=json['0'].Qry;
               
                   document.getElementById('qr1').value="";
                      document.getElementById('qr1').value=json['0'].Qry;
                       document.getElementById('From1').value="";
                      document.getElementById('From1').value=json['0'].FromDat;
                       document.getElementById('To1').value="";
                      document.getElementById('To1').value=json['0'].Todt;
               
                   
                    }
                })
    }
    }
    </script>
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
                                <i class="mdi mdi-table "></i></span> All Member REPORT 
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
  	/*  $View="select Primary_Title,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,entryDate,Spouse_Title,Spouse_FirstName,Spouse_LastName,Primary_MaritalStatus from Members where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and DATE(entryDate)='".date("Y-m-d")."'";
      $qrys=mysqli_query($conn,$View);
*/
?>-
                        <div class="card-body">
                                   <div class="form-row">
                              
                                  
                                   <div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt" autocomplete="off" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" autocomplete="off" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>
                            
                            
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                     <th>srno</th>                            
                                        <th> Member_Id</th>
                                         <th> FirstName</th>
                                         <th> LastName</th> 
                                          <th> Level</th>
                                          <th> Expiry Date</th>
                                          <th> MobileNumber</th>
                                          <th> DateOfBirth</th>
                                          <th> Anniversary</th>
                                          <th> Pincode</th>
                                          <th> Primary_mob2</th>
                                          <th> Primary_nameOnTheCard</th>
                                          <th> AddressType1</th>
                                          <th> BuldNo_addrss</th>
                                          <th> Area_addrss</th>
                                          <th> Landmark_addrss</th>
                                          <th> MaritalStatus</th>
                                          <th> Spouse_Gmail</th>
                                          <th> Spouse_DOB</th>
                                           <th> Spouse_NameOfCard</th>
                                          <th> MembershipFee</th>
                                           <th> Membership_GST</th>
                                            <th> Membership_GrossTotal</th>
                                             <th> Membership_PaymentDate</th>
                                              <th> Membership_PaymentMode</th>
                                               <th> MembershipInstrumentNum</th>
                                                <th> booklet_Series</th>
                                                 <th> entryDate</th>
                                                 <th>Sales Associate</th>
                                                 <th>Type</th>
                                                 
                                          
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                        
                                        
                                                                   	<?php 
	/*	$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
			    $sql2="select FirstName,LastName from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
			    
	$sql3="SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	//echo $sql2;
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);

	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
  	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	

    $dd=date('Y-m-d', strtotime($_row['entryDate']));

	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
    //  $R=  date("d-m-Y",$d);
$formattedValue = date("F, Y", $d);
$R=$formattedValue;

*/
  ?>
                             <tr>
    <td><?php echo $srn;?></td>
    <td><?php echo $_row['Primary_Title']; ?></td>
    <td><?php echo $sql2fetch['FirstName']." ".$sql2fetch['LastName']; ?></td>
	<td><?php echo $_row['GenerateMember_Id']; ?></td>
    <td><?php echo $sql3fetch['level_name']; ?></td>
	<td><?php echo $R; ?></td>


			</tr>
			
			<?php 
			
		//	   $srn++;
		//	}			
			?>
	                     </tbody>
                                    <tfoot>
                                    <tr>
                                         <th>srno</th>                            
                                        <th> Member_Id</th>
                                         <th> FirstName</th>
                                         <th> LastName</th> 
                                          <th> Level</th>
                                          <th> Expiry Date</th>
                                          <th> MobileNumber</th>
                                          <th> DateOfBirth</th>
                                          <th> Anniversary</th>
                                          <th> Pincode</th>
                                          <th> Primary_mob2</th>
                                          <th> Primary_nameOnTheCard</th>
                                          <th> AddressType1</th>
                                          <th> BuldNo_addrss</th>
                                          <th> Area_addrss</th>
                                          <th> Landmark_addrss</th>
                                          <th> MaritalStatus</th>
                                          <th> Spouse_Gmail</th>
                                          <th> Spouse_DOB</th>
                                          <th> Spouse_NameOfCard</th>
                                          <th> MembershipFee</th>
                                            <th> Membership_GST</th>
                                            <th> Membership_GrossTotal</th>
                                            <th> Membership_PaymentDate</th>
                                            <th> Membership_PaymentMode</th>
                                            <th> MembershipInstrumentNum</th>
                                            <th> booklet_Series</th>
                                            <th> entryDate</th>
                                          <th>Sales Associate</th>
                                          <th>Type</th>
                                                 
                                         </tr>
                                    </tfoot>
                                </table>
                            </div>    <div class="row">
            
            <div class="cols-md-8">
        <form name="frm" method="post" action="export_AllMember_monthwise_report.php" target="_new">
<input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
</div>&nbsp;&nbsp;
<!-- <div class="cols-md-4">
<form name="frm" method="post" action="Leadpdf/report.php" target="_new">
<input type="hidden" name="qr1" id="qr1" value="<?php echo $View; ?>" readonly>
<input type="hidden" name="From1" id="From1"  readonly>
<input type="hidden" name="To1" id="To1"  readonly>
<input type="submit" name="cmdsub" value="Generate PDF" class="btn btn-primary">
</form>
</div>--></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    
        
    </section>

</main>
<?php include('belowScript.php');?>
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->
</body>
</html>
<script>
    $(document).ready(function() {
    $("#rightclick").on("contextmenu",function(e){
       return false;
    }); 
}); 
</script>