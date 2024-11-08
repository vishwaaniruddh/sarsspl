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
$pdf->SetFont('times', '', 14);
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

$Qname=  mysqli_query($conn,"SELECT Title,LastName from Leads_table  where Lead_id='".$fetchotel["Static_LeadID"]."' ");
 $fetcName=mysqli_fetch_array($Qname);

$name= $fetcName['Title'].' '. $fetcName['LastName']; 


$dt=date('d-m-Y');
  
 $htmtab1_body="Date - $dt <br><br><br>

Membership Number - $MembershipNum<br>
Membership Level - $Mem_level<br>
Certificate Booklet Number- $booklet_Series<br><br><br>
Dear $name,<br><br>
Greetings from The Orchid Hotel Pune and Kamat Hotels India Limited<br><br>
Thank you for making the decision to join the Orchid membership! We are<br>
delighted to welcome you as a member to our Hotels.<br><br>
This membership package contains your membership cards, a booklet with<br>
details of the membership offer and terms &amp; conditions and your one-time use<br>
certificates.<br><br>
Our dedicated Member Help Desk is open from 09:30 am to 06:30 pm, Monday<br>
through Saturday except on public holidays. The contact number is +91 20<br>
6791 4106. Alternatively, you may also reach us via e-mail<br>
orchidgoldpune@orchidhotel.com<br><br>
We truly appreciate your patronage and hope the membership will be useful to<br>
you.<br><br>
Once again, thank you for choosing the Orchid membership.<br><br><br><br>
Yours Sincerely,<br><br>

Team Orchid Membership<br>
Pune<br>";
   



//echo $htmtab1 . $htmtab1_body . $tbl_footer;
 $pdf->writeHTML($htmtab1_body, true, false, false, false, '');


 

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//Close and output PDF document
}else{
   echo  " MemberId Wrong" ;
}
?>