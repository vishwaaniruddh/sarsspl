<?php
session_start();
if(!isset($_SESSION['user'])){
?>
<script type="text/javascript">
alert("Sorry, Your Session Has been Expired");
window.location="index.php";
</script>
<?php
}
else
{
include("config.php");
$status=0;
//$sr=mysqli_query($con,"select username from login where srno='".$_SESSION['user']."'");
//$srn=mysqli_fetch_row($sr);
if(isset($_POST['cmdsub']))
{

$errors2=0;
$photo_name2=$_POST['scancpy'];
//echo $_FILES['email_cpy']['name'];
//echo $_FILES['hoverfrm']['name'];
define ("MAX_SIZE","3000");
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

if(isset($_FILES['scancpy']['name']) && $_FILES['scancpy']['name']!='')
{
 $photo2=$_FILES['scancpy']['name']; 
//$old=$_POST['old'];
//define ("MAX_SIZE","3000");
 
 
 //This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.

//checks if the form has been submitted
 $time2 = time();
 	//reads the name of the file the user submitted for uploading
 	

 	//if it is not empty
	//echo count($image1);
 	if (!$photo2=="") 
 	{
	//echo "hi";
 	//get the original name of the file from the clients machine
 		$filename2 = stripslashes($photo2); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension2 = getExtension($filename2);
 		 $extension2 = strtolower($extension2);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension2 != "jpg") && ($extension2 != "png") && ($extension2 != "bmp")) 
 		{
		//print error message
 		$str= '<h1>Unknown extension!</h1>';
 			$errors2=1;
 		}
 		else
 		{

//we will give an unique name, for example the time in unix time format
 $photo_name2=($time2+1).'.'.$extension2; //echo $image_name[$j];
$handover=$photo_name2;
$time2=$time2+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname2="ebills/".$photo_name2;
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied2 = copy($_FILES['scancpy']['tmp_name'],$newname2);

if (!$copied2) 
{
 $str= '<h1>Copy unsuccessfull!</h1>';
	$errors2=1;
}}
//echo $newname;


}
}

if($errors2==0){
$errors=0;
$image_name='';
$maxsize='2140';
//$_FILES['email_cpy']['name'];
$size=($_FILES['email_cpy']['size']/1024);

if($_FILES['email_cpy']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['email_cpy']['name']; 

//echo $fichier;
 function getExtension1($str)
 {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
 }
	
	//echo $fichier;
if($fichier){
//echo "hi" ;
$filename = stripslashes($_FILES['email_cpy']['name']);
//echo $filename;
			//get the extension of the file in a lower case format
				$extension = getExtension1($filename);
				$extension = strtolower($extension);
				//echo $extension;
				$image_name=time().'.'.$extension;
				//echo $image_name;
$newname="ebemailcpy/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['email_cpy']['tmp_name'], $newname);


if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}

//echo $newname;

}
}
//echo $errors;
if($errors==0)
{
	//echo "hi";
	/*if($_POST['cust']=='FSS04' && $_POST['bank']=='ICICI' && $_POST['amount']>'10000')
		$stat='w';
		elseif($_POST['cust']=='FSS04' && $_POST['bank']!='ICICI' && $_POST['amount']>'8000')
		$stat='w';
		else*/
		$stat='n';
	$sv=$_POST['sv'];
	$srno=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$sr=mysqli_fetch_row($srno);
	$frmdt=str_replace('/','-',$_POST['fromdt']);
	$billdt=str_replace('/','-',$_POST['bill_date']);
	$todt=str_replace('/','-',$_POST['todt']);
	$duedt=str_replace('/','-',$_POST['duedt']);
	$paiddt=str_replace('/','-',$_POST['paiddt']);

        $weblink=$_POST['weblink'];
        $username=$_POST['username'];
        $password=$_POST['password'];
	
	$frmdt2=date('Y-m-d',strtotime($frmdt));
	//echo $frmdt2."<br>";
	$billdt2=date('Y-m-d',strtotime($billdt));// echo $billdt2."<br>";
	 $todt2=date('Y-m-d',strtotime($todt)); //echo $todt2."<br>";
	 $duedt2=date('Y-m-d',strtotime($duedt));// echo $duedt2."<br>";
	 $paiddt2=date('Y-m-d',strtotime($paiddt)); //echo $paiddt2."<br>";
		 if($frmdt2>=$todt2 || $todt2>$billdt2 || $billdt2>$duedt2)
		 {
		 $status="Invalid Dates";
		 }
		else
		 {
			$ebchk="select * from ebillfundrequests where reqstatus<>'0' and (atmid='".$_POST['atmid']."' or trackerid='".$_POST['trackid']."') and (due_date like '".$duedt2."%' OR start_date like '".$frmdt2."%' or end_date like '".$todt2."%' or bill_date like '".$billdt2."%' ) and req_no not in(select alert_id from ebfundtranscanc )";
			//echo $ebchk;
			$get=mysqli_query($con,$ebchk);
			if(mysqli_num_rows($get)>0)
				$status= "1. It seems entry for this month is already made ";
			else
			{
			//echo "select * from ebillfundrequests where reqstatus<>'0'and req_no not in(select alert_id from ebfundtranscanc ) and (atmid='".$_POST['atmid']."' or trackerid='".$_POST['trackid']."') and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."')  )";
			$ebchk2=mysqli_query($con,"select * from ebillfundrequests where reqstatus<>'0'and req_no not in(select alert_id from ebfundtranscanc ) and (atmid='".$_POST['atmid']."' or trackerid='".$_POST['trackid']."') and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."')  )");
			//echo "select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$_POST['cust']."' and atmid='".$_POST['atmid']."' and trackerid='".$_POST['trackid']."' and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."'))";
			//$x=mysqli_num_rows($ebchk2);
			//echo $x."<br>";
				if(mysqli_num_rows($ebchk2)>0)
				{
				$status="2. It seems entry for this month is already made.";
				}
				else
				{
					$sta='4';
					$dt=date('Y-m-d H:i:s');
					$arrears=0;
					$amt=0;
					$qry2=mysqli_query($con,"select max(req_no),approvedamt,start_date,end_date from ebillfundrequests where atmid='".$_POST['atmid']."' and reqstatus<>0 and start_date<>'0000-00-00' and end_date<>'0000-00-00' ");
					if(mysqli_num_rows($qry2)>0)
					{
					$qrro2=mysqli_fetch_row($qry2);
					
					 $date1 = $qrro2[2];
					//echo "<br>";
					 $date2 = $qrro2[3];
					//echo "<br>";
					$diff = abs(strtotime($date2) - strtotime($date1));
					
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
					//echo $days;
					//printf("%d years, %d months, %d days\n", $years, $months, $days);
					
					
					 $amt=(($qrro2[1]/$days)*30);
					$amt22=$amt+0.30*$amt;
					//echo "average amt ".$amt." req amt ".$_POST['amount']." more 30% ".($amt+0.30*$amt);
					if($amt22>0 && $_POST['amount']>(round($amt22)))
					$arrears='1';
					
					}
					
					//echo $_POST['amount']." ".($amt+0.30*$amt);
					
					if($_SESSION['designation']=='11' || $_SESSION['designation']=='9')
					$sta='2';
					//echo "INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`arrearstatus`,`billfrom`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) VALUES (NULL, '".strtoupper($_POST['atmid'])."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$sv."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$sr[0]."', '".$_POST['trackid']."','".$sta."','".$_POST['memo']."','".$stat."','".$_POST['cases']."','".$arrears."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."')";
					$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`arrearstatus`,`billfrom`,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) VALUES (NULL, '".strtoupper($_POST['atmid'])."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$sv."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$sr[0]."', '".$_POST['trackid']."','".$sta."','".$_POST['memo']."','".$stat."','".$_POST['cases']."','".$arrears."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."')");
					$id=mysqli_insert_id();
					$d=explode("/",$_POST['duedt']);
					if($_POST['trackid']!='')
					$upd=mysqli_query($con,"update ".$_POST['cust']."_ebill set Due_Date='".$d[0]."' where atmtrackid='".$_POST['trackid']."'");
					if(!$qry)
					echo mysqli_error();
					
					if($_FILES['scancpy']['name']!='')
					$scan=mysqli_query($con,"INSERT INTO `ebillscancpy` (`reqid`, `copy`, `status`) VALUES ('".$id."', '".$photo_name2."', '0')");
					if($_FILES['email_cpy']['name']!='')
					$scan=mysqli_query($con,"INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$id."', '".$image_name."', '0')");
					//$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`) VALUES ('".$id."', '".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'))");

                                  $XYZ=mysqli_query($con,"select ID from EBILL_WEBLINKS WHERE TRACKER_ID='".$_POST['trackid']."'");
                             echo mysqli_num_rows($XYZ)."***";
                                  if(mysqli_num_rows($XYZ)>0)
                                   {
                             mysqli_query($con,"update EBILL_WEBLINKS set WEBLINK='".$weblink."',USERNAME='".$username."',PASSWORD='".$password."' WHERE TRACKER_ID='".$_POST['trackid']."'");
                                   }
                                  else
                                  {
                           mysqli_query($con,"insert into EBILL_WEBLINKS(TRACKER_ID,WEBLINK,USERNAME,PASSWORD) values ('".$_POST['trackid']."','".$weblink."','".$username."','".$password."')");
                
                                  }
					if($qry)
					$status='Entry made Successfully and your Docket number is '.$id;
					else
					$status="Failed to make Entry";
				}
			
			}
		}
}//end of $errors if
}//end of $errors2 if
}
else{ echo "submit error"; }
$_SESSION['success']=$status;
echo "<script type='text/javascript'>alert('".$_SESSION['success']."');window.location='ebillonlinerequest.php';</script>";
//header('location:ebillfundrequest.php');
}
?>