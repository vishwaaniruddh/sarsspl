<?php
include('config.php');

$Ab_Filtter=$_POST['Ab_Filtter'];
$FromDat=$_POST['FromDt']."-".date("Y");
$Todat=$_POST['Todt']."-".date("Y");

$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));

$fromdt_day=date('d', strtotime($FromDat));
$Todt_day=date('d', strtotime($Todat));

$fromdt_month=date('m', strtotime($FromDat));
$Todt_month=date('m', strtotime($Todat));

$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));


$q="select * from Members where 1=1";


if($Ab_Filtter=="Anniversary" and $FromDat!="" and $Todat!=""){
  // $q.=" and Primary_Anniversary  BETWEEN '".$FromDt."' AND '".$Todt."' order by Primary_Anniversary"; 
  $q.=" and  (day(Primary_Anniversary) BETWEEN ".$fromdt_day." and ".$Todt_day.") and (month(Primary_Anniversary) BETWEEN ".$fromdt_month." and ".$Todt_month.") and Primary_Anniversary!='1970-01-01'   order by day(Primary_Anniversary) "; 

}


if($Ab_Filtter=="Birthday" and $FromDat!="" and $Todat!=""){
 //  $q.=" and  Primary_DateOfBirth BETWEEN '".$FromDt."' AND '".$Todt."' order by Primary_DateOfBirth"; 
$q.=" and  (day(Primary_DateOfBirth) BETWEEN ".$fromdt_day." and ".$Todt_day.") and (month(Primary_DateOfBirth) BETWEEN ".$fromdt_month." and ".$Todt_month.")  and Primary_DateOfBirth !='1970-01-01'  order by day(Primary_DateOfBirth) "; 

    
}

$QuryGetLead=mysqli_query($conn,$q);

$array1=array();

while($_row=mysqli_fetch_array($QuryGetLead)){
    
    	$sql2="select * from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
	
	$sql3="SELECT * FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);
	
	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	
	
	$sql5="SELECT state FROM `state` where state_id='".$sql2fetch['State']."' ";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);
	
	
	$dd=date('Y-m-d', strtotime($_row['entryDate']));
		$ddd=date('d-m-Y', strtotime($_row['entryDate']));
	
	
	//	$Primary_DateOfBirth=date('d-m-Y', strtotime($_row['Primary_DateOfBirth']));
	//	$Primary_Anniversary=date('d-m-Y', strtotime($_row['Primary_Anniversary']));
	
	if($_row['Primary_DateOfBirth']=="0000-00-00"){  $Primary_DateOfBirth="00-00-0000";}else{	$Primary_DateOfBirth=date('d-m', strtotime($_row['Primary_DateOfBirth']));}
if($_row['Primary_Anniversary']=="0000-00-00"){  $Primary_Anniversary="00-00-0000";}else{	$Primary_Anniversary=date('d-m', strtotime($_row['Primary_Anniversary']));}
		
if($_row['Spouse_DateOfBirth']=="0000-00-00"){  $spouse_DateOfBirth="00-00-0000";}else{	$spouse_DateOfBirth=date('d-m-Y', strtotime($_row['Spouse_DateOfBirth']));}
  




	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
     // $R=  date("d-m-Y",$d);
    
    $formattedValue = date("F, Y", $d);
    $R=$formattedValue;
    
 $array1[]= ['Primary_nameOnTheCard'=>$_row['Primary_nameOnTheCard'],'Type'=>'Primary','MobileNumber'=>$sql2fetch['MobileNumber'],'EmailId'=>$sql2fetch['EmailId'],'level_name'=>$sql3fetch['level_name'],'GenerateMember_Id'=>$_row['GenerateMember_Id'],'R'=>$R,'booklet_Series'=>$_row['booklet_Series'],'TypeNR'=>'New','MembershipDts_PaymentMode'=>$_row['MembershipDts_PaymentMode'],'MembershipDts_InstrumentNumber'=>$_row['MembershipDts_InstrumentNumber'],'Member_bankName'=>$_row['Member_bankName'],'Recipt'=>'','MembershipDts_NetPayment'=>$_row['MembershipDts_NetPayment'],'MembershipDts_GST'=>$_row['MembershipDts_GST'],'MembershipDts_GrossTotal'=>$_row['MembershipDts_GrossTotal'],'MemshipDts_Remarks'=>$_row['MemshipDts_Remarks'],'entryDate'=>$ddd,'Primary_Anniversary'=>$Primary_Anniversary,'Primary_DateOfBirth'=>$Primary_DateOfBirth,'Qry'=>$q,'FromDat'=>$FromDt1,'Todt'=>$Todt1,'spouse_DateOfBirth'=>$spouse_DateOfBirth];
}




//////////////////////// For spouse DOB////////////////////////////////////

if($Ab_Filtter!="Anniversary"){
$q2="select * from Members where 1=1";





if($Ab_Filtter=="Birthday" and $FromDat!="" and $Todat!=""){
 //  $q.=" and  Primary_DateOfBirth BETWEEN '".$FromDt."' AND '".$Todt."' order by Primary_DateOfBirth"; 
$q2.=" and  (day(Spouse_DateOfBirth) BETWEEN ".$fromdt_day." and ".$Todt_day.") and (month(Spouse_DateOfBirth) BETWEEN ".$fromdt_month." and ".$Todt_month.")  and Spouse_DateOfBirth !='1970-01-01'  order by day(Spouse_DateOfBirth) "; 

    
}

$QuryGetLead2=mysqli_query($conn,$q2);



while($_row2=mysqli_fetch_array($QuryGetLead2)){
    
    	$sql2="select * from Leads_table where Lead_id='".$_row2['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
	
	$sql3="SELECT * FROM `Level` where Leval_id='".$_row2['MembershipDetails_Level']."' ";
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);
	
	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row2['MembershipDetails_Level']."' ";
	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	
	
	$sql5="SELECT state FROM `state` where state_id='".$sql2fetch['State']."' ";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);
	
	
	$dd=date('Y-m-d', strtotime($_row2['entryDate']));
		$ddd=date('d-m-Y', strtotime($_row2['entryDate']));
	
	
	//	$Primary_DateOfBirth=date('d-m-Y', strtotime($_row['Primary_DateOfBirth']));
	//	$Primary_Anniversary=date('d-m-Y', strtotime($_row['Primary_Anniversary']));
	
	if($_row2['Primary_DateOfBirth']=="0000-00-00"){  $Primary_DateOfBirth="00-00-0000";}else{	$Primary_DateOfBirth=date('d-m-Y', strtotime($_row2['Primary_DateOfBirth']));}
if($_row2['Primary_Anniversary']=="0000-00-00"){  $Primary_Anniversary="00-00-0000";}else{	$Primary_Anniversary=date('d-m-Y', strtotime($_row2['Primary_Anniversary']));}
		
if($_row2['Spouse_DateOfBirth']=="0000-00-00"){  $spouse_DateOfBirth="00-00-0000";}else{	$spouse_DateOfBirth=date('d-m', strtotime($_row2['Spouse_DateOfBirth']));}
  




	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
     // $R=  date("d-m-Y",$d);
    
    $formattedValue = date("F, Y", $d);
    $R=$formattedValue;
    
 $array1[]= ['Primary_nameOnTheCard'=>$_row2['Spouse_nameOnTheCardMarried'],'Type'=>'Spouse','MobileNumber'=>$_row2['Spouse_mob1MArid1'],'EmailId'=>$_row2['Spouse_GmailMArrid1'],'level_name'=>$sql3fetch['level_name'],'GenerateMember_Id'=>$_row2['GenerateMember_Id'],'R'=>$R,'booklet_Series'=>$_row2['booklet_Series'],'TypeNR'=>'New','MembershipDts_PaymentMode'=>$_row2['MembershipDts_PaymentMode'],'MembershipDts_InstrumentNumber'=>$_row2['MembershipDts_InstrumentNumber'],'Member_bankName'=>$_row2['Member_bankName'],'Recipt'=>'','MembershipDts_NetPayment'=>$_row2['MembershipDts_NetPayment'],'MembershipDts_GST'=>$_row2['MembershipDts_GST'],'MembershipDts_GrossTotal'=>$_row2['MembershipDts_GrossTotal'],'MemshipDts_Remarks'=>$_row2['MemshipDts_Remarks'],'entryDate'=>$ddd,'Primary_Anniversary'=>$Primary_Anniversary,'Primary_DateOfBirth'=>$spouse_DateOfBirth,'Qry'=>$q,'FromDat'=>$FromDt1,'Todt'=>$Todt1,'spouse_DateOfBirth'=>$spouse_DateOfBirth];
}


foreach ($array1 as $key => $row) {
    $dob[$key]  = $row['Primary_DateOfBirth'];
   
}
 
 $dob  = array_column($array1, 'Primary_DateOfBirth');
 array_multisort($dob, SORT_ASC, $array1);
}
 
//echo json_encode($array1);






//echo "anand".$array1[0]['Primary_DateOfBirth'];


?>

<div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                     <th>srno</th>  
                                     <th> Name on the Card</th> 
                                     <th> Type</th> 
                                     <th> Level</th>
                                     <th> Membership No.</th>
                                      <th id="BdayAnni"><?php echo $Ab_Filtter;?></th>
                                     <th> Booklet Number</th>
                                     <th>Email</th>
                                     <th>Mobile</th>
                                     <th> Remarks</th>
                                  </tr>
                                    </thead>
                                    <tbody id="setTable">
               
                             <?php
              for($i=0;$i<count($array1);$i++){
                            $srno=$i+1;
                            $Birth_Anni="";
    if($Ab_Filtter=="Birthday"){ if($array1[$i]['Primary_DateOfBirth']=='01-01-1970'){ $Birth_Anni="00-00-0000"; }else{$Birth_Anni=$array1[$i]['Primary_DateOfBirth'];}     }
    else if($Ab_Filtter=="Anniversary"){  if($array1[$i]['Primary_Anniversary']=='01-01-1970'){ $Birth_Anni="00-00-0000"; }else{   $Birth_Anni=$array1[$i]['Primary_Anniversary'];} }
    
  //  $('#BdayAnni').text($Ab_Filtter);
  //  $('#BdayAnni2').text($Ab_Filtter);
   // $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].Primary_nameOnTheCard+'</td><td>'+json[i].Type+'</td><td>'+json[i].level_name+'</td><td>'+json[i].GenerateMember_Id+'</td><td>'+Birth_Anni+'</td><td>'+json[i].booklet_Series+'</td><td>'+json[i].EmailId +'</td><td>'+json[i].MobileNumber +'</td><td>'+json[i].MemshipDts_Remarks +'</td> </tr>');
                     
                          
               ?>
               
                             <tr>
                                   <td><?php echo $srno;?></td>
                                 	<td><?php echo $array1[$i]['Primary_nameOnTheCard']; ?></td>
                                 	<td><?php echo $array1[$i]['Type']; ?></td>
                                    <td><?php echo $array1[$i]['level_name']; ?></td>
                                    <td><?php echo $array1[$i]['GenerateMember_Id']; ?></td>
                                	<td><?php echo $Birth_Anni; ?></td>
                                    <td><?php echo $array1[$i]['booklet_Series']; ?></td>
                                    <td><?php echo $array1[$i]['EmailId']; ?></td>
                                    <td><?php echo $array1[$i]['MobileNumber']; ?></td>
                                    <td><?php echo $array1[$i]['MemshipDts_Remarks']; ?></td>
   
   

	

				</tr>
			
			<?php 
			
			   
			}
			?>
	













                   
                   
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                       <th>srno</th>  
                                     <th> Name on the Card</th> 
                                     <th> Type</th> 
                                     <th> Level</th>
                                     <th> Membership No.</th>
                                     <th id="BdayAnni2"> Anniversary Date</th>
                                     <th> Booklet Number</th>
                                     <th>Email</th>
                                     <th>Mobile</th>
                                     <th> Remarks</th>
                                        </tr>
                                    </tfoot>
                                </table>


