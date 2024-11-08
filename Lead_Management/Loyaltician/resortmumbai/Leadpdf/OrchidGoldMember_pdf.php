<?php
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');


$qry="select Leval_id,level_name from Level where Leval_id='".$sql4fetch['Leval_id']."' ";
$did=$sql4fetch['Leval_id'];

$sql=mysqli_query($conn,$qry);
$_row=mysqli_fetch_array($sql);




	$sqlE4="SELECT Expiry_month FROM `validity` where Leval_id='".$sql4fetch['Leval_id']."' ";
  	$runsqlE4=mysqli_query($conn,$sqlE4);
	$sql4fetchE=mysqli_fetch_array($runsqlE4);
	

     $dd=date('Y-m-d',strtotime($fetchgen['entryDate']));
	 $d = strtotime("+".$sql4fetchE['Expiry_month']." months",strtotime($dd));
    // $R=  date("d-m-Y",$d);

$formattedValue = date("F Y", strtotime($d));
$R=  date("d-m-Y",$formattedValue);



class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
     // $image_file =$fetchotel['logo'];
      
       /*$image_file ='gold_logo.png';
        $this->Image($image_file, 20,10, 170, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->Ln(90);*/
        /*$this->SetFont('helvetica', 'B', 20);
        
       $this->Cell(0, 10,'The Orchid Pune', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();*/
/*$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'H.O: 230 S.N.Roy Road, Kolkata- 700038', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();*/
/*$this->SetFont('helvetica', '', 10);
   $this->Cell(0, 5, 'Service Help Line-033-32017233 / 65181192/Fax: 033-24886047.Email-service3@avoups.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');*/

//$this->Ln(5);



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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



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

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln(5);

//
$pdf->image('gold_logo.png',10,10,180,80);
$pdf->Ln(100);
$pdf->image('GOLD.png',80,90,50,40);


$pdf->Cell(170, 10, 'Dear:'.$Primary_nameOnTheCard.' , ', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$pdf->MultiCell(170, 10, 'Welcome to Orchid Gold and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(20);

$pdf->MultiCell(170, 10, 'Your Membership Card number is '.$fetchgen['GenerateMember_Id'].'. The membership is valid till '.$R.' You may click here to view the Summary of Benefits of the membership.', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(20);

$pdf->MultiCell(170, 10, 'The annual membership charge of Rs. 10,000 + 18% Goods & Services Tax amounting to Rs. 11,800/- (Rupees Eleven Thousand Eight Hundred only) has been received by '.$fetchgen['MembershipDts_PaymentMode'].'. ', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(10);

$pdf->MultiCell(170, 10, 'You can present your membership number or a copy of this email to start using your membership benefits.', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(10);

$pdf->MultiCell(170, 10, 'The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email.', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(10);

$pdf->Cell(100, 10, 'We look forward to welcoming you as our esteemed Orchid Gold member.', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$pdf->Cell(170, 10, 'Yours sincerely', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$pdf->Cell(170, 10, 'Team Orchid Gold', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$pdf->Cell(170, 10, '+91 9169166789', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$pdf->Cell(170, 10, 'www.orchidhotel.com', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$pdf->Cell(170, 10, 'Gift Certificates issued', 0, 'L', 1, 0, '', '', true);
$pdf->Ln(10);

$htmtab1='Summary
<table border="1" width="90%" align="center">

<tr height="5px">
<th>SN</th><th>Type</th><th>Certificate Number</th>
</tr>';

$htmtab1_body="";
$srno=1;

//echo $did;
  $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."'";
//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){


$htmtab1_body.='
<tr height="5px">
<td>'.$srno.'</td>
<td>'. $sql2fetch['serviceName'].'</td>
<td>'. $sql2fetch['serialNumber'].'</td>
</tr>
';
    
    $srno++;
} 

$tbl_footer='
</table>
';

$pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');


$pdf->MultiCell(170, 10, 'For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(10);

$pdf->image('orchid1.png',20,160,20,30);
$pdf->image('jadhav1.png',60,160,20,30);
$pdf->image('mahodadhi1.png',160,160,20,30);
$pdf->image('lotus1.png',160,160,20,30);
$pdf->Ln(40);
////////////////////////////////////////////////////////////

$pdf->Cell(170, 10, 'The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited. ', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(10);

$pdf->MultiCell(160, 10, 'This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(20);

$pdf->MultiCell(160, 10, 'Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(10);
//Close and output PDF document


$from = "leads@loyaltician.com"; 
$subject = "PDF Attachment"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;


// attachment name
$filename = "OrchidGold.pdf";


//////////////////////////////////////////////

$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "Welcome Orchid Gold.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";
$m='meanand.gupta21@gmail.com'.",".'kvaljani@gmail.com';
// send message
if(mail($m, $subject, $body, $headers))
{
  echo "Mail Sent Successfully";
 // echo '<scripit>window.open("view_alert.php", "_self" )</script>';
}else{
  echo "Mail Not Sent";
}


?>