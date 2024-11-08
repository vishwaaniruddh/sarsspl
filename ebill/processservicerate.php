<?php

ini_set( "display_errors", 0);

$custid=$_POST['cust'];

$project=$_POST['project'];


include("config.php");

//$astcnt=mysqli_query($con,"select * from assets");
//$astnum= mysqli_num_rows($astcnt);

$err=array();
//echo "file size=".$_FILES['userfile']['size'];
$counter=0;

$maxsize='1000';
$rep=array();
$size=($_FILES['userfile']['size']/1024);

 
//echo $size." *** ".$maxsize;
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
	//echo $newname;	
	
$copied = copy($_FILES['userfile']['tmp_name'], $newname);


if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;
//echo $newname;

//$data->read($newname);




//database connection details


// path where your CSV file is located
define('CSV_PATH',$newname);

// Name of your CSV file
 $csv_file = CSV_PATH; 


if (($getfile = fopen($csv_file, "r")) !== FALSE) {
         $data = fgetcsv($getfile, 1000, ",");
    while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
       $num = count($data);
	   $ab=array();
        for ($c=0; $c < $num; $c++) {
            $result = $data;
        	$str = implode("##,****,##", $result);
        	//$slice = explode(",", $str);
        $ab = explode("##,****,##", $str);
			/*$col1 = $slice[0];
            $col2 = $slice[1];
            $col3 = $slice[2];*/
			}
		//echo $ab[0].",".$ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11].",".$ab[12].",".$ab[13]."<br>";	
			if( $ab[10]=='' )
	{
	$err[]=$x;
	$rep[]="Tracker ID Has been modified";
	}
	else
	{
//echo $ab[4]." ".$ab[5]." ".$ab[6]." ".$ab[7]." ".$ab[8]." ".$ab[9];
	 if($ab[4]=='' || $ab[6]=='' || $ab[8]=='' )
	 {
	 $err[]=$x;
	$rep[]="This row has been tampered";
	 }
	 else
	 {
	 if($ab[4]=='Y')
	 $house=$ab[5];
	 else
	 $house=0;
	 
	 if($ab[6]=='Y')
	 $care=$ab[7];
	 else
	 $care=0;
	 
	 if($ab[8]=='Y')
	 $maintain=$ab[9];
	 else
	 $maintain=0;
	 
	 //echo "update newtempsites set housekeeping_rate='".$house."',caretaker_rate='".$care."',maintenance_rate='".$maintain."',active='3' where id='".$ab[10]."'";
//echo "update newtempsites set housekeeping_rate='".$house."',caretaker_rate='".$care."',maintenance_rate='".$maintain."',active='3' where id='".$ab[10]."'<br>";
$query=mysqli_query($con,"update newtempsites set housekeeping='".$ab[4]."',housekeeping_rate='".$house."',caretaker='".$ab[6]."',caretaker_rate='".$care."',maintenance='".$ab[8]."',maintenance_rate='".$maintain."',active='3',city_category='".$ab[28]."',subcat='".$ab[34]."' where id='".$ab[10]."'");

if($query)
{

}
else
{
$err[]=$x;
$rep[]="Some Error Occurred.".mysqli_error();	
}
	
	}//end of else ka loop
}//end of else ka loop
	
			// SQL Query to insert data into DataBase
			/*$query = "INSERT INTO csvtbl(ID,name,city)
VALUES('".$col1."','".$col2."','".$col3."')";
$s=mysqli_query($con,$query, $connect );*/
			
        
    }
}
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
}
?>
