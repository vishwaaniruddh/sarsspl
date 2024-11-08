<?php
session_start();
include("config.php");
// menu of Admin
function masteradmin()
{
?>
 <li class=""><a href="#"> Alerts</a>
 <ul>
 <li><a href="view_callalert.php">View Call Alerts</a>
 <li><a href="view_alert.php">View Branch Alerts</a></li></ul>
 </li>
 

 </li>
 <li><a href="#">Site&nbsp;&nbsp;&nbsp;&nbsp;</a>
  <ul>
    <li><a href="newsite.php">Add New Site  </a></li>
    <li><a href="newsitelevel1.php">Edit Site(level1) </a></li>
     <li><a href="opermanagerapp.php">Approve Site(level2)</a></li>
   <li><a href="view_site.php">View Site</a></li>
   <li><a href="tempsite.php">Temp Sites</a>
  </ul>
 </li>
 <li><a href="#">Calls &nbsp;&nbsp;&nbsp;</a>
 <ul> 
 <li><a href="service.php">Service Call </a></li>
 <li><a href="newalert.php">New Installation</a></li>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
 </ul></li>
 <li><a href="#">Branch&nbsp;&nbsp;&nbsp;</a>
  <ul>
  <li><a href="newcty_head.php">Add New </a></li>
   <li><a href="view_cityhead.php">View Branch</a></li>
 
  </ul>
 </li>
  <li><a href="#">Assets</a>
  <ul>
   <li><a href="NewAssets.php">Add New Assets </a></li>
   <li><a href="view_assets.php">View Assets</a></li>
   
   
  </ul>
 </li>
 <li><a href="#">Engineer&nbsp;&nbsp;&nbsp;</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
   <li><a href="newarea_eng.php">Add New Engineer </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
  </ul>
  
 </li>
 <li><a href="#">Reports&nbsp;&nbsp;&nbsp;</a>
 <ul>
 <li><a href="catwiserep.php">Category Wise Report</a></li>
 <li><a href="engperforma.php">Engineer Performance Report</a></li>
 </ul>
 </li>
 <li>
 <?php
 include("config.php");
 $cnt=0;
 $qry='';
 if($_SESSION['branch']!='all')
 {
 $br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";

$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 }
 else
 $qry="select * from transfersites where approval='0' and status='0'";
 
 //echo $qry;
  ?>
 <a href="transfercall.php">Transferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con,$qry)); ?></sup></font></a></li>
 <?php
}
function Admin()
{
//echo "Admin menu";
?>
 <li><a href="view_alert.php">Home&nbsp;&nbsp;</a></li>
 <li><a href="#">Site</a>
  <ul>
    <li><a href="newsite.php">Add New </a></li>
   <li><a href="view_site.php">View Site</a></li>
    <li><a href="tempsite.php">Temp Sites</a>
  </ul>
 </li>
 <li><a href="#">Branch</a>
  <ul>
  <li><a href="newcty_head.php">Add New </a></li>
   <li><a href="view_cityhead.php">View Branch</a></li>
 
  </ul>
 </li>
  <li><a href="#">Assets</a>
  <ul>
   <li><a href="NewAssets.php">Add New Assets </a></li>
   <li><a href="view_assets.php">View Assets</a></li>
   
   
  </ul>
 </li>
 <li><a href="#">Engineer</a>
  <ul>
   <li><a href="newarea_eng.php">Add New </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
   
   
  </ul>
 </li>
<?php
 include("config.php");
 $cnt=0;
 $qry='';
 if($_SESSION['user']!='admin')
 {
 $br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";

$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 }
 else
 $qry="select * from transfersites where approval='0' and status='0'";
 
 //echo $qry;
  ?>
 <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con,$qry)); ?></sup></font></a></li>
 <?php
    
}
// menu of call center
function Call()
{
	?>
   <li class="current"><a href="view_callalert.php">View Alerts</a></li>

   <li><a href="#">Calls </a>
   <ul>
   <li><a href="service.php">Add New </a></li>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
   <?php if($_SESSION['user']=='Sneha'){ ?>  <li><a href="newalert.php">New Installation</a></li><?php } ?>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
 </ul>
   </li>
 
    <?php
}

//menu of Branch Head
function BranchHead()
{ ?>
<li><a href="view_alert.php"> Alerts</a></li>	
 <li><a href="newarea_eng.php">Engineer</a>
 <ul>
  
   
   <li><a href="view_areaeng.php">View Records</a></li> </ul>
   <?php
 include("config.php");
 $cnt=0;
 $qry='';
 
 $br1=str_replace(",","','",$_SESSION['branch']);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
//echo "Select * from transfersites where state in (".$br2.") and approval='0' and status='0'";
$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 
 
//echo $qry;
  ?>
<li> <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con,$qry)); ?></sup></font></a></li>
 <?php
   ?>
 
<?php }

//menu of Engineer
function Engineer()
{
	?>
    <li><a href="eng_alert.php">View Alerts</a></li>
   
  <ul>
   
   <li><a href="view_areaeng.php">View Records</a></li>
   
   
  </ul>
    <?php
}



function Accmgr()
{
	?>
   <li><a href="#">Site</a>
  <ul>
  
    <li><a href="newsite.php">Add New Site(Upload)</a></li>
    <li><a href="takeovernew.php">Site Takeover(Form)</a></li>
    <li><a href="newsitelevel1.php">Edit Site(level1)</a></li>
      <li><a href="view_site.php">View Site</a></li>
      <li><a href="pendingebills.php">Ebill Due Sites</a></li>
  </ul>
 </li>
 
 <?php
 
if($_SESSION['id']=="218" || $_SESSION['id']=="499")
{
 ?>
 
 <li><a href="#">Online Transaction</a>
  
 <ul>
 <li><a href="new_uploadwork.php">Online Transaction Upload</a></li>
 <li><a href="new_uploaded_view.php">Online Transaction View</a></li>
 <li><a href="new_upload_img.php">Upload Receipt/Bill Copy</a></li>
 

 </ul>
 </li>
 
 <?php } ?>
 
 <li><a href="#">Approval</a>
  <ul>
    <li><a href="showerrsites.php">Approve Error Sites  </a></li>
   <li><a href="handoverreq.php">Handover Sites  Request</a></li>
     
  </ul>
 </li>
 <?php
   $edtqt=0;
   $sqlqt="select count(quotid) from quotation where status='1'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt=mysqli_query($con,$sqlqt);
   $qtr=mysqli_fetch_row($qt);
   $edtqt=$qtr[0];
   
   $sqlqt2="select count(quotid) from quotation where status='20' and clientappdate='0000-00-00'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt2.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt2=mysqli_query($con,$sqlqt2);
   $qtr2=mysqli_fetch_row($qt2);
   $edtqt2=$qtr2[0];
   ?>
 <li><a href="#">Service</a>
  <ul>
    <!--<li><a href="servicecall.php">Log Call </a></li>-->
   <!--<li><a href="view_alert.php">View Call</a></li>-->
   
   <!--<li><a href="viewquot2.php">View Quotation <table><tr>
   <td><img src='myfunction/edit.png' tile='Edit Quotation' alt='Edit Quotation' height="10px" width="10px"><sup><?php echo $edtqt; ?></sup></a></td>
   <td><img src='myfunction/client.jpg' tile='Waiting for Client Approval' alt='Waiting for Client Approval' height="10px" width="10px"><sup><?php echo $edtqt2; ?></sup></a></td>
   
   </tr></table></a>
  </li>-->
     <!--<li><a href="view_callalert.php">View MIS Report</a></li>-->
    
    <li><a href="quotation.php">Quotation</a></li>
    <li><a href="quotation1.php">Quotation Kotak Delhi</a></li>
    <li><a href="quotation_approve.php">View Quotation</a></li>
    <li><a href="view_quotfundreq_det.php">R&M Fund Process</a></li>
    <li><a href="City.php">Add City</a></li>
    <li><a href="newquot1misrep.php">MIS Report</a></li>
    <li><a href="excelLeadImport.php">Import Excel</a></li>
     <!---<li><a href="view_quotfundreq_det.php">Edit Quotation</a></li>-->
     
     
  </ul>
 </li>
 
  <li><a href="#">Call Log</a>
   <?php
   $edtqt=0;
   $sqlqt="select count(quotid) from quotation where status='1'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt=mysqli_query($con,$sqlqt);
   $qtr=mysqli_fetch_row($qt);
   $edtqt=$qtr[0];
   
   $sqlqt2="select count(quotid) from quotation where status='20' and clientappdate='0000-00-00'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt2.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt2=mysqli_query($con,$sqlqt2);
   $qtr2=mysqli_fetch_row($qt2);
   $edtqt2=$qtr2[0];
   ?>
  <ul>
   <li><a href="servicecall.php">Log Call </a></li>
    <li><a href="newcall_log_misrep.php">View Call NEW</a></li>
   <!--<li><a href="view_alert.php">View Call</a></li>
   
   <li><a href="viewquot2.php">View Quotation <table><tr>
   <td><img src='myfunction/edit.png' tile='Edit Quotation' alt='Edit Quotation' height="10px" width="10px"><sup><?php echo $edtqt; ?></sup></a></td>
   <td><img src='myfunction/client.jpg' tile='Waiting for Client Approval' alt='Waiting for Client Approval' height="10px" width="10px"><sup><?php echo $edtqt2; ?></sup></a></td>
   
   </tr></table></a>
  </li>
     <li><a href="view_callalert.php">View MIS Report</a></li>-->
  
     
  </ul>
  
 </li>
 
 
 
 <!--<li><a href="#">Transfer Sites</a>
  <ul>
    <li><a href="viewtransfersites.php">Transferred Sites (OUT)  </a></li>
    <li><a href="viewtransfersitesin.php">Transferred Sites (IN) </a></li>
     
  </ul>
  
 </li>-->
 <li><a href="#">Branch Head</a>
  <ul>
    <li><a href="newcty_head.php">New Branch Head </a></li>
   <!--<li><a href="view_alert.php">View Branch Call</a></li>-->
     <li><a href="view_cityhead.php">View Branch Head</a></li>
  </ul>
 </li>
 <!--<li><a href="#">Supervisor</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
   <li><a href="newarea_eng.php">New Supervisor </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
  </ul>
  -->
  
 </li>
 <!--<li><a href="#">RNM</a>
  <ul>
  <li><a href="quotcreation.php">Create Quotation</a></li>
    <li><a href="viewquot2.php">View Quotation</a></li>
   <li><a href="requestquot.php">RNMFund Request</a></li>
    <li><a href="epayannex.php">EBill transferred Fund</a></li> 
  </ul>
 </li>-->
  <li><a href="#">EBill</a>
  <ul>
    <li><a href="ebillfundrequest.php">EBill Fund Request</a></li>
    <li><a href="ebillonlinerequest.php">EBill Online Request</a></li>
    <li><a href="new_erecharge_template.php">Template Recharge</a></li>
   <li><a href="view_er_template.php">View Templates Recharge</a></li>
    <!--<li><a href="rechargereq.php">Recharge</a></li>-->
    <li><a href="ebillreqapprovals.php">EBill Request Approval</a></li>
     <li><a href="epayannex.php">EBill transferred Fund</a></li>    
      <li><a href="ebnotreceived.php">EBill Not Received</a></li>
      <li><a href="view_attach_email_pending.php">Email Attachment</a></li>
   <li><a href="maxduedt.php" target="_blank">Max Paid Date</a></li>
  </ul>
 </li>
 <li><a href="#">RNM</a>
  <ul>
    
    <!--<li><a href="rnmpayannex.php">R&M Fund transfer</a></li>-->
<li><a href="quottransview.php">R&M Transfer </a></li>
         
  </ul>
 </li>
 <!--<li><a href="#">Template</a>
  <ul>
    <li><a href="new_erecharge_template.php">New Template</a></li>
   <li><a href="view_er_template.php">View Templates</a></li>
     
  </ul>
  </li>-->
  <?php
  	if($_SESSION['serviceauth']==2)
  	{
  ?>
  <li><a href="#">Reversal</a>
  <ul>
    <li><a href="view_ebfundtrans_sv.php">Fund Reversal/Transfer</a></li>    
    <li><a href="view_status_sv.php">View Fund Reversal/Transfer</a></li>
  </ul>
 </li>
 
 <li><a href="#">Update Receipt</a>
  <ul>
    <li><a href="view_updatereceiprt_req.php">Receipt Update</a></li>
    <li><a href="view_dispatch_req_scncpy.php">Upload Update Scan Copy</a></li>
    <li><a href="view_dispatch_req.php">Dispatch Receipt</a></li>
    <li><a href="view_dispatch_raised.php">View Dispatched Receipt</a></li>
  </ul>
 </li>
 
  <li><a href="due_ebill_7days.php">Due E-Bill</a></li>
    <?php
    	}
}

function tis(){
    ?>
     <li><a href="#">Service &nbsp;&nbsp;&nbsp;</a>
  <ul>
    <li><a href="quotation_tis.php">Quotation Tis</a></li>
    <li><a href="quotation_approve_tis.php">Quotation View Tis</a></li>
    <li><a href="view_quotfundreq_det_tis.php">R&M TIS Fund Process </a></li>
  </ul>
 </li>
 
  
    
<?php }



function opermgr()
{
	?>
   <li><a href="#">Site &nbsp;&nbsp;&nbsp;</a>
  <ul>
    <li><a href="view_site.php">View     Site</a></li>
     <li><a href="opermanagerapp.php">Approve Site (level 2)</a></li>
   <li><a href="pendingebills.php">Ebill Due Sites</a></li>
   <!--<li><a href="tempsite.php">Temp Sites</a>-->
  </ul>
 </li>
 <li><a href="#">Approval &nbsp;&nbsp;&nbsp;</a>
  <ul>
    <li><a href="showerrsites.php">Approve Error Sites  </a></li>
    <li><a href="viewtransfersitesin.php">Transferred Sites (IN) </a></li>
      <li><a href="handoverreq.php">Handover Sites  Request</a></li>
  </ul>
 </li>
 <li>
 <?php
   $edtqt=0;
   $sqlqt="select count(quotid) from quotation where status='3'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt=mysqli_query($con,$sqlqt);
   $qtr=mysqli_fetch_row($qt);
   $edtqt=$qtr[0];
   
   $sqlqt2="select count(quotid) from quotation where status='3'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt2.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt2=mysqli_query($con,$sqlqt2);
   $qtr2=mysqli_fetch_row($qt2);
   $edtqt2=$qtr2[0];
   ?>
 <a href="#">Service</a>
  <ul>
    <li><a href="servicecall.php">Log Call </a></li>
   <li><a href="view_alert.php">View Call</a></li>
   <!--<li><a href="viewquot2.php">Quotation Request Approval</a></li>-->
     <li><a href="view_callalert.php">View MIS Report</a></li>
     <li><a href="newatmasst.php" target="_new">New RNM Issue</a></li>
  </ul>
 </li>
 <!--<li><a href="#">Transfer Sites</a>
  <ul>
    <li><a href="viewtransfersites.php">Transferred Sites  </a></li>
   
     
  </ul>
  
 </li>-->
 <li><a href="#">Branch Head</a>
  <ul>
    <li><a href="newcty_head.php">New Branch Head </a></li>
   <!--<li><a href="view_alert.php">View Branch Call</a></li>-->
     <li><a href="view_cityhead.php">View Branch Head</a></li>
  </ul>
 </li>
 <li><a href="#">Supervisor</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
   <li><a href="newarea_eng.php">New Supervisor </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>
 <li><a href="sup3.php">Supervisor Outstanding 15-16</a></li>
  </ul>
  
 </li>
 <!-- <li><a href="#">Quotation</a>
  <ul>
  
     
  </ul>
 </li>-->
  <li><a href="#">Ebill</a>
  <ul>
 <li><a href="ebillfundrequest.php">EBill Fund Request</a></li>
 <li><a href="rechargereq.php">Recharge</a></li>
    <li><a href="ebillreqapprovals.php">EBill Request Approval</a></li>
     <li><a href="epayannex.php">EBill transferred Fund</a></li>  
      <li><a href="ebnotreceived.php">EBill Not Received</a></li>
   <li><a href="maxduedt.php" target="_blank">Max Paid Date</a></li>
     
  </ul>
 </li>
 <li><a href="#">RNM</a>
  <ul>
   
    <li><a href="rnmpayannex.php">R&M Fund transfer</a></li>
       <li><a href="viewquot2.php">R&M Fund Approval<table><tr>
   
   <td><img src='myfunction/client.jpg' tile='Pending Approval' alt='Pending Approval' height="10px" width="10px"><sup><?php echo $edtqt2; ?></sup></a></td>
   
   </tr></table></a></li>
  <!--<li><a href="requestquot.php">Request Quotation</a></li>-->
  </ul>
 </li>
 
    <?php
}
function branchmgr()
{
	?>
  
  <li><a href="#">Fund</a>
  <ul>
    <!--<li><a href="fundlevel1.php">Fund Transfer Approval</a></li>
   <li><a href="requestamt.php">Fund Request</a></li>-->
   <li><a href="ebillfundrequest.php">E-Bill Fund Request</a></li>
   <li><a href="ebillonlinerequest.php">E-Bill Online Request</a></li> 
  </ul>
 </li>
 <li><a href="#">Request</a>
  <ul>
  <li><a href="ebillreqapprovals.php">EBill Request Status</a></li>
   
  </ul>
 </li>
  <li><a href="#">Reports</a>
    <ul>
        <li><a href="sup2.php">Supervisor Outstanding</a></li>
 <li><a href="sup3.php">Supervisor Outstanding 15-16</a></li>
  <li><a href="sup4.php">Supervisor Outstanding 16-17</a></li>
<li><a href="sup5.php">Supervisor Outstanding 17-18</a></li>
    </ul>
 </li>
 <?php
   $edtqt=0;
   $sqlqt="select count(quotid) from quotation where status='1'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt=mysqli_query($con,$sqlqt);
   $qtr=mysqli_fetch_row($qt);
   $edtqt=$qtr[0];
   
   $sqlqt2="select count(quotid) from quotation where status='20' and clientappdate='0000-00-00'";
   if(isset($_SESSION['custid']) && $_SESSION['custid']!='' && $_SESSION['custid']!='-1' && $_SESSION['custid']!='all' && $_SESSION['custid']!='All')
   {
    $sqlqt2.=" and cust_id='".$_SESSION['custid']."'";
   }
   //echo $sqlqt;
   $qt2=mysqli_query($con,$sqlqt2);
   $qtr2=mysqli_fetch_row($qt2);
   $edtqt2=$qtr2[0];
   ?>
 <li><a href="#">Service</a>
  <ul>
 <li><a href="quotation.php"> Quotation</a></li>
<li><a href="sup_view_quot.php">View Quotation</a></li>
<li><a href="view_quotfundreq_det.php">R&M Fund Process</a></li>
<li><a href="City.php">Add City</a></li>
<li><a href="newquot1misrep.php">MIS Report</a></li>
  <!---<li><a href="quotation_approve.php">View Quotation</a></li>-->

    <!---<li><a href="servicecall.php">Log Call </a></li>
   <li><a href="view_alert.php">View Call</a></li>
   
   <li><a href="viewquot2.php">View Quotation <table><tr>
   <td><img src='myfunction/edit.png' tile='Edit Quotation' alt='Edit Quotation' height="10px" width="10px"><sup><?php echo $edtqt; ?></sup></a></td>
   <td><img src='myfunction/client.jpg' tile='Waiting for Client Approval' alt='Waiting for Client Approval' height="10px" width="10px"><sup><?php echo $edtqt2; ?></sup></a></td>
   
   </tr></table></a>
  </li>
     <li><a href="view_callalert.php">View MIS Report</a></li>
     <li><a href="newatmasst.php" target="_new">New RNM Issue</a></li>-->
  </ul>
 </li>
 
  <li><a href="quottransview.php">R&M Transfer</a>

 
  <li><a href="#">Reversal</a>
  <ul>
    <li><a href="view_ebfundtrans_sv.php">Fund Reversal/Transfer</a></li>    
    <li><a href="view_status_sv.php">View Fund Reversal/Transfer</a></li>
    <li><a href="view_ebfundtrans_transfer_app.php">View Transfer Approval</a></li>
  </ul>
 </li>
 <li><a href="#">Update Receipt</a>
  <ul>
    <li><a href="view_updatereceiprt_req.php">Receipt Update</a></li>
    <li><a href="view_dispatch_req_scncpy.php">Upload Update Scan Copy</a></li>
    <li><a href="view_dispatch_req.php">Dispatch Receipt</a></li>
    <li><a href="view_dispatch_raised.php">View Dispatched Receipt</a></li>
  </ul>
 </li>
  <li><a href="due_ebill_7days.php">Due E-Bill</a></li>
  
 
 
 <!--<li><a href="#">RNM</a>
  <ul>
  <li><a href="quotcreation.php">Create Quotation</a></li>
    <li><a href="viewquot2.php">View Quotation</a></li>
   <li><a href="requestquot.php">RNMFund Request</a></li>
     
  </ul>
 </li>-->
 
 
<!--  <li><a href="#">Takeover</a>
  <ul>
    <li><a href="takeovernew.php">Site Takeover</a></li>
  
  </ul>
 </li>
 <li><a href="#">Handover</a>
  <ul>
    <li><a href="handover2.php">Site handover</a></li>
   
     
  </ul>
 </li>-->
    <?php
}
function bankmgr()
{
	?>
  
  <li><a href="#">Fund</a>
  <ul>
    <li><a href="fundlevel1.php">Fund Transfer Approval</a></li>
   <li><a href="requestamt.php">Fund Request</a></li>
     
  </ul>
 </li>
  <li><a href="#">Quotation</a>
  <ul>
    <li><a href="viewquot.php">View Quotation</a></li>
  <!-- <li><a href="requestquot.php">Request Quotation</a></li>-->
     
  </ul>
 </li>
    <?php
}
function rnmAdmin()
{
	?>
  
  <li><a href="view_rnm_now.php">NOW</a>
  <!--
  <ul>
    <li><a href="fundlevel1.php">Fund Transfer Approval</a></li>
   <li><a href="requestamt.php">Fund Request</a></li>
     
  </ul>
  -->
 </li>
  <li><a href="#">Ratelist</a>
    <ul>
        <li><a href="rnm_addcss_ratelist.php">CSS Ratelist</a></li>
        <li><a href="rnm_addcust_ratelist.php">Customert Ratelist</a></li>
    </ul>
 </li>
    <?php
}
function branch_manager()
{
	?>
  
  <li><a href="#">E Sites</a>
  <ul>
    <li><a href="electricbills.php">Ebill Sites</a></li>
   <li><a href="sitespool.php">Ebill Site Spooling</a></li>     
  </ul>
 </li>
  <li><a href="#">Reports</a>
    <ul>
        <li><a href="#">Outstanding Report</a></li>
        <li><a href="pendingebills.php">Request Due</a></li>
        <li><a href="sup2.php">Supervisor Outstanding</a></li>
        <li><a href="ebnotreceived.php">Ebill Not Received</a></li>
    </ul>
 </li>
 <li><a href="#">Fund Request</a>
  <ul>
    <!--<li><a href="newsitelevel1.php">Approval request only from Account Manager</a></li>-->
    <li><a href="ebillfundrequest.php">Ebill Fund</a></li>
   <li><a href="ebillreqapprovals.php">Ebill Request Approval</a></li>     
  </ul>
 </li>
 <li><a href="#">View Section</a>
  <ul>
    <!--<li><a href="oldeinvoice.php">View Invoice</a></li>-->
   <li><a href="maxduedt.php">Max Paid Date</a></li>
  </ul>
 </li>
 <li><a href="#">Ebill</a>
  <ul>
   <li><a href="new_erecharge_template.php">New Template</a></li>  
   <li><a href="view_er_template.php">View Template</a></li>   
  <li><a href="ebillonlinerequest.php">Ebill Online Request</a></li>    
  </ul>
 </li>
 <li><a href="#">Reversal</a>
  <ul>
    <li><a href="view_ebfundtrans_sv.php">Fund Reversal/Transfer</a></li>    
    <li><a href="view_status_sv.php">View Fund Reversal/Transfer</a></li>
    <!--<li><a href="view_ebfundtrans_transfer_app.php">View Transfer Approval</a></li>-->
  </ul>
 </li>
 <li><a href="#">Update Receipt</a>
  <ul>
    <li><a href="view_updatereceiprt_req.php">Receipt Update</a></li>
    <li><a href="view_dispatch_req_scncpy.php">Upload Update Scan Copy</a></li>
    <li><a href="view_dispatch_req.php">Dispatch Receipt</a></li>
    <li><a href="view_dispatch_raised.php">View Dispatched Receipt</a></li>
  </ul>
 </li>
    <?php
}
function iciciquotation()
{
?>
<li><a href="#">Service</a>
  <ul>
    <li><a href="iciciquotation.php">Quotation</a></li>
   <li><a href="icici_quot_view.php">View Quotation</a></li>   
   <li><a href="view_quotfundreq_det.php">R&M Fund Process</a></li> 
    
  </ul>
  
 </li>
 <li><a href="quottransview.php">R&M Transfer</a></li>
 
 <?php } ?>