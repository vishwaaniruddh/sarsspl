<?php session_start();

require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
$qry=$_POST['qr1'];




$Static_LeadID=$_REQUEST['id'];

$sql = mysqli_query($conn,"select * from Members where Static_LeadID='".$Static_LeadID."'");
$sql_result = mysqli_fetch_assoc($sql);

$receiptNO = $sql_result['receipt_no'];
$MembershipDetails_Level = $sql_result['MembershipDetails_Level'];
$memGST = $sql_result['GST_Number'];
if($memGST){

}else{
    $memGST ='27AADCL8692D1Z8';
}









$leads_sql = mysqli_query($conn,"select * from Leads_table where Lead_id='".$Static_LeadID."'");
$leads_sql_result = mysqli_fetch_assoc($leads_sql);


$Primary_nameOnTheCard = $sql_result['Primary_nameOnTheCard'];
$receipt_no = $sql_result['receipt_no'];
$entryDate = $sql_result['entryDate'];
$entryDate =  date("d-m-Y", strtotime($entryDate));
$MembershipDetails_Level = $sql_result['MembershipDetails_Level'];
if($MembershipDetails_Level==1){
    $level ='Classic';
}elseif($MembershipDetails_Level==2){
    $level ='Signature';
}elseif($MembershipDetails_Level==3){
    $level ='Ivory';
}

$ExpiryDate = $sql_result['ExpiryDate'];
$ExpiryDate =  date("d-m-Y", strtotime($ExpiryDate));
$MembershipDetails_Fee = $sql_result['MembershipDetails_Fee'];
$MembershipDts_PaymentMode = $sql_result['MembershipDts_PaymentMode'];

$CGST=$sql_result['MembershipDts_GST']/2;
$MembershipDts_GrossTotal = $sql_result['MembershipDts_GrossTotal'] ;

$MobileNumber = $leads_sql_result['MobileNumber'];
$Company = $leads_sql_result['Company'];
$EmailId = $leads_sql_result['EmailId'];




$QuryGetLead=mysqli_query($conn,"select * from Leads_table where Lead_id='".$Static_LeadID."'");
$fetchLead=mysqli_fetch_array($QuryGetLead);


$QL=mysqli_query($conn,"select * from Level where Leval_id='".$MembershipDetails_Level."' ");
$FL=mysqli_fetch_array($QL);

$sqlexpiry="SELECT Expiry_month FROM `validity` where Leval_id='".$MembershipDetails_Level."' ";
    //echo $sqlexpiry;
	$QryExpiry=mysqli_query($conn,$sqlexpiry);
	$fetchExpiry=mysqli_fetch_array($QryExpiry);
	
 	 $currentDate=date('Y-m-d');
    

    $dd= date("d-m-Y");
 	 $d = strtotime("+".$fetchExpiry['Expiry_month']." months",strtotime($currentDate));
     $R=  date("d-m-Y",$d);
	
	$CGST=$sql_result['MembershipDts_GST']/2;
	
	
	
	
	
	




class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
     // $image_file =$fetchotel['logo'];
       $From=$_POST['From1'];
    $To=$_POST['To1'];
      
     
    //   $image_file ='LoyalticianLogo.jpg';
    //     $this->Image($image_file, 110, 7, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
    //   $image_file ='wlogo.jpg';
    //     $this->Image($image_file, 75, 4, 35, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
    //     $this->Ln(22);
    //     // Set font
    //     $this->SetFont('helvetica', 'B', 15);
    //       $this->Cell(0, 10,'The Resort Mumbai', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    //       $this->Ln();
    //       $this->SetFont('helvetica', 'B', 10);
    //       $this->Cell(0, 10,'From:- '.$From.'  To :- '.$To , 0, false, 'L', 0, '', 0, false, 'M', 'M');

        
   
// $this->SetFont('helvetica', 'B', 10);
 
// $this->Ln();
// $this->SetTextColor(255,255,255);
//  $this->Rect(10,43,190,7,'F','',$fill_color = array(0, 0, 0));

// $this->Cell(0, 10, 'DAILY EMBOSSING REPORT', 0,0,'C',false, '', 0, false, 'M', 'M');
// $this->Ln();$this->Ln();$this->Ln();$this->Ln();


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
$pdf->SetTitle($Primary_nameOnTheCard);
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
// $pdf->SetMargins(10, 10, 10, true);
// add a page
$pdf->AddPage();
$pdf->SetMargins(5, 0, 5, true);



// $pdf->setCellPaddings(4, 4, 4, 5);
// set cell margins
// $pdf->setCellMargins(0, 1, 0, 1);
// set color for background
$pdf->SetFillColor(255, 255, 127);
// $pdf->setCellPadding(5,5,5,5);


// $pdf->Ln(1);



$htmtab1='<div>
              <h1>INVOICE</h1>
        </div>

        
        
        <table border="1" cellpadding="5">
                                        <thead>
                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: rgb(239, 154, 154); color: black; ">Invoice to: (Customer Details)</th>                                            
                                            <th colspan="2" style="background-color: rgb(239, 154, 154); color: black; ">Invoice Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="4">Company Name : '.$Company.' </td>
                                            <td border="0" colspan="1">Date :</td>
                                            <td border="0" colspan="1">'.$entryDate.'</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="4">Name : '.$Primary_nameOnTheCard.' </td>
                                            <td colspan="1">Receipt: </td>
                                            <td colspan="1">'.$receipt_no.'</td>
                                        </tr>
                                        <tr>
                                        
                                            <td colspan="4">Phone: '.$MobileNumber.'</td>
                                            <td colspan="2">Membership Details</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4">Email : '.$EmailId.' </td>
                                            <td colspan="1">Level :</td>
                                            <td colspan="1">'.$level.'</td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="" colspan="4">GSTN: '.$memGST.' </td>
                                           <td colspan="1">Validity :</td>
                                            <td colspan="1">'.$ExpiryDate.'</td>
                                        </tr>

                                        <tr style="background-color: rgb(239, 154, 154); color: black; ">
                                            <td class="" colspan="3">Description</td>
                                           <td colspan="1">Quantity :</td>
                                            <td colspan="1">Unit Price</td>
                                            <td colspan="1">Amount</td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">'.$level.' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">'.$MembershipDetails_Fee.'</td>
                                            <td colspan="1">'.$MembershipDetails_Fee.'</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: rgb(239, 154, 154); color: black; ">Payment Details:</td>
                                           <td colspan="2" style="background-color: rgb(255, 250, 205); color: black; ">Subtotal:</td>
                                            <td colspan="1" style="background-color: rgb(255, 250, 205); color: black; ">'.$MembershipDetails_Fee.'</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: rgb(239, 154, 154); color: black; ">Received by : '.$MembershipDts_PaymentMode.'</td>
                                           <td colspan="2" style="background-color: rgb(255, 250, 205); color: black; ">CGST @ 9% </td>
                                            <td colspan="1" style="background-color: rgb(255, 250, 205); color: black; ">'.$CGST.'</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: rgb(239, 154, 154); color: black; ">Instrument Number/ Approval Code: MOJO</td>
                                           <td colspan="2" style="background-color: rgb(255, 250, 205); color: black; ">GGST @ 9% </td>
                                            <td colspan="1" style="background-color: rgb(255, 250, 205); color: black; ">'.$CGST.'</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: rgb(239, 154, 154); color: black; ">Cheque Favouring - Loyaltician CRM India Private Limited- theresortmumbai Membership:</td>
                                           <td colspan="2" style="background-color: rgb(239, 154, 154); color: black; ">Total including Taxes </td>
                                            <td colspan="1" style="background-color: rgb(239, 154, 154); color: black; ">'.$MembershipDts_GrossTotal.'</td>
                                        </tr>
                                        
                                       <tr>
                                        <td class="" colspan="6" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is the final invoice regarding the purchase.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
                                            
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div>
                                    <p>
                                      Signed
                                      <br><br>
For Loyaltician CRM India Private Limited
                                    </p>
                                    <hr>
                                    <div style="text-align:center">
                                        © Loyaltician 2019
                                    </div>
                                </div>
                                ';



// echo $htmtab1 ; 
// return ; 
$pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');
//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);
$pdf->Ln(5);

//Close and output PDF document
$pdf->Output('memberpdf/'.$Static_LeadID.'.pdf','F');
// $pdf->Output($Primary_nameOnTheCard.'.pdf', 'D');

?>