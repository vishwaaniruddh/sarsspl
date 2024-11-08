<?php session_start();

require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
$qry=$_POST['qr1'];


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
       
       $image_file ='wlogo.jpg';
        $this->Image($image_file, 75, 4, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
        $this->Ln(22);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
          $this->Cell(0, 10,'Club Four Points', 0, false, 'L', 0, '', 0, false, 'M', 'M');
          $this->Ln();
           $this->SetFont('helvetica', 'B', 10);
          $this->Cell(0, 10,'From:- '.$From.'  To :- '.$To , 0, false, 'L', 0, '', 0, false, 'M', 'M');

        
   
$this->SetFont('helvetica', 'B', 10);
 
$this->Ln();
$this->SetTextColor(255,255,255);
 $this->Rect(10,43,190,7,'F','',$fill_color = array(0, 0, 0));

$this->Cell(0, 10, 'DAILY EMBOSSING REPORT', 0,0,'C',false, '', 0, false, 'M', 'M');
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
$pdf->SetTitle('L-DER');
$pdf->SetSubject('DER Report');
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

$pdf->Ln(5);


$pdf->Ln(25);

$htmtab1='
<table border="1" width="92%" align="center">
<tr height="5px">
<td width="8%">
SrNo.
</td>

<td>
 Full Name
</td>
<td>
Member Id
</td>
<td>
Level

</td>
<td>Expiry Date</td>
<td>Entry Date</td>
<td width="16%">Member_Type</td>
</tr>
';


$htmtab1_body="";
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


  
 $R = date('F, Y', strtotime($_row['ExpiryDate']));

$ddd=date('d-m-Y', strtotime($_row['entryDate']));


$htmtab1_body.='
<tr height="5px">
<td width="8%">
'.$srno.'
</td>

<td>
'.$_row['Primary_nameOnTheCard'].'
</td>
<td>
'.$_row['GenerateMember_Id'].'
</td>
<td>
'.$sql3fetch['level_name'].'</td>
<td>
'.$R.'</td>
<td >'.$ddd.'</td>
<td width="16%">'."Primary".'</td>
</tr>
';
    
    
    
if($_row['Primary_MaritalStatus']=='Married'){
    
    $srno++;
$useBelowSpouse++;

$htmtab1_body.='
<tr height="5px" >
<td width="8%">'.$srno.'</td>
<td>'.$_row['Spouse_nameOnTheCardMarried'].'</td>

<td>'.$_row['GenerateMember_Id'].'</td>
<td>'.$sql3fetch['level_name'].'</td>
<td >'.$R.'</td>
<td >'.$ddd.'</td>
<td width="16%">'."Complimentory".'</td>



</tr>
';
}

    
    
    $srno++;
} 

//$pdf->writeHTML($htmtab1_body, true, false, false, false, '');
$tbl_footer='
</table>
';

$pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');

//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);



$pdf->Ln(5);

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

?>