<?php include('config.php');


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
$q="SELECT a.GenerateMember_Id,b.FirstName,b.LastName,a.MembershipDetails_Level,a.entryDate,b.MobileNumber,a.Primary_DateOfBirth,a.Primary_Anniversary,a.Primary_Pincode,a.Primary_mob2,a.Primary_nameOnTheCard,a.Primary_AddressType1,a.Primary_BuldNo_addrss,a.Primary_Area_addrss,a.Primary_Landmark_addrss,a.Primary_MaritalStatus,a.Spouse_GmailMArrid1,a.Spouse_DateOfBirth,a.Spouse_nameOnTheCardMarried,a.MembershipDetails_Fee,a.MembershipDts_GST,a.MembershipDts_GrossTotal,a.MembershipDts_PaymentDate,a.MembershipDts_PaymentMode,a.MembershipDts_InstrumentNumber,a.booklet_Series,a.ExpiryDate ,b.EmailId, b.Company ,b.Designation,b.LeadSource,a.Primary_Email_ID2 FROM `Members` a JOIN Leads_table b on a.Static_LeadID=b.Lead_id WHERE a.Sample=0 and a.canceledMember=0";

if($FromDt!="" and $Todt!=""){
    $q.=" and DATE(a.entryDate) BETWEEN '".$FromDt."' AND '".$Todt."'";
}




// echo $q;
$QuryGetLead=mysqli_query($conn,$q);

$array=array();

while($_row=mysqli_fetch_array($QuryGetLead)){
   
  
 $levelOrchid=mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$_row[3]."' ");  
 $levelOrchidFetch=mysqli_fetch_array($levelOrchid);
 $lev=$levelOrchidFetch['level_name'];
   
     
 $expiryDt = date('M, Y', strtotime($_row['ExpiryDate']));
    
  $birth=$_row[6];
   $birthDt = date("d-M", strtotime($birth));
 
$Anniver=$_row[7];
$AnniverDt = date("d-M", strtotime($Anniver));
    
    
    
    if($_row[17]=="0000-00-00"){
        $Spouse_DateOfBirth="00-00-0000";
    }else{
         $Spouse_DateOfBirth=date('d-m-Y', strtotime($_row[17]));
    }
    
      if($_row[22]=="0000-00-00"){
        $MembershipDts_PaymentDate="00-00-0000";
    }else{
         $MembershipDts_PaymentDate=date('d-m-Y', strtotime($_row[22]));
    }
    
     if($_row[26]=="0000-00-00"){
        $entryDate="00-00-0000";
    }else{
         $entryDate=date('d-m-Y', strtotime($_row[26]));
    }
    
    
    $member_id = $_row[0] ;
    

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
    

    
    
 $array[]= ['GenerateMember_Id'=>$_row[0],'FirstName'=>$_row[1],'LastName'=>$_row[2],'MembershipDetails_Level'=>$lev,'Expirydate'=>$expiryDt,'MobileNumber'=>$_row[5],'Primary_DateOfBirth'=>$birthDt,'Primary_Anniversary'=>$AnniverDt,'Qry'=>$q,'Primary_Pincode'=>$_row[8],'Primary_mob2'=>$_row[9],'Primary_nameOnTheCard'=>$_row[10],'Primary_AddressType1'=>$_row[11],'Primary_BuldNo_addrss'=>$_row[12],'Primary_Area_addrss'=>$_row[13],'Primary_Landmark_addrss'=>$_row[14],'Primary_MaritalStatus'=>$_row[15],'Spouse_GmailMArrid1'=>$_row[16],'Spouse_DateOfBirth'=>$Spouse_DateOfBirth,'Spouse_nameOnTheCardMarried'=>$_row[18],'MembershipDetails_Fee'=>$_row[19],'MembershipDts_GST'=>$_row[20],'MembershipDts_GrossTotal'=>$_row[21],'MembershipDts_PaymentDate'=>$MembershipDts_PaymentDate,'MembershipDts_PaymentMode'=>$_row[23],'MembershipDts_InstrumentNumber'=>$_row[24],'booklet_Series'=>$_row[25],'entryDate'=>$entryDate,'EmailId'=>$_row[28],'sales_associate'=>$sales_associate_name,'type'=>$type];
}
echo json_encode($array);




?>