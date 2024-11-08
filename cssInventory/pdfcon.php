<?php
include('config.php');
require('fpdf.php');
$mail=$_POST['pdfimail'];
$lastid=$_POST['last'];
//echo $lastid;

//$lastid='1';
class PDF extends FPDF
{
// Page header

function Header()
{
    // Logo
    $this->Image('images.jpg',10,10,30);
    // Arial bold 15
    $this->Image('logo.png',180,12,15);
    $this->Ln(10);
    $this->SetFont('Arial','B',15);
     $this->SetDrawColor(50,60,100);
    // Move to the right
    $this->Cell(80);
    // Title
   $this->Cell(30,10,'PURCHASE ORDER',0,0,'C',0);
    // Line break
    
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);

//$DATE=date("Y/m/d");




date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
//echo $sql4;
   
     $x += 150;
     $y += 40;
    $pdf->SetXY($x, $y);
$pdf->Cell(10,5,'DATE:',0,0,'R');
$pdf->Cell(25,5,$date,0,1);
$pdf->Ln();
//$pdf->SetFont('Arial','B',10);
 $y += 8;
 $x += -2;
  $pdf->SetXY($x, $y);
$pdf->Cell(15,5,"ID      :",0,0);
$pdf->Cell(30,5,$lastid,0,1);
$pdf->Ln();

    // Get X,Y coordinates
    $x = $pdf->GetX();
    $y = $pdf->GetY();
// $x += 20;
 
 // $pdf->SetXY($x, $y);   
$address="506 A wing Anita Vihar                   Lokhanclwala Township Akurli Kandivali (East) Mumbai                           Email :- Viian(ahisouareindia.com Contact Pennon : Mr. Vijay / Mr.Vircndra";

$pdf->SetFont('','U');
$pdf->Cell(35,5,'Vsquare Networks:',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->multicell(70,5,$address,0,1);
$pdf->Ln();

   
$pdf->SetFont('Arial','U');
$pdf->Cell(35,5,'Subject:-Purchase Order',0,1);
//$pdf->Line(0,90,210,90);
//$pdf->Line(0,90.2,210,90.2);
$pdf->SetFont('Arial','B',10);

$declaration="Dear Sir,                                                                                                                                    We are pleased to place an order on you for the under mentioned                    items  as per terms and conditions cited below.";
$pdf->multicell(130,5,$declaration,0,1);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(234,123,132);
$pdf->Cell(25,5,"Sr. No",1,0,'',true);
$pdf->Cell(70,5,"Description",1,0,'',true);
$pdf->Cell(20,5,"Qty",1,0,'',true);
$pdf->Cell(20,5,"Per Rate",1,0,'',true);
$pdf->Cell(20,5,"GST-18%",1,0,'',true);
$pdf->Cell(30,5,"Total Amount",1,1,'',true);


$sql4="select * from po where po_in_id='".$lastid."'";
$result4=mysqli_query($conn,$sql4);

$sr='1';
while($row4=mysqli_fetch_array($result4))
{

$pdf->Cell(25,5,$sr,1,0);
$pdf->Cell(70,5,$row4['Description'],1,0);
$pdf->Cell(20,5,$row4['Qty'],1,0);
$pdf->Cell(20,5,$row4['Perrate'],1,0);
$pdf->Cell(20,5,$row4['Gst'],1,0);
$pdf->Cell(30,5,$row4['Total'],1,1);

$sr++;
}
$ttlqry="select sum(Total) from po where po_in_id='".$lastid."'";
$runttlqry=mysqli_query($conn,$ttlqry);
$ttlqtyf=mysqli_fetch_array($runttlqry);



$pdf->Cell(155,5,"Grand Total",1,0,'C');
$pdf->cell(30,5,$ttlqtyf[0],1,0);


$pdf->Ln(10);
$pdf->Cell(50,5,"Delivery should be to CSS Office (Chunabhatti)",0,1);

$pdf->Ln(20);
$pdf->Cell(185,5,"For Clear Secured Services Pvt.Ltd",0,1,'R');
$pdf->Ln(30);
$pdf->Cell(185,5,"Authorised Signatory",0,1,'R');
//$pdf->Output();


$from = "css.cssimdia.in"; 
$subject = "send email with pdf attachment"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "test.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded message.".$eol;

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

// send message
if(mail($mail, $subject, $body, $headers))
{
  echo "Mail Sent Successfully";
  //echo '<script>window.open("view_alert.php", "_self" )</script>';
}else{
  echo "Mail Not Sent";
}



?>