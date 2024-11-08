<?php
include('access.php');
//echo $_SESSION['user'];

?>
<html>

<head><title>Process Temporary site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function viewdetails(url,winname)
{
//alert(url);
//alert("hi");
  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=1000,height=600,left=350,top=200");
  
 }
 </script>
 <script type="text/javascript">
function insertsite(fail)
{
  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		
		 var cid=document.getElementById('cid'+fail).value;//alert(cid);
		 var cname=document.getElementById('cname'+fail).value;//alert(cid);
		 var project=document.getElementById('project'+fail).value;//alert(cid);
		 var ct=document.getElementById('ct'+fail).value;//alert(cid);
		 var hk=document.getElementById('hk'+fail).value;//alert(cid);
		 var mt=document.getElementById('mt'+fail).value;//alert(cid);
		 var eb=document.getElementById('eb'+fail).value;//alert(cid);
		 var local=document.getElementById('local'+fail).value;//alert(cid);
		 var site=document.getElementById('site'+fail).value;//alert(cid);
		 var sitetp=document.getElementById('sitetp'+fail).value;//alert(cid);
		 var atm=document.getElementById('atm'+fail).value;
		 var bank=document.getElementById('bank'+fail).value;//alert(bank);
		var add=document.getElementById('add'+fail).value;//alert(cid);
		var state=document.getElementById('state'+fail).value;//alert(cid);
		var reg=document.getElementById('reg'+fail).value;//alert(cid);
		var city=document.getElementById('city'+fail).value;//alert(cid);
		var loc=document.getElementById('loc'+fail).value;//alert(cid);
		var zone=document.getElementById('zone'+fail).value;//alert(cid);
		var supname=document.getElementById('sup'+fail).value;//alert(cid);
		var supno=document.getElementById('supno'+fail).value;//alert(cid);
		var tkdt=document.getElementById('tkdt'+fail).value;//alert(cid);	  
		var rem=document.getElementById('rem'+fail).value;//alert(cid);	
		var trackid=document.getElementById('track'+fail).value;//alert(cid);		 
			
			
			var url = 'inserttempsite.php'; 
	
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			
				 pmeters = 'cid='+cid+'&cname='+cname+'&project='+project+'&ct='+ct+'&hk='+hk+'&mt='+mt+'&eb='+eb+'&local='+local+'&site='+site+'&sitetp='+sitetp+'&atm='+atm+'&bank='+bank+'&add='+add+'&state='+state+'&reg='+reg+'&city='+city+'&loc='+loc+'&zone='+zone+'&sup='+supname+'&supno='+supno+'&tkdt='+tkdt+'&rem='+rem+'&track='+trackid;
			
			alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
alert(response);
if(response=='1')
{
document.getElementById('succ'+fail).innerHTML='Inserted Successfully';
}
else
alert(response);
				  //document.getElementById("search").innerHTML = response;
			  }
		}
}
</script>
</head><body>

<?php
 include("menubar.php");

ini_set( "display_errors", 0);
//include('temp.php');
	$dt='0000-00-00';
$custid=$_POST['cust'];
date_default_timezone_set('Asia/Kolkata');
$project=$_POST['project'];
$stat=0;
$bank=array();
$local=array();
$state=array();
$location=array();
$zone=array();

//echo $care." ".$house." ".$maintain." ".$ebill;
// Test CVS
//$ass=$_POST['ass'];
//$ass2=$_POST['ass1'];
//$spec=$_POST['spec'];
//$valid=$_POST['valid'];
include("config.php");
$cust=mysqli_query($con,"select contact_first from contacts where short_name='".$custid."' and type='c' limit 1");
$custro=mysqli_fetch_row($cust);

//$astcnt=mysqli_query($con,"select * from assets");
//$astnum= mysqli_num_rows($astcnt);
$fail=0;
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

echo $fichier;
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
echo $newname;

$data->read($newname);


error_reporting(E_ALL ^ E_NOTICE);
$ab=array();


for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
echo $x." <br>";

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	echo $ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11].",".$ab[12].",".$ab[13]."<br>";
//echo "<br>field".$ab[18]."<br>";


//$var=$ab[18];

	
$dat=trim($ab[18]);
$UNIX_DATE = ($dat - 25569) * 86400;
	//echo "<br>".$ab[18];
	if($UNIX_DATE>0){
 $dt=gmdate("d/m/Y",$UNIX_DATE);
 //echo $UNIX_DATE.">>><<<".$dat." *** *** ".$dt."<br>";
}
    else
    {
    $dt="00/00/0000";
  // echo $dt."<br>";
    }
/*if($dt=='01/01/1970')
{
 $dt=date('d/m/Y',strtotime(str_replace('/','-',$ab[18])));
 
 }*/
	if($ab[1]=='' ||$ab[2]=='' ||$ab[3]=='' ||$ab[4]=='' || $ab[5]=='' || $ab[6]=='' || $ab[11]=='' || $ab[12]=='' || $ab[13]=='' || $ab[14]=='' || $ab[15]=='')
	{
	$err[]=$x;
	$rep[]="fields is empty";
	}
	else
	{
	if($stat==0)
	echo "<h2 align='center'>Following Sites Match found</h2>";
	
	$stat='1';
	$qr="select trackerid from ".$custid."_sites where (bank='".$ab[5]."' and csslocalbranch='".$ab[6]."' and location='".$ab[14]."') or (bank='".$ab[5]."' and csslocalbranch='".$ab[6]."' and atmsite_address like '%".$ab[10]."%')";
	if($ab[7]!='')
	$qr.="  or atm_id1='".$ab[7]."'";
	
	//echo $qr."<br>";
	$qrr=mysqli_query($con,$qr);
	if(mysqli_num_rows($qrr)>0)
	{
	?>
    
  <div id="succ<?php echo $fail; ?>"  <table><tr><td><?php //echo $dt." ".$ab[18];
 // $dt=str_replace('/','-',$ab[18]);
   ?>
    <input type="hidden" name="cid<?php echo $fail; ?>" id="cid<?php echo $fail; ?>" value="<?php echo $custid; ?>" />
    <input type="hidden" name="cname<?php echo $fail; ?>" id="cname<?php echo $fail; ?>" value="<?php echo $custro[0]; ?>" />
    <input type="hidden" name="project<?php echo $fail; ?>" id="project<?php echo $fail; ?>" value="<?php echo $project; ?>" />
     <input type="hidden" name="ct<?php echo $fail; ?>" id="ct<?php echo $fail; ?>" value="<?php echo $ab[1]; ?>" />
     <input type="hidden" name="hk<?php echo $fail; ?>" id="hk<?php echo $fail; ?>" value="<?php echo $ab[2]; ?>" />
     <input type="hidden" name="mt<?php echo $fail; ?>" id="mt<?php echo $fail; ?>" value="<?php echo $ab[3]; ?>" />
     <input type="hidden" name="eb<?php echo $fail; ?>" id="eb<?php echo $fail; ?>" value="<?php echo $ab[4]; ?>" />
     <input type="text" name="bank<?php echo $fail; ?>" id="bank<?php echo $fail; ?>" value="<?php echo $ab[5]; ?>" readonly="readonly" />
     <input type="text" name="local<?php echo $fail; ?>" id="local<?php echo $fail; ?>" value="<?php echo $ab[6]; ?>" readonly="readonly" />
     <input type="text" name="atm<?php echo $fail; ?>" id="atm<?php echo $fail; ?>" value="<?php echo $ab[7]; ?>" readonly="readonly" />
     <input type="text" name="site<?php echo $fail; ?>" id="site<?php echo $fail; ?>" value="<?php echo $ab[8]; ?>" readonly="readonly" />
     <input type="hidden" name="sitetp<?php echo $fail; ?>" id="sitetp<?php echo $fail; ?>" value="<?php echo $ab[9]; ?>" />
     <input type="text" name="add<?php echo $fail; ?>" id="add<?php echo $fail; ?>" value="<?php echo $ab[10]; ?>" readonly="readonly" />
     <input type="text" name="state<?php echo $fail; ?>" id="state<?php echo $fail; ?>" value="<?php echo $ab[11]; ?>" readonly="readonly" />
     <input type="text" name="reg<?php echo $fail; ?>" id="reg<?php echo $fail; ?>" value="<?php echo $ab[12]; ?>" readonly="readonly" />
     <input type="text" name="city<?php echo $fail; ?>" id="city<?php echo $fail; ?>" value="<?php echo $ab[13]; ?>" readonly="readonly" />
     <input type="text" name="loc<?php echo $fail; ?>" id="loc<?php echo $fail; ?>" value="<?php echo $ab[14]; ?>" readonly="readonly" />
     <input type="text" name="zone<?php echo $fail; ?>" id="zone<?php echo $fail; ?>" value="<?php echo $ab[15]; ?>" readonly="readonly" />
     <input type="hidden" name="sup<?php echo $fail; ?>" id="sup<?php echo $fail; ?>" value="<?php echo $ab[16]; ?>" />
     <input type="hidden" name="supno<?php echo $fail; ?>" id="supno<?php echo $fail; ?>" value="<?php echo $ab[17]; ?>" />
     <input type="text" name="tkdt<?php echo $fail; ?>" id="tkdt<?php echo $fail; ?>" value="<?php echo $dt; ?>" onClick="displayDatePicker('tkdt<?php echo $fail; ?>');" />
     <input type="hidden" name="rem<?php echo $fail; ?>" id="rem<?php echo $fail; ?>" value="<?php echo $ab[19]; ?>" />
     <input type="text" name="track<?php echo $fail; ?>" id="track<?php echo $fail; ?>" value="" placeholder="Link with trackerid" />
    </td>
    <td><input type="button" value="Insert" onClick="insertsite('<?php echo $fail; ?>')" /></td>
    <?php
    
	$ext='';
	$exist=array();
	while($rqr=mysqli_fetch_array($qrr))
	{
	
	 $exist[]=$rqr[0];
	
	}
	$ext2=implode(',',$exist);
	$ext=str_replace(",","','",$ext);
	$ext="'".$ext."'";
	?>
    <td><?php //echo $ext;  ?><input type="button" onClick="viewdetails('viewsiteexist.php?id=<?php echo $ext2; ?>&cid=<?php echo $custid; ?>','Sites');" value="View Details" /></td>
    </tr></table></div><br /><hr>
    <?php
	$fail=$fail+1;
	
	
	}
	else
	{
	//echo $ab[22];
	/*if($ab[22]!='')
  $fromdt=str_replace("/","-",$ab[22]);
 else
   $fromdt='';
	//echo $dt." ";
	if($ab[18]!='')
	 $fromdt=date('Y-m-d', strtotime($fromdt));
	 else
	 $fromdt='0000-00-00';*/
	 
	// echo $fromdt;
// Excel sheet format	
//	1AC Manager	2AC Manager Number	3Caretaker	4Housekeeping	5Maintainence	6Ebill	7Bank	8csslocalbranch	9ATM_Id1	10ATM_Id2	11ATM_Id3	12Site_Id	13Site type	14Site Address
		//15State	16City	17Zone	18CSSLocalBranchManagerName	19CSSLocalBranchManagerNumber	20CSSLocalSupervisorName	21CSSLocalSupervisorNumber	22Takeover_date	23Remarks

	
	$care=strtoupper($ab[1]);
	$hk=strtoupper($ab[2]);
	$main=strtoupper($ab[3]);
	$ebill=strtoupper($ab[4]);
	//echo $ab[22];
	
	//echo "INSERT INTO `newtempsites` (`id`, `cust_id`, `cust_name`,`housekeeping`, `caretaker`, `maintenance`, `ebill`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `cust_remarks`, `active`, `project`,`upby`) VALUES (NULL, '".$custid."', '".$custro[0]."', '".$hk."', '".$care."', '".$main."', '".$ebill."', '".$ab[5]."','".$ab[6]."', '".$ab[15]."', '".$ab[11]."', '".$ab[12]."', '".$ab[8]."','".$ab[7]."','".$ab[13]."', '".$ab[13]."','".$ab[10]."','".$ab[9]."',NULL,STR_TO_DATE('".$dt."','%d/%m/%Y'), '0000-00-00', '".$ab[16]."', '".$ab[17]."','".$ab[19]."', '0', '".$project."','".$_SESSION['user']."')";
	
	$query=mysqli_query($con,"INSERT INTO `newtempsites` (`id`, `cust_id`, `cust_name`,`housekeeping`, `caretaker`, `maintenance`, `ebill`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `cust_remarks`, `active`, `project`,`upby`) VALUES (NULL, '".$custid."', '".$custro[0]."', '".$hk."', '".$care."', '".$main."', '".$ebill."', '".$ab[5]."','".$ab[6]."', '".$ab[15]."', '".$ab[11]."', '".$ab[12]."', '".$ab[8]."','".$ab[7]."','".$ab[13]."', '".$ab[13]."','".$ab[10]."','".$ab[9]."',NULL,STR_TO_DATE('".$dt."','%d/%m/%Y'), '0000-00-00', '".$ab[16]."', '".$ab[17]."','".$ab[19]."', '0', '".$project."','".$_SESSION['user']."')");
	
	
if($query)
{

}
else
{
$err[]=$x;
$rep[]="Some Error Occurred.".mysqli_error();	
}
	}
	
	}//end of else ka loop
	
	

}//end x ka for loop


//header('location:newsite.php');

}
if(count($err)>0)
{
echo "<div align='center'> a<h2>Total ".count($err)." Atm IDs has failed to upload due to Invalid date Format or This particular Site has already been Entered </h2><br>";
echo "<a href='newsite.php'>Click here to go back</a><br>";
echo "Please Correct Below rows Data and upload again<br></div>";
?>
<table border="1" align="center"><tr><td>Row Number</td><td>Errors to be checked again</td></tr>
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
if($fail==0){
?>
<script type="text/javascript">
//alert("Data uploaded successfully");
//window.location='newsite.php';
</script>
<?php
}
}
///print_r($data);
////print_r($data->formatRecords);
?>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body></html>