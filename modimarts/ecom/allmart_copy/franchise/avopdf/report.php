<?php
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
//include('../config.php');
//$alertid=$_GET['aid'];
/*$sql=mysql_query("select * from alert where alert_id='".$alertid."'");
$row=mysql_fetch_array($sql);

$fsrsql=mysql_query("select * from FSR_details where alertid='".$alertid."'");
$fsrrow=mysql_fetch_array($fsrsql);*/

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
      $image_file ='manir.jpg';
        $this->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
       // $this->SetFont('helvetica', 'B', 20);
        $this->SetFont('freesans','B',20);
       $this->Cell(0, 10, ' बालाजी    चै ि रटेबल   ट्रस्ट     ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
$this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('freesans', '', 10);
$this->Cell(0, 5, 'ट्स्ट   र िज स्टेॢशन नं : E-१२३७० मुम्बई १९८७', 0, false, 'C', 0, '', 0, false, 'M', 'M');

$this->Ln();
$this->Ln();
 $this->SetFont('freesans','B',10);
$this->Cell(0, 5, 'चंदा रसीद', 1,0,'C',false, '', 0, false, 'M', 'M');

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
$pdf->SetTitle('E-FSR');
$pdf->SetSubject('Field Service Report');
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

// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln(15);


$pdf->SetFont('freeserif','',12);
$pdf->MultiCell(95, 5, 'क्रमाकं     :    '.    $ReciptNO, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(80, 5, 'तारीख     :    '.date('Y-m-d H:i:s'), 0, 'L', 0, 0, '', '', true);
$pdf->Ln(15);
$pdf->MultiCell(95, 5, 'दृारा  श्री   :    '.$Name, 0, '0', 0, 0, '', '', true);
//$pdf->MultiCell(80, 5, 'ATM ID:'.$atmid, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 5,' कंपनी का नाम  :    '.$CompanyName, 0, '0', 0, 0, '', '', true,0,true);
//$pdf->MultiCell(80, 5, 'Phone/Mobile:'.$phn, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 5,' के याद में    :    '.$Youremember, 0, '0', 0, 0, '', '', true,0,true);
$pdf->Ln();
$pdf->MultiCell(95, 5,'रुपये शब्दो मे    :    '.$RupeesWord, 0, 'L', 0, 0, '', '', true,0,true);


$calltype="<b>".$row[17]."</b>";
$servrendered=$row[17];
$pdf->Ln(22);
//$pdf->MultiCell(90, 5, 'Date of Call :'.$row[10], 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 5, 'सधन्यवाद   प्रा प्त     िकये: '.$cs, 0, 'L', 0, 0, '', '', true);


$pdf->Ln(10);

$htmtab1='
<table border="1" width="90%" align="center">
<tr height="5px">
<td>
संचित िन िध
</td>
<td>
कमरे का  ि नर्माण
</td>
<td>
 गौ सेवा
</td>
<td>
पेडो के लिये
</td>

</tr>

<tr height="5px">
<td>
'.$Fund.'
</td>
<td>
'.$Room.'
</td>
<td>
'.$cow.'
</td>
<td>
'.$Tree.'
</td>

</tr>
</table>
<br><br><br><br>
<br>';




$htmtab1.='<table  width="100%" align="left">
<tr height="5px">
<td>रोकड़ी , चेक ,RTGS ,क्रेड़िट काडॅ NO : '. $PayMode.' / </td>            

<td>'. $CardNo.' </td>
</tr>
<br>
<tr height="5px">
<td>मोबाइल : </td>            

<td> '. $Mobile.' </td>
</tr>

<br>
<tr height="5px">
<td>रुपये : </td>            

<td>'. $Amount .'</td>
</tr>

</table>
';



//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);
$pdf->writeHTML($htmtab1, true, false, false, false, '');


//$pdf->Output('example_003.pdf', 'I');



// attachment name
$filename = "PaymentRecipt.pdf";


//////////////////////////////////////////////

$pdfdoc = $pdf->Output("", "S");

//$Gmail=$fetchLead['EmailId'];
$Gmail='meanand.gupta21@gmail.com';



$EmailSubject="Payment Recipt !";

   $MESSAGE_BODY="";
//   $MESSAGE_BODY.="Sincerely,"."\r\n";
  // $MESSAGE_BODY.="Team The Orchid Pune,"."\r\n";
      
     $message="Payment Recipt From Mandir"."\r\n";
      $message1.=$body;
            
        $leadsmail=" Orchidmembership@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
  //  $mail->addAddress($Gmail); 
    $mail->addAddress('meanand.gupta21@gmail.com'); 
    $mail->mailheader=$mailheader;// Add a recipient
  //  $mail->addCC('leads@loyaltician.com');
    $mail->addBCC('kvaljani@gmail.com');
  //  $mail->addBCC('meanand.gupta21@gmail.com');
    
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    $mail->addStringAttachment($pdf->Output('',"S"), $filename, $encoding = 'base64', $type = 'application/pdf');
    $mail->send();
//==============mail end===









?>