<?php session_start();

require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
//$qry=$_POST['qr'];

//  $hotel=  mysqli_query($conn,"SELECT logo,Hotel_Name FROM `Hotel_Creation` where hotel_id='".$_SESSION['HotelName']."'");
//  $fetchotel=mysqli_fetch_array($hotel);
//$Ab_Filtter=$_POST['Ab_Filtter'];





class MYPDF extends TCPDF {
    
    private $isFirstPage = true;

    //Page header
    public function Header() {
        // Logo
     // $image_file =$fetchotel['logo'];
     
      $image_file ='LoyalticianLogo.jpg';
        $this->Image($image_file, 80, 8, 40, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
      
      $image_file ='logoai.jpg';
        $this->Image($image_file, 20, 8, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $this->SetFont('helvetica', '', 12);
        
        // Check if it is the first page
        if ($this->isFirstPage) {
            $this->Ln(25);
            $this->SetTextColor(0,0,0);
            $this->Cell(0, 10, 'PACKAGE RECEIPT AND DATA CONSENT FORM', 0, 0, 'C', false, '', 0, false, 'M', 'M');
            // $this->Ln();
            $this->isFirstPage = false;
        }
// $this->Ln();
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
$pdf->SetFont('times', '', 11);
$pdf->SetMargins(21, 35, 10, true);
// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// $pdf->Ln();


$MembershipNum=$_POST['MembershipNum'];

 $hotel=  mysqli_query($conn,"SELECT * from Members where GenerateMember_Id='".$MembershipNum."' ");
 $fetchotel=mysqli_fetch_array($hotel);
 
if($fetchotel['GenerateMember_Id']!=""){

$booklet_Series=$fetchotel["booklet_Series"];
$member_name = $fetchotel['Primary_nameOnTheCard'];
$entry_date = date("d-m-Y",strtotime($fetchotel['entryDate']));

$Qlev=  mysqli_query($conn,"SELECT level_name from Level  where Leval_id='".$fetchotel["MembershipDetails_Level"]."' ");
 $fetclev=mysqli_fetch_array($Qlev);
 $Mem_level= $fetclev['level_name'];


$Qname=  mysqli_query($conn,"SELECT Title,FirstName,LastName,MobileNumber,EmailId from Leads_table  where Lead_id='".$fetchotel["Static_LeadID"]."' ");
 $fetcName=mysqli_fetch_array($Qname);
  $Mem_contact = $fetcName['MobileNumber'];
 $Mem_email = $fetcName['EmailId'];
 
$Mem_contact = substr_replace($Mem_contact, str_repeat("X", 6), 0, 6);

$Mem_email = substr_replace($Mem_email, str_repeat("X", 6), 2, 6);
$name= $fetcName['Title'].' '. $fetcName['FirstName'].' '. $fetcName['LastName']; 

$level_booklet = $Mem_level. '  ' . $booklet_Series;

$dt=date('d-m-Y');
  
 $htmtab_body="

<table style='width:30%;height:50%;line-height:1;'>
    <tr>
        <td style='text-align:right;'><b>Member Details</b></td>
        <td></td>
    </tr>
    <tr>
        <td>Member Name</td>
        <td>- $name</td>
    </tr>
    <tr>
        <td>Mobile (masked)</td>
        <td>- $Mem_contact</td>
    </tr>
    <tr>
        <td>Email (masked)</td>
        <td>- $Mem_email</td>
    </tr>
    <tr>
        <td>Enrolment Date</td>
        <td>- $entry_date</td>
    </tr>
    <tr>
        <td>Level & Booklet Series</td>
        <td>- $level_booklet</td>
    </tr>
    <tr>
        <td>Membership Number</td>
        <td>- $MembershipNum</td>
    </tr>
    <tr>
        <td>Digital Form & Consent</td>
        <td>- Received</td>
    </tr>
</table>";
$pdf->writeHTML($htmtab_body, true, false, false, false, '');

$pdf->SetLineWidth(0.5); // Set line width
$pdf->Line(20, $pdf->getY(), 190, $pdf->getY()); // Draw line

$htmtab1_body="
<b>Package Details</b><br><br>
<table style='width:100%;height:80%;'>
    <tr>
        <td style='width: 20%;'>Date & Time</td>
        <td style='width: 40%;'>- ________________________</td>
    </tr>
    <tr>
        <td style='width: 20%;'>Received by Name</td>
        <td style='width: 40%;'>- ________________________</td>
    </tr>
    <br>
    <tr>
        <td style='width: 20%;'>Signature</td>
        <td style='width: 40%;'>- ________________________</td>
    </tr>
</table>";
$pdf->writeHTML($htmtab1_body, true, false, false, false, '');

$pdf->SetLineWidth(0.5); // Set line width
$pdf->Line(20, $pdf->getY(), 190, $pdf->getY()); // Draw line

$htmtab2_body="
<b>Data Consent</b><br><br>
The Membership Program ‘Prestige Club’ is solely operated by Prolyft Digital Africa Limited (PROLYFT) as an<br>authorized representative of The Boma Hotels under an exclusive agreement. PROLYFT collects and stores basic<br>personally identifiable information following the guidelines Kenya Data Protection Act 2019 from the members in <br>order to service their (his / her) membership under express consent on sign up. Servicing may include (but not be <br>limited to) disseminating promotional content by all available communication channels, information updates on <br>the membership and the renewal of the membership. PROLYFT does not collect or store sensitive personal data.
<br><br>I hereby expressly and unequivocally agree and consent to the privacy policy, the storage and treatment of my <br>personal data and the terms & conditions of the program mentioned on www.prestigeclub.co.ke. I understand that <br>without collecting these basic personal details, it may not be possible for Prolyft to manage the membership <br>effectively or at all.
<br>
<br><b>MY PREFERRED MODE OF CONTACT </b><br><br>
<table style='width:100%;height:80%;padding-top:0;font-size: 9px;'>
    <tr>
        <td style='width: 5%;text-align: right;'>WHATS APP</td>
         <td style='width: 5%;'>- [ ]</td>
        <td style='width: 20%;text-align: right;'>VOICE CALLS</td>
         <td style='width: 5%;'>- [ ]</td>
        <td style='width: 5%;text-align: right;'>EMAIL</td>
         <td style='width: 5%;'>- [ ]</td>
        <td style='width: 20%;text-align: right;'>SMS</td>
         <td style='width: 5%;'>- [ ]</td>
         <td style=''>APP<br>NOTIFICATION</td>
        <td style='width: 50%;'>- [ ]</td>
    </tr>
</table>
<table style='width:100%;line-height:0; margin-bottom:0;font-size: 9px;'>
    <tr>
         <td style='width: 5%;line-height:0; margin-bottom:0;'>ANY OF THE ABOVE </td>
            <td style='width: 5%;text-align:left;'>- [ ]</td>
            <td></td>
            <td></td>
            <td></td><td></td>
            <td></td>
    </tr>
</table>

<br><br>
_______________________<br>
Member Signature
";
//echo $htmtab1 . $htmtab1_body . $tbl_footer;
 $pdf->writeHTML($htmtab2_body, true, false, false, false, '');


 

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//Close and output PDF document
}else{
   echo  " MemberId Wrong" ;
}
?>