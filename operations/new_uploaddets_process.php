<?php
session_start();
include("config.php");
include("access.php");

if(date('m')>='4'){
    $invd=date('y')."-".date('y',strtotime('+1 year')); 
    
}else{
    $invd=date('y',strtotime('-1 year'))."-".date('y');
    
    
}

$nwyr=date('Y');
$nwdt=date('m');


//echo $invd;

//print_r($_POST);
$image1=$_FILES['imguprec']['name'];
$cntt1=count($image1);
$err=0;
//echo $cntt1;
  $dt=date('Y-m-d-H:i:s');
  
  
  
  $sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_row($sr);
	
$errtext="";
for($a=0;$a<$cntt1;$a++)
{

$exs=0;
$name="";
$fname="";

$name2="";
$fname2="";
$reqno=$_POST["reqno"][$a];
  
if (($_FILES['imguprec']['name'][$a])!="") 
{
$exs=1;


$pthn="../ebill/new_online_uploads/receipt copy/".$invd;
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}

$pthn=$pthn."/".$nwdt."/";
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}

//echo $pthn;
 //$pthn="new_online_uploads/receipt copy/";

$name=$_FILES['imguprec']['name'][$a];

      $arrayf = explode(".", $name);
      //$fnameu=$pthn.$reqno."-".$dt."-rec".".".$arrayf[1];
$fname=$pthn.$reqno."-".$dt."-rec".".".$arrayf[1];

 if (move_uploaded_file($_FILES["imguprec"]["tmp_name"][$a], $fname)) 
   {
    
    
    } else 
    {
$err++;
echo $pthn.$fname;
   $errtext=$errtext."Upload of request no".$reqno."failed"."</br>";

}
}

if (($_FILES['imgup']['name'][$a])!="") 
{
$exs=1;
$pthn2="../ebill/new_online_uploads/bill copy/".$invd;
if (!file_exists($pthn2)) 
{
   mkdir($pthn2, 0755, true);
}

$pthn2=$pthn2."/".$nwdt."/";
if (!file_exists($pthn2)) 
{
   mkdir($pthn2, 0755, true);
}

$name2=$_FILES['imgup']['name'][$a];

      $arrayf = explode(".", $name2);
      $fname2=$pthn2.$reqno."-".$dt."-bill".".".$arrayf[1];

 if (move_uploaded_file($_FILES["imgup"]["tmp_name"][$a], $fname2)) 
   {
        
    } else 
    {
    
echo $pthn2.$fname2;
        
        $err++;
        
     

   $errtext=$errtext."Upload of request no".$reqno."failed"."</br>";
    

    }
    
}


if($exs==1 && $err==0)
{
    $q="INSERT INTO `online_transaction_uploads`(`reqno`, `bill_copy`, `bill_copy_fylname`, `receipt_copy`, `receipt_copy_fylname`, `upby`, `updt`) VALUES ('".$reqno."','".$fname."','".$name."','".$fname2."','".$name2."','".$srno[0]."','".$dt."')";
    //echo $q;
$qr=mysqli_query($con,$q);

if(!$qr)
{
    echo $q;
    $err++;
    echo mysqli_error();
}
    
}


}


if($err==0)
{
    echo "Upload Successfull";


}
else
{

echo $errtext;
}
?>
    <center><a href="new_upload_img.php">Go Back</a></center>
