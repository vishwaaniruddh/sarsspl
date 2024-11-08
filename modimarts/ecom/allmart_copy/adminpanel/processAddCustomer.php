<?php
session_start();

include('config.php');

if (!is_dir("../logos/")) {
    @mkdir("../logos/");
}
$Latitude="";
$Longitude="";


if(isset($_POST["caploc"]))
{
$Latitude=mysql_real_escape_string($_POST['Latitude']);
$Longitude=mysql_real_escape_string($_POST['Longitude']);
}

//echo $Latitude;
$adhar=mysql_real_escape_string($_POST['adhar']);
$pan=mysql_real_escape_string($_POST['pan']);
$Establishment=mysql_real_escape_string($_POST['Establishment']);

$cname=mysql_real_escape_string($_POST['cname']);
$vat=mysql_real_escape_string($_POST['vat']);

$Registn=mysql_real_escape_string($_POST['Registn']);
$cin=mysql_real_escape_string($_POST['cin']);
$gumastaNo=mysql_real_escape_string($_POST['gumastaNo']);
$busiAadhar=mysql_real_escape_string($_POST['busiAadhar']);
$comnyPan=mysql_real_escape_string($_POST['comnyPan']);
$tanno=mysql_real_escape_string($_POST['tanno']);





$state=mysql_real_escape_string($_POST['state']);

$city=mysql_real_escape_string($_POST['city']);

$area=mysql_real_escape_string($_POST['area']);

$add2=mysql_real_escape_string($_POST['add2']);

$phone=mysql_real_escape_string($_POST['phone']);

$fax=mysql_real_escape_string($_POST['fax']);

$email=mysql_real_escape_string($_POST['email']);

$contact=mysql_real_escape_string($_POST['contactPerson']);
//echo $contact;
$mobile=mysql_real_escape_string($_POST['mobile']);

$cat=$_POST['cat'];
$catn=$_POST['catn'];
//$cat=implode(',',$cat1);

$ar =  explode(',', $cat);
$data =array();
foreach ($ar as $item) {
    $underName=$item;
  $under=  mysql_query("SELECT name FROM `main_cat` WHERE id ='$underName' ");
  $underRow = mysql_fetch_array($under);
  $data[]=$underRow[0];
}
$catt=implode(",",$data);




$companytyp=$_POST['ctyp'];

$emp=mysql_real_escape_string($_POST['nomem']);

$memtype=mysql_real_escape_string($_POST['memtype']);

//$logo=$_POST['logo'];

$lic=mysql_real_escape_string($_POST['lic']);

$fees=mysql_real_escape_string($_POST['fees']);
$fdt=date("Y/m/d");
$yoe=mysql_real_escape_string($_POST['yoe']);

$app=mysql_real_escape_string($_POST['app']);

$mop=mysql_real_escape_string($_POST['mop']);

$pancard=$_POST['pancard'];
$Pname=$_POST['Pname'];
$Aadharcard=$_POST['Aadharcard'];

if(count($pancard)>0)
{  
$pancardno=implode(',',$pancard);
}
if(count($Pname)>0)
{
  $Pnameno=implode(',',$Pname);
}
if(count($Aadharcard)>0)
{
  $Aadharcardno=implode(',',$Aadharcard);
 }




$rdate=$_POST['rdate'];

$xdate=str_replace("/","-",$rdate);

//$tdate=date('Y-m-d', strtotime($xdate. ' + 12 months'));
$tdate=date('Y-m-d', strtotime($xdate));


//echo $xdate."///".$tdate;
$str="";
//implode(',',$subcat);
//echo $str."-".count($subcat);

if($mop=="chq")

$pay=$_POST['pay'];

else

$pay="na";

//$rdate=$_POST['rdate'];
/*if($memtype==500){
	$ty="bronze";
	
}else if($memtype==1000)

{
	$ty="sliver";
}else if($memtype==1500)

{
	$ty="glod";
}else if($memtype==3000){
	$ty="platinum";
	
}else
{
	$ty="free";
}*/


$target='';

         if(basename( $_FILES['logo']['name']) ) 
{//echo "image";
$frext=$_FILES['logo']['name'];
$ext2=explode(".", $frext);//gets extension

$ext=strtolower(end($ext2));
//echo "hi".$ext;

$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "GIF", "PJPEG", "PNG", "bmp","BMP");

if ((($_FILES["logo"]["type"] == "image/gif")
|| ($_FILES["logo"]["type"] == "image/jpeg")
|| ($_FILES["logo"]["type"] == "image/png")
|| ($_FILES["logo"]["type"] == "image/pjpeg")
|| ($_FILES["logo"]["type"] == "image/JPG")
|| ($_FILES["logo"]["type"] == "image/GIF")
|| ($_FILES["logo"]["type"] == "image/JPEG")
|| ($_FILES["logo"]["type"] == "image/PNG")
|| ($_FILES["logo"]["type"] == "image/bmp")
|| ($_FILES["logo"]["type"] == "image/BMP"))
&& ($_FILES["logo"]["size"] < 60000000)
&& in_array($ext, $allowedExts))
  {
  if ($_FILES["logo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["logo"]["error"] . "<br />";
    }
	else
    {
	$target1 = time().".".$ext; 
	
 $target = "logos/".$target1;
  $maintarget = $mainpath."logos/".$target1;
// echo $dir2;
if(move_uploaded_file($_FILES['logo']['tmp_name'], $maintarget)) 
 {
 //echo "The file ". basename( $_FILES['logo']['name']). " has been uploaded";
 
          //  echo " ".$code."-".$cname."-".$state;            
			
}
else
echo "Failed to move file";
}
}


  // }
    
 


$ok=1; 
}
   

          //echo $code." ".$cname."".$city."".$state."".$area."".$add2."".$cat."".$str."".$phone."".$fax."".$email."".$contact."".$mobile."".$emp."".$memtype."".$lic."".$fees."".$yoe."".$target;            

		
 //$target = $target . basename( $_FILES['logo']['name']) ; 

// $ok=1; 
//}
 //if(move_uploaded_file($_FILES['logo']['tmp_name'], $target)) 

 //{

 //echo "The file ". basename( $_FILES['logo']['name']). " has been uploaded";

 //$ares=mysql_query("select code from areas where name='".$area."'");
 
 //$arow=mysql_fetch_row($ares);

$bknm=mysql_real_escape_string($_POST['bknm']);
$brchnm=mysql_real_escape_string($_POST['brchnm']);
$ifscode=mysql_real_escape_string($_POST['ifscode']);
$actno=mysql_real_escape_string($_POST['actno']);
$acholnm=mysql_real_escape_string($_POST['acholnm']);
$Ldesignation=mysql_real_escape_string($_POST['Ldesignation']);

$stater=mysql_query("select state_code from states where state_name='".$state."'");
 $staterows=mysql_fetch_row($stater);

$qry="insert into clients(`name`,`city`,`state`,`area`,`address`,`cid`,`category`,`phone`,`fax`,`email`,`contact`,`mobile`,`noe`,`memtype`,`license`,`fees`,`yoe`,`logo`,`rdate`,`till_date`,Latitude,Longitude,vat, `adhar_no`, `pan_no`, `Establishment`,partnerpancatd,partnerName,partnerAadhar,companytyp,subscribe,RegisterationNo,Gumasta,CIN,BusiAadharNo,CompanyPancard,Tanno,EstablishmentNo,designation) 
values('$cname','$city','".mysql_real_escape_string($staterows[0])."','$area','$add2','$cat','$catt','$phone','$fax','$email','$contact','$mobile','$emp','$memtype','$lic','$fees','$yoe','$target','$fdt','$tdate','$Latitude','$Longitude','$vat','$adhar','$pan','$Establishment','$pancardno','$Pnameno','$Aadharcardno','$companytyp','deactive','$Registn','$gumastaNo','$cin','$busiAadhar','$comnyPan','$tanno','$Establishment','$Ldesignation')";
			  $res=mysql_query($qry);
			  
$code=mysql_insert_id();

 $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add Merchant','".$curr_dt."','".$_SESSION['lastSubID']."','". $code." ','clients') ");
		



  
			  $qry12="insert into Bank_Details (Merchant_id,BankName,BranchName,IFScode,AccountNumber,AC_HoldersName)values('$code','$bknm','$brchnm','$ifscode','$actno','$acholnm')";
		//	echo $qry12;
			  $res12=mysql_query($qry12);


$ct=count($subcat);

for($i=0;$i<$ct;$i++)

    {  //echo $subcat[$i];

     mysql_query("insert into client_cat values('".$code."','".$subcat[$i]."')");

    }

     mysql_query("insert into accounts values('".$code."','".$app."','".$mop."','".$pay."')");

                        if($res)
                        {
                          echo "Data Saved";
	                    } else
                        echo "Data not Saved ";          

   ?>

			
  



<?php
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
  $string=random_string(6);
  
       $email = strip_tags($email);
//echo $email;
$to= $email;
$subject="Your login id and password Merabazar";
$headers = "From: <Registration@sarmicrosystems.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message="Your User Name is ".$email."<br/> Your Password is : ".$string;
			
//$result = mail($email, $subject, $message, $headers);
mail($to, $subject, $message, $headers);
//echo $result;

           

 $insqr=mysql_query("insert into users(`id`, `password`, `department`, `cid`) values('".$email."','".$string."','users','".$code."')");
//echo "insert into users(`id`, `password`, `department`, `cid`) values('".$email."','".$string."','users','".$code."')";
if(!$insqr)
{
    
    echo mysql_error();
}
//	$nwyr=date('Y');
//$nwdt=date('m');
$pth="userfiles/".$code."/img/";
//echo $pth;
if (!file_exists($pth)) {

//echo "doesnt exist";

   mkdir("../".$pth, 0755, true);
}

?>

<br/><br/>
<div id="message-yellow">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
				
				
				</tr>
				</table>
				</div>
				<?php if($qry && $insqr){ $sts="1";}else{$sts="2";}?>
				<script>
				
				window.open('Register.php?sts=<?php echo $sts;?>','_self');
</script>

