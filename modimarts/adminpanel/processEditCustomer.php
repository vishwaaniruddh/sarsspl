<?php
session_start();

include('config.php');

if (!is_dir("../logos/")) {
    @mkdir("../logos/");
}

$code=mysql_real_escape_string($_POST['code']);
$Latitude=mysql_real_escape_string($_POST['Latitude']);
$Longitude=mysql_real_escape_string($_POST['Longitude']);


$adhar=mysql_real_escape_string($_POST['adhar']);

$pan=mysql_real_escape_string($_POST['pan']);
$Establishment=mysql_real_escape_string($_POST['Establishment']);

$cname=mysql_real_escape_string($_POST['cname']);
$vat=mysql_real_escape_string($_POST['vat']);

$state=mysql_real_escape_string($_POST['state']);

$city=mysql_real_escape_string($_POST['city']);

$area=mysql_real_escape_string($_POST['area']);

$add2=mysql_real_escape_string($_POST['add2']);

$phone=mysql_real_escape_string($_POST['phone']);

$fax=mysql_real_escape_string($_POST['fax']);

$email=mysql_real_escape_string($_POST['email']);
//echo $email;
$contact=mysql_real_escape_string($_POST['contactPerson']);

$mobile=mysql_real_escape_string($_POST['mobile']);


$sub_cat=$_POST['companycat'];

//$cat=$_POST['cat'];

//echo $cat;

  //$Selected=implode(',',$cat); 

//$subcat=$_POST['subcat'];

$emp=mysql_real_escape_string($_POST['emp']);

$memtype=mysql_real_escape_string($_POST['memtype']);

$lic=mysql_real_escape_string($_POST['lic']);

$fees=mysql_real_escape_string($_POST['fees']);

$yoe=mysql_real_escape_string($_POST['yoe']);

$app=mysql_real_escape_string($_POST['app']);

$mop=mysql_real_escape_string($_POST['mop']);
//$mobile=mysql_real_escape_string($_POST['mobile']);
$oldlogo=$_POST['oldlogo'];
$rdate=$_POST['rdate'];

$xdate=str_replace("/","-",$rdate);

$tdate=date('Y-m-d', strtotime($xdate. ' + 12 months'));

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
//echo  $_FILES['logo']['name'];


$frexts=$_FILES['logo']['name'];
$ext2=explode(".", $frexts);//gets extension


$ext=strtolower(end($ext2));
//$ext2=end(explode(".", $_FILES["logo"]["name"]));//gets extension
//$ext=strtolower($ext2);
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
// echo "The file ". basename( $_FILES['logo']['name']). " has been uploaded";
 
          //  echo " ".$code."-".$cname."-".$state;            
			
}
else{
echo "Failed to move file";
}
}
}


   }    else{
       $target=$oldlogo;
       
   }        

          //echo $code." ".$cname."".$city."".$state."".$area."".$add2."".$cat."".$str."".$phone."".$fax."".$email."".$contact."".$mobile."".$emp."".$memtype."".$lic."".$fees."".$yoe."".$target;            

		
 //$target = $target . basename( $_FILES['logo']['name']) ; 

 $ok=1; 

 //if(move_uploaded_file($_FILES['logo']['tmp_name'], $target)) 

 //{

 //echo "The file ". basename( $_FILES['logo']['name']). " has been uploaded";

 //$ares=mysql_query("select code from areas where name='".$area."'");
 
 //$arow=mysql_fetch_row($ares);


$stater=mysql_query("select state_code from states  where state_name='".$state."'");
 $staterows=mysql_fetch_row($stater);


	$q="SELECT name FROM `main_cat` WHERE id IN($sub_cat)";
//	 echo "$q";
	 $r= mysql_query($q);
	 $data = array();
	  while($row = mysql_fetch_array($r))
	  {  
	       $data[]=$row[0];
	    }
	   $cat= implode(",",$data);
	  


//$qry="update clients set name='$cname',city='$city',state='".mysql_real_escape_string($staterows[0])."',area='$area',address='$add2',cid='$Selected',category='',phone='$phone',fax='$fax',email='$email',contact='$contact',mobile='$mobile',noe='$emp',memtype='$memtype',license='$lic',fees='$fees',yoe='$yoe',logo='$target',`vat`='$vat',`adhar_no`='$adhar',`pan_no`='$pan',`Establishment`='$Establishment',rdate='".$tdate."' where code='$code'";

$res=mysql_query("update clients set phone='$phone',fax='$fax',email='$email',contact='$contact',cid='$sub_cat',category='$cat',mobile='$mobile',noe='$emp',memtype='$memtype',yoe='$yoe',logo='$target',`vat`='$vat',`adhar_no`='$adhar',`pan_no`='$pan',`Establishment`='$Establishment',rdate='".$tdate."' where code='$code'");
  
  
  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Edit','Changes in Merchant Edit form','".$curr_dt."','".$_SESSION['lastSubID']."','". $code." ','clients') ");
		
			  
			  
			  $qry12="update Bank_Details set BankName='$phone',BranchName='$fax',IFScode='$email',AccountNumber='$contact', AC_HoldersName='$sub_cat', where Merchant_id='$code'";

			  $res12=mysql_query($qry12);
			  
			  
			  
			$up = "update users set id='".$email."' where cid='$code'";
			 mysql_query($up);
			//echo $up; 
			 
mysql_query("delete from  client_cat where ccode='".$code."'");
			   
			  $ct=count($subcat);
/*$code=mysql_insert_id();

$ct=count($subcat);

for($i=0;$i<$ct;$i++)

    {  //echo $subcat[$i];

     mysql_query("insert into client_cat values('".$code."','".$subcat[$i]."')");

    }

     mysql_query("insert into accounts values('".$code."','".$app."','".$mop."','".$pay."')");
*/
    

                if($res){

		 

echo "Data Saved";


				} else
echo "Data not Saved ";          

?>

  





<br/><br/>
<div id="message-yellow">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
				
				
				</tr>
				</table>
				</div>
				<?php if($qry ){ $sts="1";}else{$sts="2";}?>
				<script>
				
				window.open('admin.php?cmp=<?php echo $code;?>&sts=<?php echo $sts;?>','_self');
</script>
