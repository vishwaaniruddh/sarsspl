<?php session_start();

require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
//$qry=$_POST['qr'];

//  $hotel=  mysqli_query($conn,"SELECT logo,Hotel_Name FROM `Hotel_Creation` where hotel_id='".$_SESSION['HotelName']."'");
//  $fetchotel=mysqli_fetch_array($hotel);
//$Ab_Filtter=$_POST['Ab_Filtter'];
if(isset($_POST['FromDt']) and $_POST['FromDt']!="")
{
$FromDat=$_POST['FromDt'];
$FromDate=date('Y-m-d', strtotime($FromDat));
}
else
$FromDate="";

if(isset($_POST['Todt']) and $_POST['Todt']!="")
{
$Todat=$_POST['Todt'];
$ToDate=date('Y-m-d', strtotime($Todat));
}
else
$ToDate="";

$memid=$_POST['Memid'];


 $q="SELECT Primary_nameOnTheCard,Static_LeadID,Primary_BuldNo_addrss,Primary_Area_addrss,Primary_Landmark_addrss,GenerateMember_Id,Primary_AddressType1 FROM `Members`  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') ";
if( $FromDate!="" and $ToDate!=""){
    $q.=" and DATE(entryDate) BETWEEN '".$FromDate."' AND '".$ToDate."'";
}
if($memid!="")
{
    $q.=" and GenerateMember_id='".$memid."'";
}

//echo $q;
 $sql=mysqli_query($conn,$q);

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
     // $image_file =$fetchotel['logo'];
      
     /*  $image_file ='Orchid_logo.jpg';
        $this->Image($image_file, 10, 10, 25, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        
       $this->Cell(0, 10,'The Orchid Pune', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'H.O: 230 S.N.Roy Road, Kolkata- 700038', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'Service Help Line-033-32017233 / 65181192/Fax: 033-24886047.Email-service3@avoups.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');

$this->Ln();
$this->Ln();
//$this->Cell(0, 5, 'Daily Sales REPORT', 1,0,'C',false, '', 0, false, 'M', 'M');
$this->Ln();$this->Ln();$this->Ln();
*/

    }

    public function Footer() {
      
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle('L-LABLE');
$pdf->SetSubject('LABLE ADDRESS');
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
$pdf->SetMargins(1, 1, 1, true);
// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln();

$htmtab1='
<table width="100%" align="left" style="padding: 10px;">

';


$htmtab1_body="";
$srno=0;
   if ($srno%2 != 0) {$htmtab1_body.='<tr  style="font-size:12px;font-color:black">';}
while($_row=mysqli_fetch_array($sql)){
  
   
   
    $sql1=mysqli_query($conn," select MobileNumber,City,PinCode,State,Designation,Company FROM `Leads_table` where Lead_id='".$_row['Static_LeadID']."' ");
    $Fetch= mysqli_fetch_array($sql1);
   
  if($_row['Primary_AddressType1']=="Business") {
      $designation=$Fetch['Designation'];
      $Company=$Fetch['Company'];
      $pincode = $Fetch['Pincode'];
      
  }else{
       $designation="";
      $Company="";
      $pincode="";
  }
   
   
  $state= $Fetch['State'];
  if($state!=''){
    $st= strtolower($state);
    $st1=ucwords($st);
  }else{
      $st1="";
  }
  
   
   
   
    if ($srno%2 == 0) { $htmtab1_body.='<tr  style="font-size:12px;font-color:black;">';}
if($_row['Primary_BuldNo_addrss']!=""){$breaklin1="<br>";}else{$breaklin1="<br>";}
if($_row['Primary_Area_addrss']!=""){$breaklin2="<br>";}else{$breaklin2="<br>";}
if($_row['Primary_Landmark_addrss']!=""){$breaklin3="<br>";}else{$breaklin3="<br>";}
if($designation!=""){$breaklin4="<br>";}else{$breaklin4="";}
if($Company!=""){$breaklin5="<br>";}else{$breaklin5="";}

   
   $htmtab1_body.='<td style="width:50%;height:50Px;">'.$_row['GenerateMember_Id'].'<br />'.$_row['Primary_nameOnTheCard']."$breaklin4".$designation. "$breaklin5" .$Company.'<br />'.$_row['Primary_BuldNo_addrss']."$breaklin1" .$_row['Primary_Area_addrss']."$breaklin2".$_row['Primary_Landmark_addrss']."$breaklin3".$Fetch['City'].' '.$st1.' '.$Fetch['PinCode'].'<br /><br />Mobile No. :-'.$Fetch['MobileNumber'].'</td> ';
   $srno++;
    if ($srno%2 == 0) { $htmtab1_body.='</tr>';} 

}
if ($srno%2 != 0) {$htmtab1_body.='</tr>';}

$tbl_footer='</table>';
//echo $htmtab1 . $htmtab1_body . $tbl_footer;
$pdf->writeHTML($htmtab1.$htmtab1_body.$tbl_footer, true, false, false, false, '');


 

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//Close and output PDF document

?>