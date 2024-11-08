<?php
include('config.php');
require('fpdf.php');
$mail=$_POST['email'];


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo1.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
     $this->SetDrawColor(50,60,100);
    // Move to the right
    $this->Cell(80);
    // Title
   $this->Cell(30,10,'PROFORMA INVOICE',0,0,'C',0);
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
/*
foreach($header as $heading) {
$pdf->Cell(40,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(40,12,$column,1);
}
*/
$DATE=date("Y/m/d");

$pdf->Cell(15,5,'DATE:',0,0,'l');
//$pdf->Cell(40,10,"Call_Ticket:",1,0);
$pdf->Cell(25,5,$DATE,0,1);
$address="hbhhsdf jsdhgsjdf jkdshf kjhufg jnjudnfgff ijbuhdf iunuidf iunuihedf iubniuybewf ibhiubsdf ikjhufgd";
$pdf->SetFont('Arial','B',10);
$pdf->Cell(22,5,"ORDER NO:",1,0);
$pdf->Cell(30,5,$orderno,0,1);
$pdf->Ln();
/*$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,5,'SENT BY:',0,0);
$pdf->multicell(60,5,$address,0,0);
//$pdf->Ln();

$pdf->Cell(120,5,'SENT TO:',1,0,'LRB');
$pdf->multicell(60,5,$address,0,1);

$pdf->Ln();
*/


   

    // Get X,Y coordinates
    $x = $pdf->GetX();
    $y = $pdf->GetY();

$pdf->Cell(20,5,'SENT BY:',0,0);
$pdf->multicell(45,5,$address,0,1);
//$pdf->Ln(10);
    // update the X coordinate to account for the previous cell width
    $x += 90;

    // set the XY Coordinates
    $pdf->SetXY($x, $y);

    $pdf->Cell(60,5,'SENT TO:',0,0,'R');
$pdf->multicell(45,5,$address,0,1);
$pdf->Ln(20);

$pdf->SetFillColor(200, 255, 32);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(195,8,"PRODUCT DETAILS ",1,1,'C',true);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(234,123,132);
$pdf->Cell(70,5,"product",1,0,'',true);
$pdf->Cell(25,5,"color",1,0,'',true);
$pdf->Cell(20,5,"size",1,0,'',true);
$pdf->Cell(20,5,"QTY",1,0,'',true);
$pdf->Cell(30,5,"price",1,0,'',true);
$pdf->Cell(30,5,"Total",1,1,'',true);



$pdf->Cell(70,5,$product,1,0);
$pdf->Cell(25,5,$color,1,0);
$pdf->Cell(20,5,$QTY,1,0);
$pdf->Cell(20,5,$QTY,1,0);
$pdf->Cell(30,5,$price,1,0);
$pdf->Cell(30,5,$Total,1,1);
$pdf->Cell(115,5,"Total",1,0,'R');
//$pdf->cell(25,5,$total,1,0);
//$pdf->cell(20,5,$total,1,0);
$pdf->cell(20,5,$total,1,0);
$pdf->cell(30,5,$total,1,0);
$pdf->cell(30,5,$total,1,0);


$pdf->Ln(30);
$pdf->SetFillColor(200, 32, 32);
$pdf->Cell(195,5,"THANK YOU FOR SHOPING AT MERABAZAAR",1,1,'C',true);
$pdf->Ln();
$pdf->SetFillColor(225, 225, 225);
$pdf->Cell(195,5,"NOTE: The actual taxable product invoice would reach to you along with product direct by seller",0,1,'C',true);

/*
$fontsize=12;
$pdf->Cell(120,10,"this is testing",0,1);
$tempFontSize=$fontsize;

$cellwidth=120;
while($pdf->GetStringWidth($e) > $cellwidth){
$pdf->SetFontsize($tempFontSize -=0.1);
}
$pdf->Cell($cellwidth,10,$e,0,1)
$tempFontSize=$fontsize;
$pdf->SetFontsize($fontsize);
*/
//$pdf->Cell(70,30,"Address:",1,0);
//$pdf->Cell(120,10,$e,1,1);
//$pdf->MultiCell(120,10,$e,1,1);
/*
$pdf->Cell(70,10,"Address:",1,0);
	$font_size = 14;
	$decrement_step = 0.1;
	$line_width = 120; // Line width (approx) in mm
	$pdf->SetFont('Arial','B',$font_size);
		while($pdf->GetStringWidth($e) > $line_width) {
		$pdf->SetFontSize($font_size -= $decrement_step);
	}
	
	$pdf->Cell($line_width, 10, $e, 1, 1);
   $pdf->SetFont('Arial','B',12);
$pdf->Cell(70,10,"Branch:",1,0);
$pdf->Cell(120,10,$f,1,1);

*/
$pdf->Output();

//$pdf->Output('filename.pdf','D');
// email stuff (change data below)
//$to = "ramshankargupta444@gmail.com"; 
/*
$from = "avo@example.com"; 
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
  echo '<script>window.open("view_alert.php", "_self" )</script>';
}else{
  echo "Mail Not Sent";
}

//echo '<script>window.open("view_alert.php", "_self" )</script>';
*/
?>