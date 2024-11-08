<?php
include('config.php');
function get_member_details($parameter,$id){
    global $conn;



    $sql = mysqli_query($conn,"SELECT * FROM `Members`,`RenewalMembersDetails` where Members.Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Members.Static_LeadID = RenewalMembersDetails.Static_LeadID and Members.Static_LeadID='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    if($sql_result){
        return $sql_result[$parameter];
    }
    else{
        return false;
    }

}



$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

//$q="SELECT a.GenerateMember_Id,b.FirstName,b.LastName,a.MembershipDetails_Level,DATE_ADD(a.entryDate, INTERVAL 1 YEAR),b.MobileNumber,a.Primary_DateOfBirth,a.Primary_Anniversary FROM `Members` a JOIN Leads_table b on a.Static_LeadID=b.Lead_id WHERE a.Sample=0 and a.canceledMember=0";
$q="SELECT a.GenerateMember_Id,b.FirstName,b.LastName,a.MembershipDetails_Level,a.entryDate,b.MobileNumber,a.Primary_DateOfBirth,a.Primary_Anniversary,a.Primary_Pincode,a.Primary_mob2,a.Primary_nameOnTheCard,a.Primary_AddressType1,a.Primary_BuldNo_addrss,a.Primary_Area_addrss,a.Primary_Landmark_addrss,a.Primary_MaritalStatus,a.Spouse_GmailMArrid1,a.Spouse_DateOfBirth,a.Spouse_nameOnTheCardMarried,a.MembershipDetails_Fee,a.MembershipDts_GST,a.MembershipDts_GrossTotal,a.MembershipDts_PaymentDate,a.MembershipDts_PaymentMode,a.MembershipDts_InstrumentNumber,a.booklet_Series,a.entryDate,ExpiryDate ,b.EmailId, b.Company ,b.Designation,b.LeadSource FROM `Members` a JOIN Leads_table b on a.Static_LeadID=b.Lead_id WHERE a.Sample=0 and a.canceledMember=0";

if($FromDt!="" and $Todt!=""){
    $q.=" and DATE(a.entryDate) BETWEEN '".$FromDt."' AND '".$Todt."'";
}


$QuryGetLead=mysqli_query($conn,$q);

$array=array();

while($_row=mysqli_fetch_assoc($QuryGetLead)){
   
  
 $levelOrchid=mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ");  
 $levelOrchidFetch=mysqli_fetch_array($levelOrchid);
 $lev=$levelOrchidFetch['level_name'];
   
     
 $expiryDt = date('M, Y', strtotime($_row['ExpiryDate']));
    
  $birth=$_row['Primary_DateOfBirth'];
   $birthDt = date("d-M", strtotime($birth));
 
$Anniver=$_row['Primary_Anniversary'];
$AnniverDt = date("d-M", strtotime($Anniver));
    
    
    
    if($_row['Spouse_DateOfBirth']=="0000-00-00"){
        $Spouse_DateOfBirth="00-00-0000";
    }else{
         $Spouse_DateOfBirth=date('d-m-Y', strtotime($_row['Spouse_DateOfBirth']));
    }
    
      if($_row['MembershipDts_GrossTotal']=="0000-00-00"){
        $MembershipDts_PaymentDate="00-00-0000";
    }else{
         $MembershipDts_PaymentDate=date('d-m-Y', strtotime($_row['MembershipDts_GrossTotal']));
    }
    
     if($_row['entryDate']=="0000-00-00"){
        $entryDate="00-00-0000";
    }else{
         $entryDate=date('d-m-Y', strtotime($_row['entryDate']));
    }
    
     $member_id = $_row['GenerateMember_Id'] ; 

    $sales_sql = mysqli_query($conn,"select Static_LeadID from Members where GenerateMember_Id = '".$member_id."'");
    $sales_sql_result = mysqli_fetch_assoc($sales_sql);
    $static_leadid = $sales_sql_result['Static_LeadID'];
    
    $LeadDelegation_sql = mysqli_query($conn,"select * from LeadDelegation where LeadId='".$static_leadid."'");
    $LeadDelegation_sql_result = mysqli_fetch_assoc($LeadDelegation_sql);
    $SalesmanId = $LeadDelegation_sql_result['SalesmanId'];
    
    $SalesAssociate_sql = mysqli_query($conn,"select * from SalesAssociate where SalesmanId='".$SalesmanId."'");
    $SalesAssociate_sql_result = mysqli_fetch_assoc($SalesAssociate_sql);
    $sales_associate_name = $SalesAssociate_sql_result['FirstName'] .' '. $SalesAssociate_sql_result['LastName']; 
    
            if(get_member_details('NewGenerateMember_Id',$static_leadid)>0){
            $type = 'Renew';
        } elseif($_row['canceledMember']==1){
            $type =  'Cancel';
        }
        else{
            $type =  'New';
        }
    


 $array[]= [

'GenerateMember_Id'=>$_row['GenerateMember_Id'],
'FirstName'=>$_row['FirstName'],
'LastName'=>$_row['LastName'],
'MembershipDetails_Level'=>$lev,
'Expirydate'=>$expiryDt,
'MobileNumber'=>$_row['MobileNumber'],

'EmailId'=>$_row['EmailId'],

'Company'=>$_row['Company'],

'Designation'=>$_row['Designation'],

'Primary_mob2'=>$_row['Primary_mob2'],

'Primary_BuldNo_addrss'=>$_row['Primary_BuldNo_addrss'],
'Primary_Area_addrss'=>$_row['Primary_Area_addrss'],
'Primary_Landmark_addrss'=>$_row['Primary_Landmark_addrss'],
'MembershipDts_GrossTotal'=>$_row['MembershipDts_GrossTotal'],
'MembershipDts_PaymentMode'=>$_row['MembershipDts_PaymentMode'],
'booklet_Series'=>$_row['booklet_Series'],
'entryDate'=>$entryDate,
'sales_associate'=>$sales_associate_name,
     ];
}

$json = ['query'=>$q,'data'=>$array];
echo json_encode($json);















?>