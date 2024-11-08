<?php
include("access.php");
ini_set( "display_errors", 0);
?>
<link href="menu.css" rel="stylesheet" type="text/css" /><center>
<?php
include("menubar.php");
?>
</center>
<?php
// Test CVS
//$ass=$_POST['ass'];
//$ass2=$_POST['ass1'];
//$spec=$_POST['spec'];
//$valid=$_POST['valid'];
include("config.php");
//$astcnt=mysqli_query($con,"select * from assets");
//$astnum= mysqli_num_rows($astcnt);

$err=array();
$errrep=array();


$atm=array();
$consumer=array();
$fdt=array();
$tdt=array();
$bdt=array();
$ddt=array();
$pdt=array();
$openr=array();
$closer=array();
$units=array();
$paidamt=array();
$xtra=array();
$tamt=array();
$cid=array();
$counter=0;
//include_once('class_files/select.php');
//$sel_obj=new select();
//$state=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("state","state_id"),"state","","",array(""),"y","state","a");
//$stqr=mysqli_query($con,"select state,state_id from state ");

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/
$maxsize='412';

$size=($_FILES['userfile']['size']/1024);

 

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name']; 

///echo $fichier;
 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
	
if($fichier){
	 
$filename = stripslashes($_FILES['userfile']['name']);

			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img/".$image_name;
	///echo $newname;	
	
$copied = copy($_FILES['userfile']['tmp_name'], $newname);


if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;
////echo $newname;

$data->read($newname);


error_reporting(E_ALL ^ E_NOTICE);
$ab=array();


for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	//echo $x." ".$ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11].",".$ab[12].",".$ab[13]."<br><br><br>";
	//echo "select short_name from contacts where contact_first like ('".$ab[14]."%')";
	$cl=mysqli_query($con,"select short_name from contacts where contact_first like ('".$ab[14]."%')");
	if(mysqli_num_rows($cl)>0)
	{
	$clro=mysqli_fetch_row($cl);
	//echo "select * from ".$clro[0]."_sites where atm_id1='".$ab[1]."'";
	$site=mysqli_query($con,"select * from ".$clro[0]."_sites where atm_id1='".$ab[1]."'");
	if(mysqli_num_rows($site)>0)
	{
	if($ab[1]=='' || $ab[2]=='' || $ab[3]=='' || $ab[4]=='' || $ab[5]=='' || $ab[6]=='' || $ab[7]=='' || $ab[8]=='' || $ab[9]=='' || $ab[10]=='' || $ab[11]=='' || $ab[12]=='' || $ab[13]=='')
	{
	$errrep[]=" Failed because of Blank Field";
	$err[]=$x;
	 $atm[]=$ab[1];
 $consumer[]=$ab[2];
 $fdt[]=$ab[3];
 $tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
	}
	else
	{
	//echo "<br>select Consumer_No from ebill where ATM_ID='".$ab[1]."'<br>";
$con=mysqli_query($con,"select Consumer_No,averagebill from ".$clro[0]."_ebill where ATM_ID='".$ab[1]."'");
$cons=mysqli_fetch_row($con);
//echo "in database ".$cons[0]."<br> u are uploading: ".$ab[2]."<br>";
if($cons[0]!=$ab[2])
{
$errrep[]=" Consumer number Not Found";
	$err[]=$x;
	$atm[]=$ab[1];
$consumer[]=$ab[2];
$fdt[]=$ab[3];
$tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
}
else
{
//echo "hi";
//$frm=TEXT($ab[3],"YYYYMMDD") ;
//echo "frm=".$frm;
//echo "<br>".$ab[3]." ".$ab[4]." ".$ab[5]." ".$ab[6]." ".$ab[7]."<br><br>";
  $fromdt=str_replace("/","-",$ab[3]);
  $todt=str_replace("/","-",$ab[4]);
  $billdt=str_replace("/","-",$ab[5]);
  $duedt=str_replace("/","-",$ab[6]);
  $paiddt=str_replace("/","-",$ab[7]);
	//echo $dt." ";
	//echo "<br>";
	 $fromdt=date('Y-m-d', strtotime($fromdt .' -1 day'));//echo "<br>";
	 $todt=date('Y-m-d', strtotime($todt .' -1 day'));//echo "<br>";
	 $billdt=date('Y-m-d', strtotime($billdt .' -1 day'));//echo "<br>";
	 $duedt=date('Y-m-d', strtotime($duedt .' -1 day'));//echo "<br>";
	 $paiddt=date('Y-m-d', strtotime($paiddt .' -1 day'));//echo "<br>";
	
	if($fromdt=='' || $todt=='' || $billdt=='' || $duedt=='' || $paiddt=='' || $fromdt=='1970-01-01' || $todt=='1970-01-01' || $billdt=='1970-01-01' || $duedt=='1970-01-01' || $paiddt=='1970-01-01')
	{
	//echo "<br>hello".$ab[1]."<br>";
	$errrep[]=" Failed because of Invalid Date Format";
	$err[]=$x;
	$atm[]=$ab[1];
$consumer[]=$ab[2];
$fdt[]=$ab[3];
$tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
	$counter=$counter+1;
	}
	else
	{
	//echo "hi";
	//echo "<br>select max(bill_no),end_date from ebdetails where atmid='".$ab[1]."' and start_date='".$fromdt."' and end_date='".$todt."'<br>";
	$eb=mysqli_query($con,"select * from ebdetails where atmid='".$ab[1]."' and start_date='".$fromdt."' and end_date='".$todt."'");
	//$row=mysqli_fetch_row($eb);
	//echo mysqli_num_rows($eb)."<br>";
	//if($row[1]<$fromdt)
	if(mysqli_num_rows($eb)=='0')
	{
	$sitero=mysqli_fetch_row($site);
	if($ab[14]=='FSS' && $sitero[10]=='ICICI' && $ab[13]>'10000')
	$stat='w';
	elseif($ab[14]=='FSS' && $sitero[10]!='ICICI' && $ab[13]>'8000')
	$stat='w';
	else
	$stat='n';
	
	
	
	$sql ="insert into `ebdetails`(atmid,bill_date,unit,amount,status,start_date,end_date,due_date,opening_reading,closing_reading,extracharge,print,cust_id,trackerid)values('$ab[1]','".$billdt."','$ab[10]','$ab[13]','paid','".$fromdt."','".$todt."','".$duedt."','".$ab[8]."','".$ab[9]."','".$ab[12]."','".$stat."','".$clro[0]."','".$sitero[54]."')";
	//echo $sql;
	$billdetail=mysqli_query($con,$sql);
	if(!$billdetail)
	$errrep[]="Database Query Error".mysqli_error();
	if($billdetail)
	{
	$res=mysqli_query($con,"select max(bill_no) from ebdetails");
		$bill_id=mysqli_fetch_array($res);
		$sql1 =mysqli_query($con,"insert into `ebpayment`(`Bill_No`,`Paid_Amount`,`Paid_Date`) values('$bill_id[0]','$ab[11]','".$paiddt."')");
		if($sql1)
		{
		
		}
		else
		{
		$errrep[]=" Database Query Error".mysqli_error();
		//echo "<br>ebpayment=".mysqli_error()."<br>";
		//echo "delete from ebdetails where bill_no='".$bill_id[0]."'";
		$qr=mysqli_query($con,"delete from ebdetails where bill_no='".$bill_id[0]."'");
		
		$err[]=$x;
		$atm[]=$ab[1];
$consumer[]=$ab[2];
$fdt[]=$ab[3];
$tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
	$counter=$counter+1;
		}
	}
	else
	{
	//echo "<br>ebdetails=".mysqli_error()."<br>";
	
	$err[]=$x;
	$counter=$counter+1;
	$atm[]=$ab[1];
$consumer[]=$ab[2];
$fdt[]=$ab[3];
$tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
	}
	}
	else
	{
	//echo $row[1]." ".$fromdt."<br>";
	$errrep[]=" Bill already generated for this Date";
	$err[]=$x;
	$atm[]=$ab[1];
$consumer[]=$ab[2];
$fdt[]=$ab[3];
$tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
	$counter=$counter+1;
	}

	}//end of date else
	
	}//end of else ka loop
}//End consumer check	
	}//end of site check if condition
	else
	{
	$errrep[]=" Site not Available";
	$err[]=$x;
	$atm[]=$ab[1];
$consumer[]=$ab[2];
$fdt[]=$ab[3];
$tdt[]=$ab[4];
$bdt[]=$ab[5];
$ddt[]=$ab[6];
$pdt[]=$ab[7];
$openr[]=$ab[8];
$closer[]=$ab[9];
$units[]=$ab[10];
$paidamt[]=$ab[11];
$xtra[]=$ab[12];
$tamt[]=$ab[13];
$cid[]=$ab[14];
	$counter=$counter+1;
	}
}//end client id
}//end x ka for loop


//header('location:newsite.php');

}

//echo "<br>error count ".count($err)." ".count($errrep)."<br>";
if(count($errrep)>0)
{
?>
<form name="frm" action="send2app.php" method="post">

<?php
echo "<div align='center'> a<h2>Total ".count($errrep)." Atm IDs has failed to upload due to Invalid date Format or This particular bill has already been Entered </h2><br>";
echo "<a href='importebill.php'>Click here to go back</a><br>";
echo "Please Correct Below rows Data to upload<br><table><th>Row Number</th><th>Error</th></tr>";
for($a=0;$a<count($errrep);$a++)
{
?>
<input type="hidden" name="atm[]" id="atm<?php echo $a; ?>" value="<?php echo $atm[$a]; ?>" />
<input type="hidden" name="fdt[]" id="fdt<?php echo $a; ?>" value="<?php echo $fdt[$a]; ?>" />
<input type="hidden" name="tdt[]" id="tdt<?php echo $a; ?>" value="<?php echo $tdt[$a]; ?>" />
<input type="hidden" name="bdt[]" id="bdt<?php echo $a; ?>" value="<?php echo $bdt[$a]; ?>" />
<input type="hidden" name="ddt[]" id="ddt<?php echo $a; ?>" value="<?php echo $ddt[$a]; ?>" />
<input type="hidden" name="pdt[]" id="pdt<?php echo $a; ?>" value="<?php echo $pdt[$a]; ?>" />
<input type="hidden" name="openr[]" id="openr<?php echo $a; ?>" value="<?php echo $openr[$a]; ?>" />
<input type="hidden" name="closr[]" id="closer<?php echo $a; ?>" value="<?php echo $closer[$a]; ?>" />
<input type="hidden" name="unit[]" id="unit<?php echo $a; ?>" value="<?php echo $units[$a]; ?>" />
<input type="hidden" name="paidamt[]" id="paidamt<?php echo $a; ?>" value="<?php echo $paidamt[$a]; ?>" />
<input type="hidden" name="xtra[]" id="xtra<?php echo $a; ?>" value="<?php echo $xtra[$a]; ?>" />
<input type="hidden" name="tamt[]" id="tamt<?php echo $a; ?>" value="<?php echo $tamt[$a]; ?>" />
<input type="hidden" name="consumer[]" id="consumer<?php echo $a; ?>" value="<?php echo $consumer[$a]; ?>" />
<input type="hidden" name="err[]" id="err<?php echo $a; ?>" value="<?php echo $errrep[$a]; ?>" />
<input type="hidden" name="cid[]" id="cid<?php echo $a; ?>" value="<?php echo $cid[$a]; ?>" />
<?php
echo "<tr><td>".$err[$a].":</td><td align=left>  ".$errrep[$a]."</td></tr>";


}
echo "</table></div>";

?>
<input type="submit" name="cmd" value="Send for Approval">
</form>
<?php
}
else
{
?>
<script type="text/javascript">
alert("Data uploaded successfully");
window.location='importebill.php';
</script>
<?php
}
///print_r($data);
////print_r($data->formatRecords);
?><script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>