<a href="../welcome1.php">Back</a><br/>
<?php
include_once('../sql/include/DB.php');
include('../numtowords.php');
require_once 'src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
//echo "SELECT asc,st FROM `yearly_amc` where year='".date('Y')."'";
$amc_amt_qry=mysql_query("SELECT `asc`,`st` FROM `yearly_amc` where year='".date('Y')."'");
$amc_amt_row=mysql_fetch_row($amc_amt_qry);
$cust_query=mysql_query("select * from primarymember where active='Y' and acno not in (select acc_no from amc_invoice where YEAR(to_date)=".date("Y").") and amc<>'No ASC'");
$today_date=date('Y-m-d');
while($cust=mysql_fetch_array($cust_query))
{
		//echo $cust['acno']."AMC amt: ".$amc_amt_row[0]."<br/>";
		echo $cust['acno']."<br/>";
		$amc_amt=$amc_amt_row[0];
		//echo "SELECT member  FROM `package` WHERE `desc` LIKE '".$cust['pack']."'";
		$pack_qry=mysql_query("SELECT member  FROM `package` WHERE `desc` LIKE '".$cust['pack']."'");
		$pack=mysql_fetch_array($pack_qry);
		$num_member=0;
		if($pack[0]>3 && $cust['amc']!='12000.00')
		{
			$num_member=$pack[0]-3;
		}
		if($pack[0]==0 && $cust['amc']!='12000.00')
		{
			$amc_amt=2400;
		}
		if($cust['amc']=='12000.00')
		{
			$amc_amt=12000;
		}
		$amc_amt=$amc_amt+(1080*$num_member);
		if(strtotime($cust['joindt'])<strtotime((date("Y")-1)."-01-01")){
			$num_days=365;
			$amt=round($amc_amt);
			$sdate_disp=date("d-m-Y",strtotime("01-01-".date("Y")));
		}
		else{
			$sdate  = strtotime($cust['joindt']);
			$edate  = strtotime((date("Y"))."-12-31");
                       // echo (date("Y")-1)."-12-31";
			//echo "sdate : ".$sdate."<br> edate : ".$edate;
                        $diff=$edate-$sdate;
                       //  echo "diff=".$diff;
			$num_days = (int)($diff/86400);	
                      //  echo "num_days=".$num_days;	
			$amt=round($num_days*($amc_amt/365));	
			$sdate_disp=date("d-m",$sdate)."-".date("Y");
		}
		$st=round(($amt*$amc_amt_row[1])/100);
		$gt=round($amt+$st);
		//echo "INSERT INTO `amc_invoice`(`acc_no`, `cname`, `address1`, `address2`, `address3`, `address4`, `num_member`, `amt`, `st`, `bill_date`, `from_date`, `to_date`,`telno`,`mob1`,`mob2`) VALUES ('".$cust['acno']."','".addslashes($cust['title'].". ".$cust['name']." ".$cust['lname'])."','".addslashes($cust['address1'])."','".addslashes($cust['address2'])."','".addslashes($cust['address3'])."','".addslashes($cust['address4'])."','".($pack[0]+1)."','".$amt."','".$st."','".$today_date."','".date('Y-m-d',strtotime($sdate_disp))."','".date('Y-m-d',strtotime("31-12-".date("Y")))."','".$cust['telno']."','".$cust['mob1']."','".$cust['mob2']."')<br/>";
		$amc_inv=mysql_query("INSERT INTO `amc_invoice`(`acc_no`, `cname`, `address1`, `address2`, `address3`, `address4`, `num_member`, `amt`, `st`, `bill_date`, `from_date`, `to_date`,`telno`,`mob1`,`mob2`) VALUES ('".$cust['acno']."','".addslashes($cust['title'].". ".$cust['name']." ".$cust['lname'])."','".addslashes($cust['address1'])."','".addslashes($cust['address2'])."','".addslashes($cust['address3'])."','".addslashes($cust['address4'])."','".($pack[0]+1)."','".$amt."','".$st."','".$today_date."','".date('Y-m-d',strtotime($sdate_disp))."','".date('Y-m-d',strtotime("31-12-".date("Y")))."','".$cust['telno']."','".$cust['mob1']."','".$cust['mob2']."')");
		if($amc_inv)
		{
			$invid=mysql_insert_id();
	
// New Word Document
$phpWord = new \PhpOffice\PhpWord\PhpWord(); 
$section = $phpWord->addSection(); 
$header = array('size' => 10, 'bold' => true);
// 1. Basic table
$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Tahoma', 'size' => 7, 'bold' => true)
);
$rows = 10;
$cols = 5;
$section->addText(htmlspecialchars(''), $header);

$table = $section->addTable();
for ($r = 1; $r <= 5; $r++) {
    $table->addRow();
    for ($c = 1; $c <= 4; $c++) {
         if($c==1 and $r==1)
        $table->addCell(3750)->addText(htmlspecialchars("Invoice No. ".$invid), $fontStyleName);
         else if($c==4 and $r==1)
        $table->addCell(1850)->addText(htmlspecialchars("Date: ".date('d-m-Y')), $fontStyleName);
         else if($c==1 and $r==2)
        $table->addCell(3750)->addText(htmlspecialchars("Account No. ".$cust['acno']), $fontStyleName);
        else if($c==1 and $r==3)
        $table->addCell(3750)->addText(htmlspecialchars("To,".$cust['title'].". ".$cust['name']." ".$cust['lname']),$fontStyleName);
        
        else if($c==1 and $r==4)
		{
			$addr=$table->addCell(3750);
        	if(trim($cust['address1']!="" || $cust['address2']!="")){
			 $addr->addText(htmlspecialchars(stripslashes($cust['address1'].$cust['address2'])),$fontStyleName);
			}
			if(trim($cust['address3']!="" || $cust['address4']!="")){
			 $addr->addText(htmlspecialchars(stripslashes($cust['address3'].$cust['address4'])),$fontStyleName);
			}
			
			if(trim($cust['telno']!="" || $cust['mob1']!="" || $cust['mob2']!="")){
			 $addr->addText(htmlspecialchars(stripslashes("Tel. : ".$cust['telno']."/".$cust['mob1']."/".$cust['mob2'])),$fontStyleName);
			}
			
		}
         else
        $table->addCell(1750)->addText(htmlspecialchars(""));
    }
}

// 2. Advanced table

//$section->addTextBreak(1);
//$section->addText(htmlspecialchars('Fancy table'), $header);

$styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80,'size'=>7);
$styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
$styleCell = array('valign' => 'center');
$styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
$fontStyle = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$table = $section->addTable('Fancy Table');
$table->addRow(600);
$table->addCell(1000, $styleCell)->addText(htmlspecialchars('Sr No.'), $fontStyle);
$table->addCell(5000, $styleCell)->addText(htmlspecialchars('Particulars'), $fontStyle);
$table->addCell(1500, $styleCell)->addText(htmlspecialchars('Rate'), $fontStyle);
$table->addCell(1500, $styleCell)->addText(htmlspecialchars('Amount Rs.'), $fontStyle);
for ($i = 1; $i <= 5; $i++) {
    $table->addRow();
    if($i==1){
    $table->addCell(1000)->addText(htmlspecialchars("1"));    
	$detail=$table->addCell(5000);
    $detail->addText(htmlspecialchars("A.S.C for ",date('Y')));
	$detail->addText(htmlspecialchars("From : ".$sdate_disp." To : 31-12-".date("Y")));
	$detail->addText(htmlspecialchars("Number of Days : ".$num_days."   "."Number of member : ".($pack[0]+1)));
	
    $table->addCell(1500)->addText(htmlspecialchars(""));
    $table->addCell(1500)->addText(htmlspecialchars($amt)); 
     }
     else if($i==2){
        $table->addCell(1000)->addText(htmlspecialchars(""));    
      $table->addCell(5000)->addText(htmlspecialchars("Total"),null,array('align' => 'right'));    
      $table->addCell(1500)->addText(htmlspecialchars(""));    
      $table->addCell(1500)->addText(htmlspecialchars($amt), $fontStyle);    
        }
     else if($i==3){
        $table->addCell(1000)->addText(htmlspecialchars(""));    
      $table->addCell(5000)->addText(htmlspecialchars("Service Tax @ ".$amc_amt_row[1]." %"),null,array('align' => 'right'));    
      $table->addCell(1500)->addText(htmlspecialchars(""));    
      $table->addCell(1500)->addText(htmlspecialchars($st), $fontStyle);    
        }
      else if($i==4){
        $table->addCell(1000)->addText(htmlspecialchars(""));    
      $table->addCell(5000)->addText(htmlspecialchars("Grand Total Rs. "),null,array('align' => 'right'));    
      $table->addCell(1500)->addText(htmlspecialchars(""));    
      $table->addCell(1500)->addText(htmlspecialchars($gt), $fontStyle);    
        }
      else if($i==5){
      $table->addCell(7500, array('gridSpan' => 3))->addText(htmlspecialchars(ucwords(strtolower(convert_number_to_words(round($gt))))."only /-"), $fontStyle,array('align' => 'right','size'=>7));
   //   $table->addCell(1000)->addText(htmlspecialchars("Bill Amt. Rs."));    
   //   $table->addCell(5000)->addText(htmlspecialchars(" One Thousand One Hundred And Fifty //Three only /-"), $fontStyle);    
     // $table->addCell(1500)->addText(htmlspecialchars(""));    
      $table->addCell(1500)->addText(htmlspecialchars(""));    
        }
     else{
      $table->addCell(1000)->addText(htmlspecialchars(""));    
      $table->addCell(5000)->addText(htmlspecialchars(""));    
      $table->addCell(1500)->addText(htmlspecialchars(""));    
      $table->addCell(1500)->addText(htmlspecialchars(""));    
         }   
}
$table->addRow();
$table->addCell(9000, array('gridSpan' => 4))->addText(htmlspecialchars("Service Tax No: AACCB8898GSD001".' '."Pan Card No: AACCB8898G"),array('size'=>7));
$table->addRow();
$table->addCell(9000, array('gridSpan' => 4))->addText(htmlspecialchars("Service Tax Code: SP MUM DIV/ VIH CF02/06-07"),array('size'=>7));
$table->addRow();
$table->addCell(9000, array('gridSpan' => 4))->addText(htmlspecialchars("Please Note:"."Members can Courier their Cheque through \"Vichare Courier\" on the below address"),$fontStyle,array('align' => 'left','size'=>5));
$table->addRow();
$year=date('Y');
$table->addCell(9000, array('gridSpan' => 4))->addText(htmlspecialchars("Non payment of Asc will attract reduction in tenure as per notification issued to all members on 30th Jan ".$year),array('size'=>7));
$table->addRow();
$table->addCell(9000, array('gridSpan' => 4))->addText(htmlspecialchars("Postal Address : The Blue Roof Club Ovla G.B. Road, Thane 400 607"),array('size'=>7));
$table->addRow();
$table->addCell(9000, array('gridSpan' => 4))->addText(htmlspecialchars("Cheque in favour of - \"M/s.Blue Roof Infotainment Pvt. Ltd. A / c A.S.C\" "),array('size'=>7));
$table->addRow();
$foot=$table->addCell(9000, array('gridSpan' => 4));
$foot->addText(htmlspecialchars("For BLUE ROOF INFOTAINMENT PVT. LTD"),null,array('align' => 'right','size'=>7));
$foot->addText(htmlspecialchars("E & O E"),array('size'=>7));
$foot->addText(htmlspecialchars("Administration"),null,array('align' => 'right','size'=>7));

// Save file
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("Invoices/".$cust['acno'].'.docx');
		}//end of if amc insert success
}//end while
?>
