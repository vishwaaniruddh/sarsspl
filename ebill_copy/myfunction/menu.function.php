<?php
session_start();
// menu of Admin
include("config.php");
function masteradmin()
{
?>
<li><a href="#">Fund Request</a>
  
 <ul>
 <li><a href="ebillreqapprovals.php">EBill Request Approval</a></li>
 <li><a href="initiatedfund.php">Initiated EB Fund</a></li>
 <li><a href="fundlevel1.php">Fund Request Approval</a></li>
 </ul>
 </li>
 <li><a href="#">RNM</a>
  <ul>
    <!--<li><a href="viewquot.php">RNM Request Approvals</a></li>
 <li><a href="rnmpayannex.php">Transferred RNM Fund</a></li>-->
 <li><a href="view_quotrans.php">View Transactions</a></li>
     
  </ul>
 </li>
 <li><a href="#">OnAccount</a>
  <ul>
    <!--<li><a href="onaccreq.php">On Account Request</a></li>-->
  <li><a href="onaccview.php">View Request</a></li>
     
  </ul>
 </li>
 <li><a href="#">Outstanding Report</a>
  <ul>
   
  <!--<li><a href="supos.php">Supervisor Outstanding</a></li>-->
   <li><a href="clientosrep.php">Client Outstanding</a></li>  
  </ul>
 </li>
 <li><a href="#">Reports</a>
  
 <ul>
 <li><a href="ebillrepmonthwiae.php">Monthwise Ebill Report</a></li>
 <li><a href="ebmis.php">E-Billing Mis Report</a></li>
 <li><a href="ebnotreceived.php">EBill Not Received</a></li>
 <!--<li><a href="fundlevel1.php">Fund Request Approval</a></li>-->
 </ul>
 </li>
 <li><a href="#">Supervisor</a>
  <ul>
    <li><a href="newaccountme.php">New Supervisor</a></li>
  <li><a href="viewaccountme.php">View Supervisor</a></li>
     
  </ul>
 </li>
 <?php
}

function finance()
{
?>
<?php
if($_SESSION['serviceauth']=='1')
{
?>
<li><a href="#">Fund Request</a>
  
 <ul>
 <li><a href="ebillreqapprovals.php">EBill Request Approval</a></li>
 <li><a href="initiatedfund.php">Initiated EB Fund</a></li>
 <li><a href="fundlevel1.php">Fund Request Approval</a></li>
 <li><a href="epayannex.php">EBill Fund</a></li>
 </ul>
 </li>

<li><a href="#">Salary</a>
  
 <ul>
 <li><a href="salary_fr.php">Salary approval</a></li>
  <li><a href="view_salarytransac.php">Salary Transaction</a></li>


 </ul>
 </li>
 <?php } ?>
 <?php
if($_SESSION['serviceauth']==('2' or '1'))
{
?>
<li><a href="#">Repair & Maintenance</a>
  <ul>
    <!--<li><a href="viewquot.php">RNM Fund Approval</a></li>
  <li><a href="rnmpayannex.php">Transferred RNM Fund</a></li>-->
  <li><a href="view_quot_fr.php">RNM Fundrequests </a></li>
  <li><a href="view_transfervijay.php">LOCAL RNM Fundrequests </a></li>
    <li><a href="quottransview.php">R&M Fund Transfer </a></li> 
  </ul>
 </li>
 <?php } ?>
 <li><a href="#">OnAccount</a>
  <ul>
  <?php
if($_SESSION['serviceauth']=='1')
{
?>
    <li><a href="onaccreq.php">On Account Request(EB)</a></li>
  <li><a href="onaccview.php">On Account transfer(EB)</a></li>
    <?php } ?>
    <?php
if($_SESSION['serviceauth']==('2' or '1'))
{
?>
    <li><a href="rnmonaccreq.php">On Account Request(RNM)</a></li>
  <li><a href="rnmonaccview.php">On Account transfer(RNM)</a></li>
    <?php } ?>
  </ul>
 </li>
 
 <li><a href="#">Transactions</a>
  <ul>
  <?php
if($_SESSION['serviceauth']=='1')
{
?>  <li><a href="transactionsme.php">View Ebill Transactions</a></li>
   <li><a href="view_quotrans.php">View Transactions</a></li>
<?php } ?>
<?php
if($_SESSION['serviceauth']==('2' or '1'))
{
?> 
    <li><a href="rnmtrans.php">View RNM Transactions</a></li>
    <?php
    }
    ?>
 <!-- <li><a href="onaccview.php">View Request</a></li>-->
     
  </ul>
 </li>
 <li><a href="#">Outstanding Report</a>
  <ul>
   <?php
if($_SESSION['serviceauth']=='1')
{
?> 
  <li><a href="supos.php">Supervisor Outstanding</a></li>

  <?php
  }
  ?>
   <?php
//if($_SESSION['serviceauth']==('2' or '1'))
//{
?> 
<li><a href="sup2.php">Supervisor Outstanding</a></li>
<li><a href="sup3.php">Supervisor Outstanding 15-16</a></li>
<li><a href="sup4.php">Supervisor Outstanding 16-17</a></li>
<li><a href="sup5.php">Supervisor Outstanding 17-18</a></li>
  <li><a href="suposrnm.php">Supervisor Outstanding(RNM)</a></li>
  <li><a href="ebmis.php">E-Billing Mis Report</a></li>
 
 
 
 <?php
// }
 ?>    
  </ul>
 </li>
 <?php
 if($_SESSION['serviceauth']=='1')
{
?> 
  <li><a href="#">Reversal</a>
  <ul>
    <li><a href="view_ebfundtrans_app.php">View Approval Reversal Supervisor</a></li>
<li><a href="view_onaccount_sv.php">Raise Reversal </a></li>
<li><a href="view_onaccountstatus_sv.php">View Status</a></li>
  </ul>
 </li>
  <?php
  }
  
  ?>
 <?php
}

function financeop()
{
?>
<li><a href="#">Paid Fund</a>
  
 <ul>
 <li><a href="epayannex.php">EBill Fund</a></li>
<li><a href="ebillreqapprovals.php">Arrear EBill Request</a></li>
 </ul>
 </li>
 <li><a href="#">Pending ESites</a>
  
 <ul>
 <li><a href="pendingebills.php">View Sites</a></li>
 
 </ul>
 </li>
<li><a href="#">Reports</a>
  
 <ul>
 <li><a href="ebillrepmonthwiae.php">Monthwise Ebill Report</a></li>
 <li><a href="ebmis.php">E-Billing Mis Report</a></li>
 <!--<li><a href="fundlevel1.php">Fund Request Approval</a></li>-->
 </ul>
 </li>
 <li><a href="#">Outstanding Report</a>
  <ul>
   
  <!--<li><a href="supos.php">Supervisor Outstanding</a></li>-->
     
  </ul>
 </li>
<li><a href="#">Quotation</a>
  <ul>
    <li><a href="viewquot.php">View Quotation</a></li>
  <li><a href="rnmpayannex.php">Transferred RNM Fund</a></li>
     
  </ul>
 </li>
 <li><a href="#">Transactions</a>
  <ul>
  <li><a href="transactionsme.php">View Ebill Transactions</a></li>

    <li><a href="rnmtrans.php">View RNM Transactions</a></li>

     
  </ul>
 </li>
 <!-- <li><a href="#">OnAccount</a>
  <ul>
    <li><a href="onaccreq.php">On Account Request</a></li>
  <li><a href="onaccview.php">View Request</a></li>
     
  </ul>
 </li>
 
 <li><a href="#">Transactions</a>
  <ul>
    <li><a href="transactionsme.php">View Transactions</a></li>
  <li><a href="onaccview.php">View Request</a></li>
     
  </ul>
 </li>-->
 <?php
}

function ebill()
{
?>

 <li><a href="#">E Bills Section</a>
 <ul>
 <li><a href="newbillentry2.php">Bill Entry</a></li>
<li><a href="fisnewbillentry.php">Bill Entry FIS</a></li>
<li><a href="viewpaidebill.php">Update Paid Bills</a></li>

 <li><a href="importebill.php">Upload Paid Bills</a></li></ul>
 <li><a href="viewpaidebill.php">View Paid Bills</a></li>
 </li>
<!-- <li><a href="#">Temporary Sites</a>
 <ul>
 <li><a href="level1approve.php">level1 approval</a></li>
 
 </ul>
 </li>-->

 <li><a href="#">Approvals</a>
 <ul>
 <li><a href="errorebill.php">Ebill Error Approval1</a></li>
 <li><a href="viewebreq.php">Ebill Error Approval1</a></li>
 </ul>
 </li>
<?php
}
function ebillexec()
{
?>

 <li><a href="#">E Bills Section</a>
 <ul>
 <li><a href="newbillentry2.php">Bill Entry</a></li>
<li><a href="fisnewbillentry.php">Bill Entry FIS</a></li>
 <li><a href="viewpaidebill.php">Update Paid Bills</a></li>
 <li><a href="generateEbill.php">Generate E-Bills</a></li>
 <li><a href="dispatcheb.php">Dispatch Invoice</a></li>
 <li><a href="electricbills.php"> E-Bill Sites</a></li>
 

 </ul>
 </li>

<li><a href="#">Sites Section</a>
 <ul>
 <li><a href="managesite.php">Sites</a></li>
 </ul>
</li>



 <li><a href="#">View Section</a>
 <ul>

 <li><a href="oldeinvoice.php">View Invoice</a></li>
 <li><a href="ebinvcpy.php">Invoice Copy</a></li>
 <li><a href="maxduedt.php" target="_blank">Max Paid Date</a></li>
<li><a href="view_ebill_package(new).php" >View Ebill Package</a></li>


 </ul>
 </li>





 <li><a href="#">Report Section</a>
 <ul>
 



 <li><a href="ebmis.php">Mis Report</a></li>
 <li><a href="ebnotreceived.php">EBill Not Received</a></li>
 </ul>
 </li>
 
 <?php if($_SESSION['user']=='vaibhav' || $_SESSION['user']=='Rahul Patil'){ ?>
 <li><a href="#">Outstanding Report</a>
 <ul>
 <li><a href="sup2.php">Supervisor Outstanding</a></li>
 <li><a href="sup3.php">Supervisor Outstanding 15-16</a></li>
 </ul>
 </li>
 <li><a href="#">Update Receipt</a>
  <ul>
    <li><a href="view_dispatch_raised.php">View Dispatched Receipt</a></li>
    <!--<li><a href="remv_clubbed.php">Remove clubbed</a></li>--->
  </ul>
 </li>
 <?php
 }
 ?>
 <!--<li><a href="#">E Bills Section</a>
 <ul>
 <li><a href="newbillentry2.php">Bill Entry</a></li>-->
<!--<li><a href="uploadedbill.php">Uploaded Bills</a></li>
 <li><a href="viewpaidebill.php">View Paid Bills</a></li>
 <li><a href="importebill.php">Upload Paid Bills</a></li>--><!--</ul>
 </li>-->
<?php
}
function ebilllevel1()
{
//echo "select * from fundrequest where dept='2'";
?>

 <li><a href="#">E-Sites</a>
 <ul>
 <li><a href="electricbills.php">E-Bill sites</a></li>
 <li><a href="newbillentry2.php">Bill Entry</a></li>
<li><a href="fisnewbillentry.php">Bill Entry FIS</a></li>
 <li><a href="sitespool.php">EBill site spooling</a></li>
 <li><a href="edit_servicecharge.php">Edit Service Charge</a></li>
<!-- <li><a href="updatepaidebill.php">Update Paid Bills</a></li>-->
 </ul>
 <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;Bills&nbsp;&nbsp;&nbsp;&nbsp;</a>
 <ul> <li><a href="viewpaidebill.php">Update Paid Bills</a></li>
 <li><a href="generateEbill.php">Generate E-Bills</a></li>
 <li><a href="dispatcheb.php">Dispatch Invoice</a></li>
 <li><a href="ratechange.php">Edit Sites</a></li>
 <!--<li><a href="importebill.php">Upload Paid Bills</a></li></ul>-->
 <li><a href="ebarchieve.php">EB Archieve</a></li>
 </ul>
 </li>
 
<li><a href="#">Reports</a>
  
 <ul style="overflow-y: scroll; height: 300px;">
 <li><a href="outstandingebill.php">Outstanding Report</a></li>
  <li><a href="pendingebills.php">Request Due</a></li>
  <li><a href="ebmis.php">Mis Report</a></li>
  <li><a href="epayannex.php">EBill Fund</a></li> 
  <!--<li><a href="supos.php">Supervisor Outstanding</a></li>-->
  <li><a href="sup2.php">Supervisor Outstanding</a></li>
 <li><a href="sup3.php">Supervisor Outstanding 15-16</a></li>
  <li><a href="ebnotreceived.php">EBill Not Received</a></li>
<!-- <li><a href="sup4.php">Supervisor Outstanding 16-17</a></li-->
<li><a href="sup5.php">Supervisor Outstanding 17-18</a></li>
<li><a href="sup6.php">Supervisor Outstanding 18-19</a></li>
<li><a href="sup7.php">Supervisor Outstanding 19-20</a></li>
<li><a href="sup8.php">Supervisor Outstanding 20-21</a></li>
<li><a href="sup9.php">Supervisor Outstanding 21-22</a></li>
<li><a href="sup10.php">Supervisor Outstanding 22-23</a></li>
<li><a href="sup11.php">Supervisor Outstanding 23-24</a></li>
 
 </ul>

 <li><a href="#">Approval</a>
 <ul>
 <li><a href="level1ebillapp.php">New Sites</a></li>
 <!--<li><a href="errorebill.php">Ebill Error Approval1</a></li>-->
 
 </ul>
 
 </li>
 <!--<li><a href="#">Quotation</a>
  <ul>
    <li><a href="viewquot.php">View Quotation</a></li>
  <li><a href="requestquot.php">Request Quotation</a></li>
     
  </ul>
 </li>-->
 <?php
 /*$qry=mysqli_query($con,"select * from fundrequest where dept='2'");
 if(mysqli_num_rows($qry)>0){*/
 ?>
  <li><a href="#">Fund Request</a>
  
 <ul>
 <!--<li><a href="requestamt.php">Request for Fund</a></li>-->
 <li><a href="ebillreqapprovals.php">EBill Request Approval</a></li>
 <li><a href="fundlevel1.php">Fund Request Approval</a></li>
 <li><a href="delfrmebpay.php">Remove paid details</a></li>
  <li><a href="cancelinv.php">Unclub</a></li>
 </ul>
 </li>
 <li><a href="#">View Section</a>
 <ul>
 <li><a href="sales_new.php">View Sales</a></li>
 <li><a href="oldeinvoice.php">View Invoice</a></li>
 <li><a href="ebinvcpy.php">Invoice Copy</a></li>
  <li><a href="maxduedt.php" target="_blank">Max Paid Date</a></li>
  <li><a href="view_ebill_package(new).php">View Ebill Package</a></li>
 </ul>
 </li> 
 <li><a href="#">Threshhold</a>
     <ul> 
         <li><a href="add_threshhold.php">Add Threshhold</a></li>
         <li><a href="view_threshhold.php">View Threshhold</a></li>
     </ul>
 </li>
 <li><a href="#">Update Receipt</a>
  <ul>
    <li><a href="view_dispatch_raised.php">View Dispatched Receipt</a></li>
  </ul>
 </li>
 <li><a href="view_attach_email_pending.php">Email Attachment</a></li>
<?php
//}

}

function sites()
{
//echo "select * from fundrequest where dept='3'";
?>
<li><a href="#">Sites Section</a>
 <ul>
 <li><a href="managesite.php">Sites</a></li>
 <!--<li><a href="sitebills.php">Customer Bills</a></li>-->
 <li><a href="sitebillsme.php">Customer Bills</a></li>
 <li><a href="newsitebills.php">New Customer Bills</a></li>
 <li><a href="ratechange.php">Edit rates</a></li>
 </ul>
 </li>
  <li><a href="#">Temporary Sites</a>
  
 <ul>
 <li><a href="level1approve.php">level1 approval</a></li>
 
 </ul>
<li><a href="#">Reports</a>
  
 <ul>
 <li><a href="outstanding.php">Outstanding Report</a></li>
 <li><a href="quot_annexure.php">Quotation Annexure</a></li>
 <li><a href="quotationbillingupdate.php">Quotation Invoice Entry </a></li>
 </ul>
 <li><a href="#">View Section</a>
  
 <ul>
 <li><a href="viewbillme.php">View Annexure</a></li>
 
 </ul>
 </li>
 <?php
/* $qry=mysqli_query($con,"select * from fundrequest where dept='3'");
 if(mysqli_num_rows($qry)>0){*/
 ?>
  <li><a href="#">Fund Request</a>
  
 <ul>
 <!--<li><a href="requestamt.php">Request for Fund</a></li>-->
 <li><a href="fundlevel1.php">Fund Request Approval</a></li>
 </ul>
 </li>
  <li><a href="#">RNM</a>
  <ul>
    <li><a href="viewquot.php">View Quotation</a></li>
 <li><a href="viewRmn.php">RNM Billing</a></li>
     
  </ul>
 </li>
<?php
//}
}

function ebsupv()
{
//echo "select * from fundrequest where dept='3'";
?>
<li><a href="sup2.php">Supervisor Outstanding</a></li>
<li><a href="sup3.php">Supervisor Outstanding 15-16</a></li>
 <li><a href="sup4.php">Supervisor Outstanding 16-17</a></li>
<li><a href="sup5.php">Supervisor Outstanding 17-18</a></li>
<li><a href="ebillpackageentry.php">Ebill Package Entry</a></li>
<li><a href="view_pod_details.php">View Pod Details</a></li>
<?php

}

function rnmfundtransfer()
{

?>
<li><a href="view_quot_fr.php">RNM Fundrequests </a></li>
<li><a href="quottransview.php">R&M Fund Transfer </a></li>  
 
<?php if($_SESSION['dept']=='6') { ?>
<li><a href="#">Supervisor</a>
  <ul>
    <li><a href="newaccountme.php">New Supervisor</a></li>
  <li><a href="viewaccountme.php">View Supervisor</a></li>
    
  </ul>
</li>
<li><a href="#">Reports</a>
  <ul>
    
<li><a href="quotation1_misreport.php">MIS Report</a></li> 
  <li><a href="newquot1misrep.php">MIS DETAIL REPORT</a></li>
    
  </ul>
</li>

<?php } ?>

<?php
}
function rnmnorthfundtransfer()
{

?>
<li><a href="rnmnorth_fr.php">RNM Fundrequests </a></li>
<li><a href="quottransview.php">RNM FUND TRANSFER </a></li>
<?php
}

function salymodnew()
{
?>
>
<li><a href="viewsalaryn.php">View salary </a></li>

<?php
}

function hrsalary()
{
?>
<li><a href="new_salaryreport.php">View salary </a></li>
<li><a href="view_det.php">View Details</a></li>
<?php
}


function rnmout()
{
?>
<li><a href="quottransview.php">R&M Fund Transfer </a></li>
<?php
}