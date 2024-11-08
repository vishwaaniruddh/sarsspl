<?php session_start();

require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
//$qry=$_POST['qr'];

//  $hotel=  mysqli_query($conn,"SELECT logo,Hotel_Name FROM `Hotel_Creation` where hotel_id='".$_SESSION['HotelName']."'");
//  $fetchotel=mysqli_fetch_array($hotel);
//$Ab_Filtter=$_POST['Ab_Filtter'];





class MYPDF extends TCPDF {

    //Page header
    public function Header() {

        $this->SetFont('helvetica', 'B', 12);
        $this->Ln(45);
        $this->SetTextColor(0,0,0);
        $this->Cell(0, 10, 'TEMPORARY CARD LETTER', 0, 0, 'C', false, '', 0, false, 'M', 'M');

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
$pdf->SetFont('times', '', 12);
$pdf->SetMargins(21, 50, 10, true);
// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln();


$MembershipNum=$_POST['MembershipNum'];

 $hotel=  mysqli_query($conn,"SELECT * from Members where GenerateMember_Id='".$MembershipNum."' ");
 $fetchotel=mysqli_fetch_array($hotel);
 
if($fetchotel['GenerateMember_Id']!=""){

$booklet_Series=$fetchotel["booklet_Series"];


$Qlev=  mysqli_query($conn,"SELECT level_name from Level  where Leval_id='".$fetchotel["MembershipDetails_Level"]."' ");
 $fetclev=mysqli_fetch_array($Qlev);
 $Mem_level= $fetclev['level_name'];

$Qname=  mysqli_query($conn,"SELECT Title,FirstName,LastName from Leads_table  where Lead_id='".$fetchotel["Static_LeadID"]."' ");
 $fetcName=mysqli_fetch_array($Qname);

$name= $fetcName['Title'].' '. $fetcName['FirstName'].' '. $fetcName['LastName']; 


$dt=date('d M Y');
$valid_till = date('M Y');

$entrydate = $fetchotel['entryDate'];
$dsrdate = date('d M Y',strtotime($entrydate));
  
$htmtab1_body="
<br><br><br><br>Issue Date - $dt <br>
Valid Till - $valid_till<br>
Date of Enrollment -  $dsrdate<br>
Membership Number - $MembershipNum<br>
Membership Level - $Mem_level<br>
Certificate Booklet Number- $booklet_Series<br><br>
Dear $name,<br><br>

Greetings from Prestige Club! We thank you for making the decision to join our<br>Membership and are delighted to welcome you as a member of The Boma Hotels.<br><br>
Your personalised membership package is now under process and is normally ready within 7<br>business days of enrolment. Until then, this letter can be presented to avail of your Card<br>Benefits on a one time basis. This letter has to be presented in Original.<br><br>


30% discount on Food – upto 15 guests.<br>
20% discount on all Beverages, cake shop, laundry bills, spa & room service.<br>
Happy Hours – Buy One Get One beverage 4 pm to 7 pm.<br><br>

Our dedicated Member Help Desk is open from 09:30 am to 06:30 pm, Monday<br>
through Saturday except on public holidays. We are available on +254 114500206.<br>
Alternatively, you may also reach us via e-mail:contactus@prestigeclub.com <br><br>

We truly appreciate your patronage and hope the membership will be useful to you.<br>
Yours Sincerely,<br><br>

Team Prestige Club<br>
The Boma Hotels<br><br>

<small style='font-size:10pt !important;'>The Membership usage is subject to Terms and Conditions, available on www.prestigeclub.co.in. This letter is specifically printed to attach on the<br>Point of Sale and only one letter is valid to use on one table.This Letter has to be presented in original and no copies are accepted.</small>

";

//echo $htmtab1 . $htmtab1_body . $tbl_footer;
 $pdf->writeHTML($htmtab1_body, true, false, false, false, '');


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//Close and output PDF document
}else{
   echo  " MemberId Wrong" ;
}

?>

