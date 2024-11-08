<?php

ini_set( "display_errors", 0);

$custid=$_POST['cust'];

$project=$_POST['project'];



//echo $care." ".$house." ".$maintain." ".$ebill;
// Test CVS
//$ass=$_POST['ass'];
//$ass2=$_POST['ass1'];
//$spec=$_POST['spec'];
//$valid=$_POST['valid'];
include("config.php");
$cust=mysqli_query($con,"select cust_name from sites where cust_id='".$custid."' limit 1");
$custro=mysqli_fetch_row($cust);
//$astcnt=mysqli_query($con,"select * from assets");
//$astnum= mysqli_num_rows($astcnt);

$err=array();

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
$rep=array();
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
	//echo $ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11].",".$ab[12].",".$ab[13]."<br>";
	
	if( $ab[16]=='')
	{
	$err[]=$x;
	$rep[]="field is empty";
	}
	else
	{

	 if($ab[5]=='' || $ab[7]=='' || $ab[9]=='' )
	 {
	 $err[]=$x;
	$rep[]="This row has been tampered";
	 }
	 else
	 {
	 if($ab[5]=='Y')
	 $house=$ab[6];
	 else
	 $house=0;
	 
	 if($ab[7]=='Y')
	 $care=$ab[8];
	 else
	 $care=0;
	 
	 if($ab[9]=='Y')
	 $maintain=$ab[10];
	 else
	 $maintain=0;
//echo "update newtempsites set housekeeping_rate='".$house."',caretaker_rate='".$care."',maintenance_rate='".$maintain."',active='3' where atm_id1='".$ab[16]."' and active='2'";
$query=mysqli_query($con,"update newtempsites set housekeeping_rate='".$house."',caretaker_rate='".$care."',maintenance_rate='".$maintain."',active='3' where atm_id1='".$ab[16]."' and active='2'");

if($query)
{
$up=mysqli_query($con,"update newtempsites set active='3' where atm_id1='".$ab[11]."'");
}
else
{
$err[]=$x;
$rep[]="Some Error Occurred.".mysqli_error();	
}
	
	}//end of else ka loop
	}//end of else ka loop
	
	

}//end x ka for loop


//header('location:newsite.php');

}

unlink($newname);
if(count($err)>0)
{
echo "<div align='center'> a<h2>Total ".count($err)." Atm IDs has failed to upload due to following Errors </h2><br>";
echo "<a href='importebill.php'>Click here to go back</a><br>";
echo "Please Correct Below rows Data and upload again<br></div>";
?>
<table><tr><td>Row Number</td><td>Errors to be checked again</td></tr>
<?php
for($a=0;$a<count($err);$a++)
{
?>
<tr><td><?php echo $err[$a]; ?></td><td><?php echo $rep[$a]; ?></td></tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<script type="text/javascript">
alert("Data uploaded successfully");
window.location='level1approve.php';
</script>
<?php
}
///print_r($data);
////print_r($data->formatRecords);
?>