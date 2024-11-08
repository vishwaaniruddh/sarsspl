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
        $this->Image($image_file, 90, 4, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
       $image_file ='logoai.jpg';
        $this->Image($image_file, 10, 4, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
        $this->Ln(22);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
          $this->Cell(0, 10,'The Resort Mumbai', 0, false, 'L', 0, '', 0, false, 'M', 'M');
          $this->Ln();
           $this->SetFont('helvetica', 'B', 10);
          $this->Cell(0, 10,'From:- '.$From.'  To :- '.$To , 0, false, 'L', 0, '', 0, false, 'M', 'M');

        
       
//$this->SetFont('helvetica', '', 10);
  // $this->Cell(0, 5, 'H.O: 230 S.N.Roy Road, Kolkata- 700038', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//$this->Ln();
$this->SetFont('helvetica', 'B', 10);
   //$this->Cell(0, 5, 'Service Help Line-033-32017233 / 65181192/Fax: 033-24886047.Email-service3@avoups.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');

$this->Ln();
$this->SetTextColor(255,255,255);
 $this->Rect(10,43,190,7,'F','',$fill_color = array(0, 0, 0));

$this->Cell(0, 10, 'Booklets Assignment Report', 0,0,'C',false, '', 0, false, 'M', 'M');
$this->Ln();$this->Ln();$this->Ln();$this->Ln();
//$htxc='FIELD SERVICE REPORT';
//$this->MultiCell(180,5,$htxc, 1, 'C',false,0, 0, '', '', true,0,true);
//$this->Ln(3);

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
$pdf->SetTitle('B-BAR');
$pdf->SetSubject('Booklets Assignment Report');
$pdf->SetKeywords('B-BAR, PDF');

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

// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);
$pdf->SetMargins(10, 50, 10, true);
// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln(5);


$pdf->Ln(25);
 
$htmtab1='
<table border="1"  width="93%" align="center" >
<tr height="5px" >
<td>SrNo.</td>
<td>DSR Date</td>
<td>Level</td>
<td>Booklet Number</td>
<td>Card Number</td>
<td>Member Name</td>
<td>Booklet Status</td>
</tr>
';




$htmtab1_body="";
$srno=1;

while($_row=mysqli_fetch_array($sql)){


 $entdt=$_row['entryDate'];
 $entdt_show=date('d-m-Y', strtotime($entdt));
 
  $levelOrchid=mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ");  
 $levelOrchidFetch=mysqli_fetch_array($levelOrchid);
 $Lev=$levelOrchidFetch['level_name'];



      if($_row['canceledMember']==1){
          $statusSample="Canceled";
      } else if($_row['Sample']==1){
          $statusSample="Sample";
      } elseif($_row['void']==1){
          $statusSample = 'VOID - ' . $_row['void_reason'] ;  ;
      }else{
          $statusSample="";
      }
                   

$htmtab1_body.='
<tr height="5px" style="font-size:11px;font-color:black">
<td>'.$srno.'</td>
<td>'. $entdt_show.'</td>
<td>'.$Lev.'</td>
<td>'.$_row['booklet_Series'].'</td>
<td>'.$_row['GenerateMember_Id'].'</td>
<td>'.$_row['Primary_nameOnTheCard'].'</td>
<td>'.$statusSample.'</td>
</tr>
';



    $srno++;

} 

//$pdf->writeHTML($htmtab1_body, true, false, false, false, '');
$tbl_footer='
</table>
';

$pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');
//////////////////////////////////////////////////////////




//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

?>