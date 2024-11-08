<?php
include('config.php');
?>
<html>
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

</head>
<body>
<?php

if (!is_dir("../logos/")) {
    @mkdir("../logos/");
}

$code=mysqli_real_escape_string($con1,$_POST['code']);
$Latitude=mysqli_real_escape_string($con1,$_POST['Latitude']);
$Longitude=mysqli_real_escape_string($con1,$_POST['Longitude']);


$adhar=mysqli_real_escape_string($con1,$_POST['adhar']);

$pan=mysqli_real_escape_string($con1,$_POST['pan']);
$Establishment=mysqli_real_escape_string($con1,$_POST['Establishment']);

$cname=mysqli_real_escape_string($con1,$_POST['cname']);
$vat=mysqli_real_escape_string($con1,$_POST['vat']);

$state=mysqli_real_escape_string($con1,$_POST['state']);

$city=mysqli_real_escape_string($con1,$_POST['city']);

$area=mysqli_real_escape_string($con1,$_POST['area']);

$add2=mysqli_real_escape_string($con1,$_POST['add2']);

$phone=mysqli_real_escape_string($con1,$_POST['phone']);

$fax=mysqli_real_escape_string($con1,$_POST['fax']);

$email=mysqli_real_escape_string($con1,$_POST['email']);
//echo $email;
$contact=mysqli_real_escape_string($con1,$_POST['contactPerson']);

$mobile=mysqli_real_escape_string($con1,$_POST['mobile']);


$sub_cat=$_POST['companycat'];

//$cat=$_POST['cat'];

//echo $cat;

  //$Selected=implode(',',$cat); 

//$subcat=$_POST['subcat'];

$emp=mysqli_real_escape_string($con1,$_POST['emp']);

$memtype=mysqli_real_escape_string($con1,$_POST['memtype']);

$lic=mysqli_real_escape_string($con1,$_POST['lic']);

$fees=mysqli_real_escape_string($con1,$_POST['fees']);

$yoe=mysqli_real_escape_string($con1,$_POST['yoe']);

$app=mysqli_real_escape_string($con1,$_POST['app']);

$mop=mysqli_real_escape_string($con1,$_POST['mop']);
//$mobile=mysqli_real_escape_string($con1,$_POST['mobile']);
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

 //$ares=mysqli_query($con1,"select code from areas where name='".$area."'");
 
 //$arow=mysqli_fetch_row($ares);


$stater=mysqli_query($con1,"select state_code from states  where state_name='".$state."'");
 $staterows=mysqli_fetch_row($stater);


  $q="SELECT name FROM `main_cat` WHERE id IN($sub_cat)";
//   echo "$q";
   $r= mysqli_query($con1,$q);
   $data = array();
    while($row = mysqli_fetch_array($r))
    {  
         $data[]=$row[0];
      }
     $cat= implode(",",$data);
    


//$qry="update clients set name='$cname',city='$city',state='".mysqli_real_escape_string($con1,$staterows[0])."',area='$area',address='$add2',cid='$Selected',category='',phone='$phone',fax='$fax',email='$email',contact='$contact',mobile='$mobile',noe='$emp',memtype='$memtype',license='$lic',fees='$fees',yoe='$yoe',logo='$target',`vat`='$vat',`adhar_no`='$adhar',`pan_no`='$pan',`Establishment`='$Establishment',rdate='".$tdate."' where code='$code'";

$qry="update clients set phone='$phone',fax='$fax',email='$email',contact='$contact',cid='$sub_cat',category='$cat',mobile='$mobile',noe='$emp',memtype='$memtype',yoe='$yoe',logo='$target',`vat`='$vat',`adhar_no`='$adhar',`pan_no`='$pan',`Establishment`='$Establishment',rdate='".$tdate."' where code='$code'";
//echo $qry;
        $res=mysqli_query($con1,$qry);
        
        
        
$qry12="update Bank_Details set BankName='$phone',BranchName='$fax',IFScode='$email',AccountNumber='$contact', AC_HoldersName='$sub_cat', where Merchant_id='$code'";
//echo $qry12;

        $res12=mysqli_query($con1,$qry12);
        
        
        
      $up = "update users set id='".$email."' where cid='$code'";
       mysqli_query($con1,$up);
      //echo $up; 
       
mysqli_query($con1,"delete from  client_cat where ccode='".$code."'");
         
        $ct=count($subcat);
/*$code=mysql_insert_id();

$ct=count($subcat);

for($i=0;$i<$ct;$i++)

    {  //echo $subcat[$i];

     mysqli_query($con1,"insert into client_cat values('".$code."','".$subcat[$i]."')");

    }

     mysqli_query($con1,"insert into accounts values('".$code."','".$app."','".$mop."','".$pay."')");
*/

if($res) {
                    
echo '<script>swal("Data Saved")</script>';
 
//echo "Data Saved";

} else
//echo "Data not Saved ";          
echo '<script>swal("Data not Saved")</script>';
?>

<br/><br/>
<div id="message-yellow">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
        
        </tr>
        </table>
        </div>
        <?php if($qry){$sts="1";}else{$sts="2";}?>
        <script>
        
        window.open('welcome.php?cmp=<?php echo $code;?>&sts=<?php echo $sts;?>','_self');
</script>




</body>
</html>