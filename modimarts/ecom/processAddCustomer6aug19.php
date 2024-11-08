<?php
include('config.php');
?>

<html>
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
 <?php

if (!is_dir("logos/")) {
    @mkdir("logos/");
}
$Latitude="";
$Longitude="";

 //cname state city area add2 contact2 fax email contactPerson  mobile compny logo rdate yoe adhar pan vat
           // Ldesignation   Registn cin gumastaNo busiAadhar comnyPan tanno Establishment

if(isset($_POST["caploc"]))
{
$Latitude=mysqli_real_escape_string($_POST['Latitude']);
$Longitude=mysqli_real_escape_string($_POST['Longitude']);
}

//echo $Latitude;
$adhar=mysqli_real_escape_string($_POST['adhar']);
$pan=mysqli_real_escape_string($_POST['pan']);
$Establishment=mysqli_real_escape_string($_POST['Establishment']);

$cname=mysqli_real_escape_string($_POST['cname']);

$Ldesignation=mysqli_real_escape_string($_POST['Ldesignation']);
$Registn=mysqli_real_escape_string($_POST['Registn']);
$cin=mysqli_real_escape_string($_POST['cin']);
$gumastaNo=mysqli_real_escape_string($_POST['gumastaNo']);
$busiAadhar=mysqli_real_escape_string($_POST['busiAadhar']);
$comnyPan=mysqli_real_escape_string($_POST['comnyPan']);
$tanno=mysqli_real_escape_string($_POST['tanno']);
$Establishment=mysqli_real_escape_string($_POST['Establishment']);

//=========== bank details  ======
$bknm=mysqli_real_escape_string($_POST['bknm']);
$ifscode=mysqli_real_escape_string($_POST['ifscode']);
$actno=mysqli_real_escape_string($_POST['actno']);
$acholnm=mysqli_real_escape_string($_POST['acholnm']);
$brchnm=mysqli_real_escape_string($_POST['brchnm']);
// Ruchi 
$wing=mysqli_real_escape_string($_POST['wing']);
$flat=mysqli_real_escape_string($_POST['flat']);
$bldg=mysqli_real_escape_string($_POST['BuildingName']);
$road_no=mysqli_real_escape_string($_POST['RoadNo']);
$locality=mysqli_real_escape_string($_POST['Locality']);
$landmark=mysqli_real_escape_string($_POST['landMark']);
//============ =============================


$vat=mysqli_real_escape_string($_POST['vat']);

$state=mysqli_real_escape_string($_POST['state']);

$city=mysqli_real_escape_string($_POST['city']);

$area=mysqli_real_escape_string($_POST['area']);

$add2=mysqli_real_escape_string($_POST['add2']);

$Pincode=mysqli_real_escape_string($_POST['Pincode']);

$phone=mysqli_real_escape_string($_POST['phone']);

$fax=mysqli_real_escape_string($_POST['fax']);

$email=mysqli_real_escape_string($_POST['email']);

$contact=mysqli_real_escape_string($_POST['contactPerson']);
//echo $contact;
$mobile=mysqli_real_escape_string($_POST['mobile']);

$cat=$_POST['cat'];
//$catn=$_POST['catn'];
//echo $catn;
//$cat=implode(',',$cat1);

$ar =  explode(',', $cat);
$data =array();
foreach ($ar as $item) {
    $underName=$item;
  $under=  mysqli_query($con1,"SELECT name FROM `main_cat` WHERE id ='$underName' ");
  $underRow = mysqli_fetch_array($under);
  $data[]=$underRow[0];
}
$catn=implode(",",$data);


$companytyp=$_POST['ctyp'];

$emp=mysqli_real_escape_string($_POST['emp']);

$memtype=mysqli_real_escape_string($_POST['memtype']);

//$logo=$_POST['logo'];

$lic=mysqli_real_escape_string($_POST['lic']);

$fees=mysqli_real_escape_string($_POST['fees']);

$yoe=mysqli_real_escape_string($_POST['yoe']);

$app=mysqli_real_escape_string($_POST['app']);

$mop=mysqli_real_escape_string($_POST['mop']);
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
  $maintarget ="logos/".$target1;
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
   }       

          //echo $code." ".$cname."".$city."".$state."".$area."".$add2."".$cat."".$str."".$phone."".$fax."".$email."".$contact."".$mobile."".$emp."".$memtype."".$lic."".$fees."".$yoe."".$target;            

		
 //$target = $target . basename( $_FILES['logo']['name']) ; 

 $ok=1; 

 //if(move_uploaded_file($_FILES['logo']['tmp_name'], $target)) 

 //{

 //echo "The file ". basename( $_FILES['logo']['name']). " has been uploaded";

 //$ares=mysqli_query($con1,"select code from areas where name='".$area."'");
 
 //$arow=mysqli_fetch_row($ares);
$fdt=date("Y/m/d");

$stater=mysqli_query($con1,"select state_code from states where state_name='".$state."'");
 $staterows=mysqli_fetch_row($stater);
	
/*$qry="insert into clients(`name`,`city`,`state`,`area`,`address`,`pincode`,`cid`,`category`,`phone`,`fax`,`email`,`contact`,`mobile`,`noe`,`memtype`,`license`,`fees`,`yoe`,`logo`,`rdate`,`till_date`,Latitude,Longitude,vat, `adhar_no`, `pan_no`, `Establishment`,partnerpancatd,partnerName,partnerAadhar,companytyp,subscribe,designation,RegisterationNo,CIN,Gumasta,BusiAadharNo,CompanyPancard,Tanno,EstablishmentNo) 
values('$cname','$city','".mysqli_real_escape_string($staterows[0])."','$area','$add2','$Pincode','$cat','$catn','$phone','$fax','$email','$contact','$mobile','$emp','$memtype','$lic','$fees','$yoe','$target','$fdt','$tdate','$Latitude','$Longitude','$vat','$adhar','$pan','$Establishment','$pancardno','$Pnameno','$Aadharcardno','$companytyp','deactive','$Ldesignation','$Registn','$cin','$gumastaNo','$busiAadhar','$comnyPan','$tanno','$Establishment')";*/
 
 //Ruchi : 5 aug 19
 $qry="insert into clients(`name`,`city`,`state`,`pincode`,`cid`,`category`,`phone`,`fax`,`email`,`contact`,`mobile`,`noe`,`memtype`,`license`,`fees`,`yoe`,`logo`,`rdate`,`till_date`,Latitude,Longitude,vat, `adhar_no`, `pan_no`, `Establishment`,partnerpancatd,partnerName,partnerAadhar,companytyp,subscribe,designation,RegisterationNo,CIN,Gumasta,BusiAadharNo,CompanyPancard,Tanno,EstablishmentNo,wing,flat_no,bldg_name,locality,landmark,road_no) 
values('$cname','$city','".mysqli_real_escape_string($staterows[0])."','$Pincode','$cat','$catn','$phone','$fax','$email','$contact','$mobile','$emp','$memtype','$lic','$fees','$yoe','$target','$fdt','$tdate','$Latitude','$Longitude','$vat','$adhar','$pan','$Establishment','$pancardno','$Pnameno','$Aadharcardno','$companytyp','deactive','$Ldesignation','$Registn','$cin','$gumastaNo','$busiAadhar','$comnyPan','$tanno','$Establishment','$wing','$flat','$bldg','$locality','$landmark','$road_no')";
	$res=mysqli_query($con1,$qry);
	
	//echo $qry;
$code=$con1->insert_id;
			  
/*	$qselclint="select max(code) from clients";		  
	$result=mysqli_query($con1,$qselclint);	
	$row=mysqli_fetch_array($result);

			  */
	$qrybnk="insert into Bank_Details(Merchant_id,BankName,BranchName,IFScode,AccountNumber,AC_HoldersName)values('$code','$bknm','$brchnm','$ifscode','$actno','$acholnm')";	

	$resbnk=mysqli_query($con1,$qrybnk);

$ct=count($subcat);

for($i=0;$i<$ct;$i++)

    {  //echo $subcat[$i];

     mysqli_query($con1,"insert into client_cat values('".$code."','".$subcat[$i]."')");

    }

     mysqli_query($con1,"insert into accounts values('".$code."','".$app."','".$mop."','".$pay."')");

                if($res){
		 
echo '<script>swal("Data Saved")</script>';
  
//echo "Data Saved";


				} else
//echo "Data not Saved ";          
echo '<script>swal("Data not Saved")</script>';

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
$headers = "From: <mail@example.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message="Your User Name is ".$email."<br/> Your Password is : ".$string;
			
//$result = mail($email, $subject, $message, $headers);
mail($to, $subject, $message, $headers);
//echo $result;

           

 $insqr=mysqli_query($con1,"insert into users(`id`, `password`, `department`, `cid`) values('".$email."','".$string."','users','".$code."')");
//echo "insert into users(`id`, `password`, `department`, `cid`) values('".$email."','".$string."','users','".$code."')";
if(!$insqr)
{
    
    echo mysqli_error($con1);
}
//	$nwyr=date('Y');
//$nwdt=date('m');
$pth="userfiles/".$code."/img/";
//echo $pth;
if (!file_exists($pth)) {

//echo "doesnt exist";

   mkdir($pth, 0755, true);
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
				
				window.open('Sell.php?sts=<?php echo $sts;?>','_self');
</script>
</body>
</html>