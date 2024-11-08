<?php 
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
//echo "<br>field".$ab[18]."<br>";


$var=$ab[18];
//$x=str_replace('/','-',$ab[18]);
//echo "<br>date ".date('Y-m-d',strtotime($x))."<br>";
//echo "<br>mumeric=".(is_numeric(01/01/1970))."<br>";
	/*if(date('Y',strtotime($x))>'2008' && date('Y',strtotime($x))<=date('Y') )
	{
	echo "hi";
	
	if (date('Y-m-d', strtotime($ab[18])) == $ab[18])
        $dt=date('d/m/Y', strtotime($data));
	elseif (date('d/m/Y', strtotime($x.' -1 day')) == $ab[18])
      $dt=date('d/m/Y', strtotime($x));
	  else
	  {}
	}
	else
	{*/
	$dat1=trim($ab[18]);
	//$dat = date(strtotime($dat1));
$UNIX_DATE = ($dat1 - 25569) * 86400;
	echo $dat1."xx".$UNIX_DATE."<>".$ab[18];
	if($UNIX_DATE>0){
 $dt=gmdate("d/m/Y",$UNIX_DATE);
 echo $UNIX_DATE.">>><<<".$dat1." *** *** ".$dt."<br>";}
    else
    {
    $dt="00/00/0000";
    echo $dt."<br>";
    }
//}
//echo str_replace('/','-',$dt);
//echo "<br>date=".(date('Y',strtotime($UNIX_DATE)))."<br>";
//echo date('Y',strtotime('+2 year'));
//if(date('Y',strtotime($dt))>date('Y',strtotime('+2 year')) ||  date('Y',strtotime($dt))<date('Y',strtotime('-2 year')))
//{
//echo $x=str_replace('/','-',$ab[18]);

 //$dt=date('d/m/Y',strtotime(str_replace('/','-',$ab[18])));
 //echo "***".$dt."<br>";
// if($dt=='01/01/1970')
 //$dt=date('d/m/Y',$UNIX_DATE);
//}
/*if($dt=='01/01/1970')
{
 $dt=date('d/m/Y',strtotime(str_replace('/','-',$ab[18])));
 
 }*/
}
}
?>