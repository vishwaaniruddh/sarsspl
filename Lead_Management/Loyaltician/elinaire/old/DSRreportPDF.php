<?php session_start();
ini_set('max_execution_time', 90);
ini_set('memory_limit', '-1');
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
$qry=$_POST['qr1'];

$cancel1=$_POST['cancel1'];


if($_SESSION['HotelName']!=""){
  $hotel=  mysqli_query($conn,"SELECT logo,Hotel_Name FROM `Hotel_Creation` where hotel_id='".$_SESSION['HotelName']."'");
  $fetchotel=mysqli_fetch_array($hotel);
}

$sql=mysqli_query($conn,$qry);

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
     // $image_file =$fetchotel['logo'];
      $From=$_POST['From1'];
    $To=$_POST['To1'];
      
      
       $image_file ='LoyalticianLogo.jpg';
        $this->Image($image_file, 110, 7, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
       $image_file ='Orchid_logo.jpg';
        $this->Image($image_file, 75, 4, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
        $this->Ln(22);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
          $this->Cell(0, 10,'The Orchid Hotel Pune', 0, false, 'L', 0, '', 0, false, 'M', 'M');
          $this->Ln();
           $this->SetFont('helvetica', 'B', 10);
          $this->Cell(0, 10,'From:- '.$From.'  To :- '.$To , 0, false, 'L', 0, '', 0, false, 'M', 'M');

        
   
$this->SetFont('helvetica', 'B', 10);
 
$this->Ln();
$this->SetTextColor(255,255,255);
 $this->Rect(10,43,190,7,'F','',$fill_color = array(0, 0, 0));

$this->Cell(0, 10, 'DAILY SALES REPORT', 0,0,'C',false, '', 0, false, 'M', 'M');
$this->Ln();$this->Ln();$this->Ln();$this->Ln();

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle('L-DSR');
$pdf->SetSubject('DAILY SALES Report');
$pdf->SetKeywords('E-FSR, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// set font
$pdf->SetFont('times', '', 10);
//$pdf->SetMargins(10, 50, 10, true);
$pdf->SetMargins(10, 27, 10, true);
// add a page
$pdf->AddPage();
$pdf->SetMargins(10, 55, 10, true);
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);


/* comment  by Anand
$brsql=mysql_query("select name,phone from avo_branch where id='".$row[7]."'");
$brrow=mysql_fetch_array($brsql);
$avobranch=$brrow[0];
$docketno=$row[25];
$custsql=mysql_query("select cust_name from customer where cust_id='".$row[1]."'");
$custrow=mysql_fetch_array($custsql);

$customername=$custrow[0];

$address=$row[5];
$phn=$brrow[1];
if($row[21]=="site")
{
$atmsql=mysql_query("select atm_id from atm where track_id='".$row[2]."'");
$atmrow=mysql_fetch_array($atmsql);
$atmid=$atmrow[0];
$cs="Warranty";
}
else if($row[21]=="amc")
{
$atmsql=mysql_query("select atmid from Amc where amcid='".$row[2]."'");
$atmrow=mysql_fetch_array($atmsql);
$atmid=$atmrow[0];
$cs="AMC";
}
else{
$atmid=$row[2];
$cs="Temporary";
}

$pdf->MultiCell(95, 5, 'AVO Branch:'.$avobranch, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(80, 5, 'AVO Docket No:'.$docketno, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 5, 'Name of Customer:'.$customername, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(80, 5, 'ATM ID:'.$atmid, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 25,'Address:'.$address, 0, 'L', 0, 0, '', '', true,0,true);
$pdf->MultiCell(80, 5, 'Phone/Mobile:'.$phn, 0, 'L', 0, 0, '', '', true);

$calltype="<b>".$row[17]."</b>";
$servrendered=$row[17];
$pdf->Ln(30);
$pdf->MultiCell(90, 5, 'Date of Call :'.$row[10], 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 5, 'Customer Status: '.$cs, 0, 'L', 0, 0, '', '', true);

/*$pdf->Ln(10);
$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->MultiCell(180,5,'Call Type: '.$calltype, 1, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
$pdf->MultiCell(180, 5, 'Service Rendered: '.$servrendered, 1, 'C', 0, 0, '', '', true);
*/

$pdf->Ln(25);

$htmtab1='
<table border="1"  width="85%" align="center" >
<tr height="5px" style="font-size:9px">
<td  style="width:10px;">SrNo.</td>
<td>Name on the Card</td>
<td>Type</td>

<td>Level</td>
<th>Membership No.</th>
<td style="width:38px">ExpiryDt</td>
<td>Booklet Number</td>
<td>Type(N/R)</td>

<td> Payment Mode</td>
<td>Instrument No.</td>

<td>Receipt No.</td>
<td>Amount</td>
<td >GST</td>
<td> Total Amount</td>
<th>Remarks</th> 
<th>Member cancel</th> 

</tr>
';



/*$htmtab1='
<table border="1" width="90%" align="center">
<tr height="5px">
<td>SrNo.</td>
<td>Card Number</td>
<td> Full Name</td>

<td>Name on the Card</td>
<th>Spouse Name</th>
<td>Mobile Number</td>
<td>Membership Level</td>
<td>Member Since</td>

<td>Email ID</td>
<td> Company Name</td>
<td>Designation</td>
<td>City</td>
<td>State</td>
<td>Country</td>
<td>Pin Code</td>
<th>Date of Birth</th> 
<th>Marital Status</th> 
</tr>
';*/


$htmtab1_body="";
$srno=1;
$useBelowQry_Level='';
$useBelowPrimary=0;
$useBelowSpouse=0;
$useBelowCompFree=0;
$LessCancelationCount=0;
$LessCancelationAmt=0;
while($_row=mysqli_fetch_array($sql)){

$useBelowCompFree+=$_row['Complemetory_card_Free'];


	$sql2="select * from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
    $useBelowQry_Level=	$_row['MembershipDetails_Level'];
	
	$sql3="SELECT * FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);
 
	
	
	$sql5="SELECT state FROM `state` where state_id='".$sql2fetch['State']."' ";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);


    $sqlcanceled="select canceledMember,MembershipDts_GrossTotal from Members where mem_id= '".$_row['mem_id']."' and  canceledMember='1'";
	$runCancel=mysqli_query($conn,$sqlcanceled);
	$CancelFetch=mysqli_fetch_array($runCancel);
   
$LessCancelationCount+=$CancelFetch[0];
$LessCancelationAmt+=$CancelFetch[1];

	 $R = date("M-Y", strtotime($_row['ExpiryDate']));
    


$useBelowPrimary++;

$cnel="";
if($_row['canceledMember']==1){$cnel="Cancel";} 

$htmtab1_body.='
<tr height="5px" style="font-size:8px;font-color:black">
<td style="width:10px;">'.$srno.'
</td>
<td>'. $_row['Primary_nameOnTheCard'].'</td>
<td>'.'Primary'.'</td>
<td>'.$sql3fetch['level_name'].'</td>
<td>'. $_row['GenerateMember_Id'].'</td>
<td style="width:38px">'.$R.'</td>

<td>'.$_row['booklet_Series'].'</td>
<td>'."N".'</td>

<td>'.$_row['MembershipDts_PaymentMode'].'</td>
<td>'.$_row['MembershipDts_InstrumentNumber'] .'</td>

<td>'.' '.'</td>
<td>'. $_row['MembershipDts_NetPayment'].'</td>
<td>'. $_row['MembershipDts_GST'].'</td>
<td>'. $_row['MembershipDts_GrossTotal'].'</td>
<td>'. $_row['MemshipDts_Remarks'].'</td>
<td>'. $cnel.'</td>



</tr>
';



if($_row['Primary_MaritalStatus']=='Married' && $_row['Complemetory_card_Free']!=1){
$srno++;
$useBelowSpouse++;
$htmtab1_body.='
<tr height="5px" style="font-size:8px;font-color:black">
<td style="width:10px;">'.$srno.'
</td>
<td>'. $_row['Spouse_nameOnTheCardMarried'].'</td>
<td>'.'Spouse'.'</td>
<td>'.$sql3fetch['level_name'].'</td>
<td>'. $_row['GenerateMember_Id'].'</td>
<td style="width:38px">'.$R.'</td>
<td>'.' '.'</td>
<td>'."N".'</td>
<td>'.$_row['MembershipDts_PaymentMode'].'</td>
<td>'.$_row['MembershipDts_InstrumentNumber'] .'</td>

<td>'.' '.'</td>
<td>'. ' '.'</td>
<td>'. ' '.'</td>
<td>'. ' '.'</td>
<td>'.'Complimentary'.'</td>
<td>'.$cnel.'</td>
</tr>
';
}


/*$htmtab1_body.='
<tr height="5px">
<td>'.$srno.'
</td>
<td>'. $_row['GenerateMember_Id'].'
</td>
<td>'. $sql2fetch['FirstName']." ".$sql2fetch['LastName'].'
</td>
<td>'.$_row['Primary_nameOnTheCard'].'
</td>
<td>'. $_row['Spouse_FirstName'].'</td>
<td>'.$sql2fetch['MobileNumber'].'</td>

<td>'. $sql3fetch['level_name'].'</td>
<td>'.$_row['entryDate'].'</td>

<td>'.$_row['Primary_Email_ID2'].'</td>
<td>'.$sql2fetch['Company'].'</td>
<td>'.$sql2fetch['Designation'].'</td>
<td>'.$sql2fetch['City'].'</td>
<td>'. $sql5fetch['state'].'</td>
<td>'. $sql2fetch['Country'].'</td>
<td>'.$sql2fetch['PinCode'].'</td>
<td>'.$_row['Primary_DateOfBirth'].'</td>
<td>'.$_row['Primary_MaritalStatus'].'</td>


</tr>
';*/
    
    $srno++;
    
    
  
  
    
} 

//$pdf->writeHTML($htmtab1_body, true, false, false, false, '');
$tbl_footer='
</table>
';
//echo $htmtab1 . $htmtab1_body . $tbl_footer;
//exit();
$pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');

//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);



$pdf->Ln(5);
$TotalmodeCount=0;
$TotalAmoutCount=0;

$TotalComplementory=$useBelowSpouse+$useBelowPrimary+$useBelowCompFree;



$LessCancelation=$TotalComplementory-$LessCancelationCount;


$htmtab1='Payment Summary
<table border="1" width="85%" cellpadding="-2"  align="center">

<tr  height="2px" style="background-color:#F0F0F0" cellspacing="0" cellpadding="1"	>
<th>Paid</th><th>No Of Sale</th><th>Amount</th>
</tr>';

// Summary
	
	$sqlmode="SELECT * FROM `Level` where Leval_id='".$useBelowQry_Level."' ";
	$runmode=mysqli_query($conn,$sqlmode);
	$sqlmodefetch=mysqli_fetch_array($runmode);


    $QueryMsMode=mysqli_query($conn,"SELECT Payment_mode FROM `MembershipPaymentMode` where Program_ID='".$sqlmodefetch['Program_ID']."'");
    $From3=$_POST['From1'];
    $To3=$_POST['To1'];
    $FromDt2=date('Y-m-d', strtotime($From3));
    $Todt2=date('Y-m-d', strtotime($To3));
    
    while($fetchMsMode=mysqli_fetch_array($QueryMsMode)){

// .Membermode show in table 
if($From3!="" && $To3!=""){
    $qryadd="SELECT count(MembershipDts_PaymentMode) as countMode,MembershipDts_PaymentMode,MembershipDts_NetPayment,sum(MembershipDts_GrossTotal) FROM Members where MembershipDts_PaymentMode='".$fetchMsMode['Payment_mode']."' and (date(entryDate) between '".$FromDt2."' and '".$Todt2."' or date(CancelationDate) between '".$FromDt2."' and '".$Todt2."') ";
  if($cancel1!=""){
      $qryadd.=" and canceledMember='".$cancel1."'   GROUP BY MembershipDts_PaymentMode";
  }
  else{
      $qryadd.="   GROUP BY MembershipDts_PaymentMode";
  }
 // echo $qryadd;
   
   $countmode=mysqli_query($conn,$qryadd);
// echo "SELECT COUNT(MembershipDts_PaymentMode) as countMode,MembershipDts_PaymentMode,MembershipDts_NetPayment FROM Members where MembershipDts_PaymentMode='".$fetchMsMode['Payment_mode']."' and date(entryDate) between '".$FromDt2."' and '".$Todt2."'  GROUP BY MembershipDts_PaymentMode";
}else{
$dateMode=date("Y-m-d");

 $qryadd="SELECT count(MembershipDts_PaymentMode) as countMode,MembershipDts_PaymentMode,MembershipDts_NetPayment,sum(MembershipDts_GrossTotal) FROM Members where MembershipDts_PaymentMode='".$fetchMsMode['Payment_mode']."' and (date(entryDate)='".$dateMode."' or date(CancelationDate)='".$dateMode."' ) ";
  if($cancel1!=""){
      $qryadd.=" and canceledMember='".$cancel1."'   GROUP BY MembershipDts_PaymentMode";
  }
  else{
      $qryadd.="   GROUP BY MembershipDts_PaymentMode";
  }
//  echo $qryadd;
$countmode=mysqli_query($conn,$qryadd);

    
}
$fetchmode=mysqli_fetch_array($countmode);

//echo "anand".$fetchmode['countMode'].$fetchmode['MembershipDts_PaymentMode'];

//////////////////////////////////////////////////

//$netAmount=$fetchmode[0]*$fetchmode[3];
$netAmount=$fetchmode[3];

if($fetchmode[0] > 0){
   $femode= $fetchmode[0];
}else{
    $femode=0;$netAmount=0;
}

$TotalmodeCount+=$femode;
$TotalAmoutCount+=$netAmount;

$LessCancelAMT=$TotalAmoutCount-$LessCancelationAmt;

$htmtab1.='
<tr>
<th>'.$fetchMsMode[0].'</th><td>'.$femode.'</td><td>'.$netAmount.'</td>
</tr>

';}

$htmtab1.='



<tr style="background-color:gray">
<th>Total</th><td>'.$TotalmodeCount.'</td><td>'.$TotalAmoutCount.'</td>
</tr>

';
    




//$pdf->writeHTML($htmtab1_body, true, false, false, false, '');
$tbl_footer='
</table>
';

$pdf->writeHTML($htmtab1 . $tbl_footer, true, false, false, false, '');


////////////////////////////////////////////////////////////////////////////////



$htmtab4='Member  Summary    
<table border="1" width="85%" cellpadding="-2"  align="center">

<tr style="background-color:#F0F0F0">
<th>Complimentary</th><th>No Of Sale</th><th>Amount</th>
</tr>
<tr>
<th>Spouse</th><td>'.$useBelowSpouse.'</td><td>0</td>
</tr>
<tr>
<th>Primary</th><td>'.$useBelowPrimary.'</td><td>'.$TotalAmoutCount.'</td>
</tr>
<tr>
<th>Comp.</th><td>'.$useBelowCompFree.'</td><td>0</td>
</tr>
<tr style="background-color:gray">
<th>Total</th><td>'.$TotalComplementory.'</td><td>'.$TotalAmoutCount.'</td>
</tr>



<tr><th></th><td></td><td></td></tr>

<tr style="background-color:#F0F0F0"><th>Less Cancellation</th><td>'.$LessCancelationCount.'</td><td>'.$LessCancelationAmt.'</td></tr>
<tr style="background-color:gray"><th>Total</th><td>'.$LessCancelation.'</td><td>'.$LessCancelAMT.'</td></tr>
';
    


$srno=1;
while($_row=mysqli_fetch_array($sql)){



$sql2="select FirstName,LastName from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
			    
	$sql3="SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	//echo $sql2;
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);



  

	 $R = date('M, Y', strtotime($_row['ExpiryDate']));
     


$htmtab4.='
<tr height="5px">
<td>
'.$srno.'
</td>
<td>
'. $_row['Primary_Title'].'
</td>
<td>
'. $sql2fetch['FirstName']." ".$sql2fetch['LastName'].'
</td>
<td>
'.$_row['GenerateMember_Id'].'
</td>
<td>
'.$sql3fetch['level_name'].'</td>
<td>
'.$R.'</td>
</tr>

';

    $srno++;
}  

$htmtab4.='
</table>
';

   $pdf->Ln(1);

$pdf->writeHTML($htmtab4, true, false, false, false, '');

    
///////////////////////////////////////////////////////////////


// signature

    $From=$_POST['From1'];
    $To=$_POST['To1'];
$FromDaat=date('Y-m-d', strtotime($From));
$Todaat=date('Y-m-d', strtotime($To));

if($From=="" && $To==""){
   $FromDaat=date('Y-m-d');
   $Todaat=date('Y-m-d');
}

  $QcountFirst=mysqli_query($conn,"Select Count(MembershipDetails_Level) as level from Members where MembershipDetails_Level='1' and (date(entryDate) between '".$FromDaat."' and '".$Todaat."' or date(CancelationDate) between '".$FromDaat."' and '".$Todaat."')  ");
  $QfetchFirst=mysqli_fetch_array($QcountFirst);
 // echo "Select Count(MembershipDetails_Level) as level from Members where MembershipDetails_Level='1' and date('entryDate') between '".$FromDaat."' and '".$Todaat."'  ";
  $QcountGold=mysqli_query($conn,"Select Count(MembershipDetails_Level) as level from Members where MembershipDetails_Level='2' and (date(entryDate) between '".$FromDaat."' and '".$Todaat."' or date(CancelationDate) between '".$FromDaat."' and '".$Todaat."') ");
  $QfetchGold=mysqli_fetch_array($QcountGold);
  
  $QcountPlatinum=mysqli_query($conn,"Select Count(MembershipDetails_Level) as level from Members where MembershipDetails_Level='3' and (date(entryDate) between '".$FromDaat."' and '".$Todaat."' or date(CancelationDate) between '".$FromDaat."' and '".$Todaat."') ");
  $QfetchPlatinum=mysqli_fetch_array($QcountPlatinum);
  
  $TotalLevelQuery=$QfetchFirst['0']+$QfetchGold['0']+$QfetchPlatinum['0'];
  

$htmtab5='&nbsp;&nbsp;&nbsp;&nbsp;  Level  Summary    
<table  border="1" width="85%" cellpadding="-2"  padding-left="100Px" align="center">


<tr style="background-color:#F0F0F0">
<th>Level</th><th>Count</th>
</tr>
<tr>
<th>Primary</th><td>'.$QfetchFirst['0'].'</td>
</tr>
<tr>
<th>Gold</th><td>'.$QfetchGold['0'].'</td>
</tr>
<tr>
<th>Platinum</th><td>'.$QfetchPlatinum['0'].'</td>
</tr>
<tr style="background-color:gray">
<th>Total</th><td>'.$TotalLevelQuery.'</td>
</tr>

</table>

';

$pdf->Ln(1);
$pdf->writeHTML($htmtab5, true, false, false, false, '');

////////////////////////////////////////////////////////////




// signature
$htmtab2='
<table  width="90%">
<tr><td colspan="2">Prepared By :-  '. $_SESSION['user'].'
</td></tr>

<tr><td colspan="2">
Checked and Signed Manager / Asst. Manager _ _ _ _ _ _ _ _ _ _ _ _ _ <br>                                    Hotel (Acceptance) <br>
</td></tr>

<tr><td colspan="2">
Hotel Personnel Accepted By
</td></tr>

<tr><td>
   Name<br>
   Singnature<br>
   Date<br>
</td></tr>



</table>';

$pdf->Ln(1);
//$pdf->MultiCell(180,5,$txt12, 0, 'L', 0, 0, '', '', true,0,true);
//$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->writeHTML($htmtab2, true, false, false, false, '');

//echo $htmtab2;


//////////////////////////////////////////////////////////




//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

?>