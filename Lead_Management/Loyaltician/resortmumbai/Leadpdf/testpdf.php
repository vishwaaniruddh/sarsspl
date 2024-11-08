<?php
//include('../config.php');
include('../config.php');
require('fpdf.php');
//$mail=$_POST['email'];


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo1.png',10,6,30);
    // Arial bold 15
   // $this->SetFont('Arial','B',15);
    // $this->SetDrawColor(50,60,100);
    // Move to the right
   // $this->Cell(80);
    // Title
   //$this->Cell(30,10,'PROFORMA INVOICE',0,0,'C',0);
    // Line break
    
   // $this->Ln(20);
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


$pdf->image('LOYAL.png',20,10,30,20);
$pdf->image('FIRST.png',60,10,30,20);
$pdf->image('GOLD.png',110,10,30,20);
$pdf->image('PLATINUM.png',160,10,30,20);

$pdf->Rect(10, 10, 195, 50, 'D');

$pdf->Ln(20);
$pdf->SetFillColor(250, 255, 250);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(195,10,"Loyaltician CRM India Private Limited- Orchid Membership ",1,1,'C',true);

$pdf->SetFillColor(250, 255, 250);
$pdf->SetFont('Arial','B',7);
$pdf->multicell(195,5,"The Orchid Hotel Pune, Balewadi, Pune Bangalore Highway Pune 411045, Maharashtra orchidgoldpune@orchidhotel.com 
GSTN ID- 27AADCL8692D1Z8      State- Maharashtra     Code -27",1,1,'R',true);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(195,10,"Tax Invoice cum Receipt",1,1,'C',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(140,5,"Invoice to: (Customer Details)",1,0,'',true);
$pdf->Cell(55,5,"Invoice Details",1,1,'',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->Cell(140,5,"Company Name:",1,0,'',true);
$pdf->Cell(35,5,"Date",1,0,'',true);
$pdf->Cell(20,5,"2019/04/19 ",1,1,'',true);

$pdf->Cell(140,5,"Name:",1,0,'',true);
$pdf->Cell(35,5,"Invoice/ Receipt #",1,0,'',true);
$pdf->Cell(20,5,"11111111111 ",1,1,'',true);

$pdf->Cell(140,5,"Address:",1,0,'',true);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(55,5,"Membership Details",1,1,'C',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->Cell(140,5,"Phone:",1,0,'',true);
$pdf->Cell(35,5,"Membership #",1,0,'',true);
$pdf->Cell(20,5," ",1,1,'',true);

$pdf->Cell(140,5,"Email:",1,0,'',true);
$pdf->Cell(35,5,"Level",1,0,'',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,5,"Orchid Platinum",1,1,'',true);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(140,5,"GSTN::",1,0,'',true);
$pdf->Cell(35,5,"Validity",1,0,'',true);
$pdf->Cell(20,5," ",1,1,'',true);

$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Description:",1,0,'',true);
$pdf->Cell(15,5,"Quantity",1,0,'',true);
$pdf->Cell(35,5,"Unit Price",1,0,'',true);
$pdf->Cell(20,5,"Amount",1,1,'',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->Cell(125,20,"Orchid Gold Membership:",1,0,'',true);
$pdf->Cell(15,20,"1",1,0,'',true);
$pdf->Cell(35,20,"₹ 10,000",1,0,'',true);
$pdf->Cell(20,20,"₹ 10,000",1,1,'',true);

$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Payment Details:",1,0,'',true);

$pdf->SetFillColor(240, 238, 205);
$pdf->Cell(50,5,"Subtotal",1,0,'',true);
$pdf->Cell(20,5,"₹ 10,000",1,1,'',true);

$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Received by:",1,0,'',true);
$pdf->SetFillColor(240, 238, 205);
$pdf->Cell(50,5,"CGST @ 9%",1,0,'',true);
$pdf->Cell(20,5,"900",1,1,'',true);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Instrument Number/ Approval Code:",1,0,'',true);
$pdf->SetFillColor(240, 238, 205);
$pdf->Cell(50,5,"GGST @ 9%",1,0,'',true);
$pdf->Cell(20,5,"900",1,1,'',true);
$pdf->SetFillColor(236, 141, 120);
$pdf->Cell(125,5,"Cheque Favouring - Loyaltician CRM India Private Limited- Orchid Membership:",1,0,'',true);
$pdf->Cell(50,5,"Total including Taxes",1,0,'',true);
$pdf->Cell(20,5,"11,800",1,1,'',true);

$pdf->SetFillColor(250, 250, 250);
$pdf->multiCell(195,5,"Terms and Conditions
1. To avail input credit (if available), GSTN number and State is mandatory.
2. This is the final invoice regarding the purchase.
3. No refunds are entertained beyond 15 days of purchase
",1,1,'L',true);

$pdf->Ln(10);
$pdf->multiCell(97.5,5,"Signed

For Loyaltician CRM India Private Limited",0,1,'R',true);


$pdf->Output();


?>