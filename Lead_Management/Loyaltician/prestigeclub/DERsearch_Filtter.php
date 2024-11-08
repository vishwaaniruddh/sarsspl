<?php
include('config.php');

$Ab_Filtter=$_POST['Ab_Filtter'];
$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

$q="select Primary_Title,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,entryDate,Spouse_Title,Spouse_FirstName,Spouse_LastName,Primary_MaritalStatus,Primary_nameOnTheCard,Spouse_nameOnTheCardMarried,ExpiryDate from Members where 1=1";
if($Ab_Filtter=="DSR" and $FromDt!="" and $Todt!=""){
    $q.=" and DATE(entryDate) BETWEEN '".$FromDt."' AND '".$Todt."'";
}

if($Ab_Filtter=="Anniversary" and $FromDt!="" and $Todt!=""){
   $q.=" and Primary_Anniversary   BETWEEN '".$FromDt."' AND '".$Todt."' "; 
}


if($Ab_Filtter=="Birthday" and $FromDt!="" and $Todt!=""){
   $q.=" and  Primary_DateOfBirth BETWEEN '".$FromDt."' AND '".$Todt."' "; 
}
//echo $q;
$QuryGetLead=mysqli_query($conn,$q);

$array=array();

while($_row=mysqli_fetch_array($QuryGetLead)){
    
     $sql2="select FirstName,LastName from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
			    
	$sql3="SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	//echo $sql2;
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);

	
        $R = date('M,Y', strtotime($_row['ExpiryDate']));
 
 $array[]= ['Primary_Title'=>$_row['Primary_Title'],'FullName'=>$sql2fetch['FirstName']." ".$sql2fetch['LastName'],'GenerateMember_Id'=>$_row['GenerateMember_Id'],'level_name'=>$sql3fetch['level_name'],'R'=>$R,'Qry'=>$q,'FromDat'=>$FromDt1,'Todt'=>$Todt1,'Primary_nameOnTheCard'=>$_row['Primary_nameOnTheCard'],'Spouse_nameOnTheCardMarried'=>$_row['Spouse_nameOnTheCardMarried']];
}
echo json_encode($array);




?>