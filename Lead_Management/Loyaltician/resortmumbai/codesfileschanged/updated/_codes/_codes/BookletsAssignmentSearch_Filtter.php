<?php
include('config.php');

$Level_Filtter=$_POST['Level_Filtter'];
$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

$q="select entryDate,MembershipDetails_Level,booklet_Series,GenerateMember_Id,Primary_nameOnTheCard,Sample,canceledMember ,void,void_reason from Members where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` ) ";
if($Level_Filtter!="" and $FromDt!="" and $Todt!=""){
    $q.=" and MembershipDetails_Level='".$Level_Filtter."'  and DATE(entryDate) BETWEEN '".$FromDt."' AND '".$Todt."' order by booklet_Series";
}

$QuryGetLead=mysqli_query($conn,$q);


$array=array();

while($_row=mysqli_fetch_array($QuryGetLead)){
    $entdt=$_row['entryDate'];
    $entdt_show=date('d-m-Y', strtotime($entdt));
    
    $levelOrchid=mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ");  
 $levelOrchidFetch=mysqli_fetch_array($levelOrchid);
   $lev=$levelOrchidFetch['level_name'];
   
   $void = $_row['void'];
   $void_reason = $_row['void_reason'];
    
 $array[]= ['entryDate'=>$entdt_show,'Type'=>'','MembershipDetails_Level'=>$lev,'booklet_Series'=>$_row['booklet_Series'],'GenerateMember_Id'=>$_row['GenerateMember_Id'],'Primary_nameOnTheCard'=>$_row['Primary_nameOnTheCard'],'Qry'=>$q,'FromDat'=>$FromDt1,'Todt'=>$Todt1,'Sample'=>$_row['Sample'],'canceledMember'=>$_row['canceledMember'] ,'void'=>$void, 'void_reason'=>$void_reason];
}
echo json_encode($array);




?>