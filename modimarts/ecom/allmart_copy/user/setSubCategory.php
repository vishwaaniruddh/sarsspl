<?php session_start();
include('config.php');
$data=array();
$pcat=$_POST['proct'];
$maincat=$_POST['maincat'];
if($maincat=='NewCat'){
$qrya="select id,name from main_cat where base_cat ='".$pcat."'   ";
//echo $qrya;
 $resulta=mysqli_query($con1,$qrya);
 while($rowa = mysqli_fetch_array($resulta)){
$data[]=['id'=>$rowa['id'],'name'=>$rowa['name']];
}
  echo json_encode($data);
}

if($maincat=='Maincategory'){
    $qrya="select id,name from main_cat where under ='".$pcat."'   ";
//echo $qrya;
 $resulta=mysqli_query($con1,$qrya);
 while($rowa = mysqli_fetch_array($resulta)){
$data[]=['id'=>$rowa['id'],'name'=>$rowa['name']];
}
  echo json_encode($data);
}


if($maincat=='Subcat'){
    $qrya="select id,name from main_cat where under ='".$pcat."'   ";
 $resulta=mysqli_query($con1,$qrya);
 $numrow=mysqli_num_rows($resulta);
 if($numrow>0){
 while($rowa = mysqli_fetch_array($resulta)){
$data[]=['id'=>$rowa['id'],'name'=>$rowa['name'],'heading'=>$rowa['id']];
 
         $QChk1=mysqli_query($con1,"select id,name from main_cat where under='".$rowa['id']."' ");
         $numChk1=mysqli_num_rows($QChk1);
         if($numChk1>0){
         while($fChk1=mysqli_fetch_array($QChk1)){
         $data[]=['id'=>$fChk1['id'],'name'=>$fChk1['name'],'heading'=>'' ];
             
                 $QChk2=mysqli_query($con1,"select id,name from main_cat where under='".$fChk1['id']."' ");
                 $numChk2=mysqli_num_rows($QChk2);
                 if($numChk2>0){
                 while($fChk2=mysqli_fetch_array($QChk2)){
                  $data[]=['id'=>$fChk2['id'],'name'=>$fChk2['name'] ,'heading'=>''];
             
                             $QChk3=mysqli_query($con1,"select id,name from main_cat where under='".$fChk2['id']."' ");
                             $numChk3=mysqli_num_rows($QChk3);
                             if($numChk3>0){
                             while($fChk3=mysqli_fetch_array($QChk3)){
                             $data[]=['id'=>$fChk3['id'],'name'=>$fChk3['name'] ,'heading'=>''];
             
                             }
                            }
                 }
                 }
         }
        }

    }
}
  echo json_encode($data);
}
?>