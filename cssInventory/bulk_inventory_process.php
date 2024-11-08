<?php

include("config.php");


$counter=0;

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
$maxsize='800';

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


$data->read($newname);


error_reporting(E_ALL ^ E_NOTICE);
$ab=array();
$contents='';

$modelno=$_POST['modelno'];

$mol="select modelno from model_no where id='".$modelno."'";
$runmol=mysqli_query($conn,$mol);
$femol=mysqli_fetch_array($runmol);

$material=$_POST['material'];
//$companyname=$_POST['companyname'];
$vendorname=$_POST['vendorname'];

$van="select Name from vendor where id='".$vendorname."'";
$runvan=mysqli_query($conn,$van);
$fetvan=mysqli_fetch_array($runvan);
$qty1=$_POST['qty'];


$mname="select Name from material where id='".$material."'";
$runmname=mysqli_query($conn,$mname);
$ros=mysqli_fetch_array($runmname);
$mate=$ros[0];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

	$sql="insert into Inventory_IN(vendorname,material,modelno,qty,entrydate)values('".$fetvan[0]."','".$mate."','".$femol[0]."','".$qty1."','".$date."')";
$result=mysqli_query($conn,$sql);
//echo $sql;
$last=mysqli_insert_id($conn);
//echo $last;

for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		//echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}
	
	
	 $sql2="select srno,InventoryIN from enventory_Stock where srno='".$ab[1]."'"; 
	 //echo $sql2;
	 
 $result2=mysqli_query($conn,$sql2);
 $numrow=mysqli_num_rows($result2);
	if($numrow >0)
	{
	    /*
	$contents.="\n ".preg_replace('/\s+/', ' ', $ab[1])." \t ".preg_replace('/\s+/', ' ', $ab[2])." \t ".preg_replace('/\s+/', ' ',$ab[3] )." \t ".preg_replace('/\s+/', ' ',$ab[4] )." \t ".preg_replace('/\s+/', ' ',$ab[5] )." \t ".preg_replace('/\s+/', ' ',$ab[6] )." \t ".preg_replace('/\s+/', ' ',$ab[7] )." \t ".preg_replace('/\s+/', ' ',$ab[8] )." \t ".preg_replace('/\s+/', ' ',$ab[9] )." \t ".preg_replace('/\s+/', ' ',$ab[10] )." \t ".preg_replace('/\s+/', ' ',$ab[11] )." \t ".preg_replace('/\s+/', ' ',$ab[12] )." \t ".preg_replace('/\s+/', ' ',$ab[13] )." \t ".preg_replace('/\s+/', ' ',$ab[14] )." \t ".preg_replace('/\s+/', ' ',$ab[15],$ab[16],$ab[17] );
*/
/*$result="update esurvsites3 set SN='".$ab[1]."',Customer='".$ab[2]."',Bank='".$ab[3]."',ATM_ID='".$ab[4]."',ATM_ID2='".$ab[5]."',ATM_ID3='".$ab[6]."',ATM_ID4='".$ab[7]."',ATMShortName='".$ab[8]."',SiteAddress='".$ab[9]."',City='".$ab[10]."',State='".$ab[11]."',DVRIP='".$ab[12]."',Network='".$ab[13]."',DVRName='".$ab[14]."',DVRPort='".$ab[15]."',UserName='".$ab[16]."',Password='".$ab[17]."',CSSBM='".$ab[18]."',CSSBMNumber='".$ab[19]."',EMail_ID='".$ab[20]."',BackofficerName='".$ab[21]."',BackofficerNumber='".$ab[22]."',HeadSupervisorName='".$ab[23]."',HeadSupervisorNumber='".$ab[24]."',SupervisorName='".$ab[25]."',Supervisornumber='".$ab[26]."',Policestation='".$ab[27]."',Polstnname='".$ab[28]."' where  ATM_ID='".$ab[4]."'";
    $runresult=mysqli_query($conn,$result);*/
	}
	
	else
	{

    $qry1="INSERT INTO enventory_Stock(srno,Status,date,InventoryIN,material) VALUES('".$ab[1]."','Active','".$date."','".$last."','".$mate."')";
    $runquer1=mysqli_query($conn,$qry1);
    
    $qry2="INSERT INTO enventory_Transfer_log(srno,Status,date,InventoryIN,material,Vendor,qty,Model) VALUES('".$ab[1]."','Active','".$date."','".$last."','".$mate."','".$fetvan[0]."','".$qty1."','".$femol[0]."')";
                         $runquer2=mysqli_query($conn,$qry2);
    //echo  $qry1;                   
		 if(!$runquer1)
		 echo "failed".mysql_error();
	



}//end x ka for loop
//end sales site

//header('location:newsite.php');
}
//}
 }//print $contents;

if(count($err)>0)
{
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=rejectedsites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  //echo "<br>";
echo "<script type='text/javascript'>window.location='dashboard1.php';</script>";

}
else
{
?>
<script type="text/javascript">
alert("Data uploaded successfully");
window.location='dashboard1.php';
</script>
<?php
}
///print_r($data);
////print_r($data->formatRecords);
?>