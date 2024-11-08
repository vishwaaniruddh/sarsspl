<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';

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



function get_leadsource_name($id){
    global $conn;
    
    $sql = mysqli_query($conn,"select * from Lead_Sources where SourceId='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['Name'];
}


// echo $sqlme;

// return;

$table=mysqli_query($conn,$sqlme);
//echo mysql_num_rows($table);

$contents='';
 $contents.="Sr. No. \t MEMBER_ID \t FIRSTNAME \t LASTNAME \t Level \t ExpiryDate \t MOBILENUMBER \t PRIMARYMAIL \t COMPANY \t DESIGNATION \t LEAD SOURCE  \t DATEOFBIRTH \t ANNIVERSARY \t Primary_Pincode \t Primary_mob2 \t Primary_nameOnTheCard \t Primary_AddressType1 \t Primary_BuldNo_addrss \t Primary_Area_addrss \t Primary_Landmark_addrss \t Primary_MaritalStatus \t Spouse_GmailMArrid1 \t Spouse_DateOfBirth \t Spouse_nameOnTheCardMarried \t MembershipDetails_Fee \t MembershipDts_GST \t MembershipDts_GrossTotal \t MembershipDts_PaymentDate \t MembershipDts_PaymentMode \t MembershipDts_InstrumentNumber \t booklet_Series \t entryDate \t Sales Associate \t Type \t ";
// echo $contents;
 $cnt=0;
 
while($_row=mysqli_fetch_array($table))
{
$cnt++;


	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
  	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	
   

  if($_row[3]=="1"){
         $lev="Gold";
     }else if($_row[3]=="2"){
         $lev="Platinum";
     }
     

$dd=date('Y-m-d', strtotime($_row[4]));
$exm="";	
$exm=$sql4fetch['Expiry_month'];

if(date('d', strtotime($_row['entryDate']))>="25" ){
  if(date("Y-m-d")>="2019-11-25"){$exm+=1;}
}

 $d = strtotime("+".$exm." months",strtotime($dd));
   $expiryDt=  date("M-Y",$d);


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
    
    
     
     
     
    $contents.="\n".$cnt."\t";
    $contents.=$_row[0]."\t";
    $contents.=$_row[1]."\t";
    $contents.=$_row[2]."\t";
    $contents.=$lev."\t";
    $contents.=$expiryDt."\t";
    $contents.=$_row[5]."\t";
    
    $contents.=$_row[28]."\t";
    $contents.=$_row[29]."\t";
    $contents.=$_row[30]."\t";
    $contents.=get_leadsource_name($_row[31])."\t";
    
    $contents.=$birthDt."\t";
    $contents.=$AnniverDt."\t";
    
    $contents.=$_row[8]."\t";
    $contents.=$_row[9]."\t";
    $contents.=$_row[10]."\t";
    $contents.=$_row[11]."\t";
    $contents.=$_row[12]."\t";
    $contents.=$_row[13]."\t";
    $contents.=$_row[14]."\t";
    $contents.=$_row[15]."\t";
    $contents.=$_row[16]."\t";
    $contents.=$Spouse_DateOfBirth."\t";
    $contents.=$_row[18]."\t";
    $contents.=$_row[19]."\t";
    $contents.=$_row[20]."\t";
    $contents.=$_row[21]."\t";
    $contents.=$MembershipDts_PaymentDate."\t";
    $contents.=$_row[23]."\t";
    $contents.=$_row[24]."\t";
    $contents.=$_row[25]."\t";
    $contents.=$entryDate."\t";
    $contents.=$sales_associate_name."\t";
    $contents.=$type."\t";

 } 
 
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
// $fpWrite = fopen("export.csv", "w");
// fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>