<?php include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$did=1 ;
$srno=1;
$PromotionalCheck1=1 ; 
 
 
 $message2 = '<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 
 <tr style="height:14.5pt">
 
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
 
  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>
 
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 
 </tr>';
 
$sql2="SELECT serviceName,serialNumber FROM `voucher_Type_new` where level_id='".$did."' and serviceName not like '%RENEWAL%' order by serialNumber ASC";
$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){
    
    if ($PromotionalCheck1 == 1) {

        $PromotionalCheck1 = 0;
        continue;
    }
    
    $remaining1=substr($sql2fetch['serialNumber'],8);
    if($isfirst==1){
            $value= $AssignBooklet+1;
    }else{
        $value= $AssignBooklet;        
    }

  	         $AssignBooklet1=$value.$remaining1;

  	         
  	         
$message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'.$srno.'</span></p>
  </td>
  
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'. $sql2fetch['serviceName'].'</span></p>
  </td>
  
  
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'. $AssignBooklet1.'</span></p>
  </td>
 
 </tr>';
     $srno++;
} 


echo $message2 ; 
?>