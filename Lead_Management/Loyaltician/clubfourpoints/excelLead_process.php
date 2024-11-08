<?php
session_Start();?>
<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>


<?php
include("config.php");
$counter=0;
require_once 'Excel/reader.php';
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

$maxsize='800';

$size=($_FILES['userfile']['size']/1024);

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name']; 

 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
	
if($fichier){
	
$filename = stripslashes($_FILES['userfile']['name']);

			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img/".$image_name;
	///echo $newname;	

$copied = copy($_FILES['userfile']['tmp_name'], $newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;


$data->read($newname);


error_reporting(E_ALL ^ E_NOTICE);
$ab=array();
$contents='';

for ($x = 2; $x <= $data->sheets[0]['numRows']-1; $x++) {
//echo $x." <br>";
 
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	//echo $ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11]."<br>";
	// $dat=trim($ab[22]);
//echo "<br>";
//	$dt='0000-00-00';
//$UNIX_DATE = ($dat - 25569) * 86400;
	//echo "<br>".$ab[18];
//echo $UNIX_DATE."<br>";
//	if($UNIX_DATE>0){
// $dt=gmdate("Y-m-d",$UNIX_DATE);
 //echo $UNIX_DATE.">>><<<".$dat." *** *** ".$dt."<br>";
//}
  //  else
   // {
   // $dt="0000-00-00";
  // echo $dt."<br>";
   // }

	
 // $dt=str_replace("/","-",$ab[9]);
	//echo $dt." ";
	 //$dt2=date('Y-m-d', strtotime($dt .' -1 day'));

	/*$sql="select ATM_ID from esurvsites3 where ATM_ID='".$ab[4]."'";
	//echo $sql;
	$check=mysqli_query($conn,$sql);
	$numrow=mysqli_num_rows($check);
	//echo $numrow;
	if($numrow >0)
	{*/
	    /*
	$contents.="\n ".preg_replace('/\s+/', ' ', $ab[1])." \t ".preg_replace('/\s+/', ' ', $ab[2])." \t ".preg_replace('/\s+/', ' ',$ab[3] )." \t ".preg_replace('/\s+/', ' ',$ab[4] )." \t ".preg_replace('/\s+/', ' ',$ab[5] )." \t ".preg_replace('/\s+/', ' ',$ab[6] )." \t ".preg_replace('/\s+/', ' ',$ab[7] )." \t ".preg_replace('/\s+/', ' ',$ab[8] )." \t ".preg_replace('/\s+/', ' ',$ab[9] )." \t ".preg_replace('/\s+/', ' ',$ab[10] )." \t ".preg_replace('/\s+/', ' ',$ab[11] )." \t ".preg_replace('/\s+/', ' ',$ab[12] )." \t ".preg_replace('/\s+/', ' ',$ab[13] )." \t ".preg_replace('/\s+/', ' ',$ab[14] )." \t ".preg_replace('/\s+/', ' ',$ab[15],$ab[16],$ab[17] );
*/
/*$result="update esurvsites3 set SN='".$ab[1]."',Customer='".$ab[2]."',Bank='".$ab[3]."',ATM_ID='".$ab[4]."',ATM_ID2='".$ab[5]."',ATM_ID3='".$ab[6]."',ATM_ID4='".$ab[7]."',ATMShortName='".$ab[8]."',SiteAddress='".$ab[9]."',City='".$ab[10]."',State='".$ab[11]."',DVRIP='".$ab[12]."',Network='".$ab[13]."',DVRName='".$ab[14]."',DVRPort='".$ab[15]."',UserName='".$ab[16]."',Password='".$ab[17]."',CSSBM='".$ab[18]."',CSSBMNumber='".$ab[19]."',EMail_ID='".$ab[20]."',BackofficerName='".$ab[21]."',BackofficerNumber='".$ab[22]."',HeadSupervisorName='".$ab[23]."',HeadSupervisorNumber='".$ab[24]."',SupervisorName='".$ab[25]."',Supervisornumber='".$ab[26]."',Policestation='".$ab[27]."',Polstnname='".$ab[28]."' where  ATM_ID='".$ab[4]."'";
    $runresult=mysqli_query($conn,$result);
	}
	
	else
	{*/
	
	
   $exclError='2';
    $exclreason='';
    $exclreason2='';
/*	$checkState=mysqli_query($conn,"select state_id from state where state='".$ab[9]."'");
    $Statecount=mysqli_num_rows($checkState);
    $fetchState=mysqli_fetch_array($checkState);
    
	if($Statecount=="0"){
	   $exclError='1';
	 $exclreason1="State Name Issue";
    }
	  */  


$Senpense='0';

if($ab[2]!=""){
    $checkFirstName=mysqli_query($conn,"select FirstName from Leads_table where FirstName='".$ab[2]."' ");
if($checkFirstName){
	$FirstNamecount=mysqli_num_rows($checkFirstName);
	$fetchFirstNm= mysqli_fetch_array($checkFirstName);

    $firstChar1= substr($fetchFirstNm['FirstName'],0,1);
}

    $firstChar2= substr($ab[2],0,1);
}
if($ab[3]!=""){
    $checkLastName=mysqli_query($conn,"select LastName from Leads_table where LastName='".$ab[3]."' ");
if($checkLastName){
    $fetchLastNm= mysqli_fetch_array($checkLastName);
	$LastNamecount=mysqli_num_rows($checkLastName);
}else{$LastNamecount="0";}
}else{$LastNamecount="0";}    


if($ab[8]!=""){
        if(strlen($ab[8])=="10"){
            $MobileNotValid="0";
        }
        else{
             $MobileNotValid="1";
        }
     }



if($ab[8]!=""){
    
    if($ab[7]!=""){
      	$checkMobile=mysqli_query($conn,"select Lead_id from Leads_table where MobileNumber='".$ab[8]."' and MobileCode='".$ab[7]."' and  MobileNumber!='' ");
  	if($checkMobile){
	$Mobilecount=mysqli_num_rows($checkMobile);
	}else{
	    $Mobilecount="0";
	}
  
  
    }else{
//	$checkMobile=mysqli_query($conn,"select Lead_id from Leads_table where MobileNumber='".$ab[8]."' and MobileCode='".$ab[7]."' and  MobileNumber!='' ");
	$checkMobile=mysqli_query($conn,"select Lead_id,MobileNumber from Leads_table where MobileNumber='".$ab[8]."'  and  MobileNumber!='' ");
    	if($checkMobile){
    	    $fetchMobileNm= mysqli_fetch_array($checkMobile); 
    	    if($fetchFirstNm['FirstName']==$ab[2] && $fetchLastNm['LastName']==$ab[3] && $fetchMobileNm['MobileNumber']==$ab[8]){
    	    
    	    $Mobilecount=mysqli_num_rows($checkMobile);
    	    }
    	    else{
    	        $Mobilecount="0";
    	    }
	}else{
	    $Mobilecount="0";
	}
        
    }

}else{
    $Mobilecount="0";
}
	
	$checkContact1=mysqli_query($conn,"select Lead_id from Leads_table where ContactNo1='".$ab[10]."' and contact1Code ='".$ab[9]."' and ContactNo1!='' and contact1Code !='' ");
	if($checkContact1){
	$Contact1count=mysqli_num_rows($checkContact1);
	}else{
	    $Contact1count="0";
	}
	
/*	$checkEmail=mysqli_query($conn,"select Lead_id from Leads_table where EmailId='".$ab[14]."'");
	$Emailcount=mysqli_num_rows($checkMobile);
*/	

if($ab[3]!=""){
    if($Contact1count>0){
      
      if($LastNamecount>0){
          if($firstChar1==$firstChar2){
               $exclError='1';
               $exclreason2="FirstName,LastName,ContactNumber is Exist ";
               $Senpense='3';
          }
      }
    }
}
//echo "gupta".$Mobilecount ."anand select Lead_id from Leads_table where MobileNumber='".$ab[8]."'  and  MobileNumber!='' ";
	
    /*if($LastNamecount>0){
       $exclError='1';
       $exclreason2="Last Name Exist";
       $Senpense='3';
    }*/
    if($Mobilecount>0){
       
       $exclreason2="Mobile No. Exist";
       $exclError='1';
       $Senpense='3';
    }
    
    
    if($ab[8]==""){
      
       $exclError='1';
       $exclreason2="Mobile No. Empty";
       $Senpense='3';
    }
    
    if($MobileNotValid>0){
       
       $exclreason2="Mobile No. Not Valid";
       $exclError='1';
       $Senpense='3';
    }
    
    
    
    
    
    /*if($Emailcount>0){
       
         $exclError='1';
         $exclreason3="Email ID Exist";
         $Senpense='3';
    }*/
  // $exclreason=$exclreason1.','.$exclreason2.','.$exclreason3 ;
  $exclreason=$exclreason2 ;

  $hotelname='2';
$LeadSource=$_POST['LeadSource'];
$SalesAsso=$_POST['Sales'];
	 date_default_timezone_set('Asia/Kolkata');
    $dates = date('Y-m-d H:i:s');
    
$fistname=mysqli_real_escape_string($conn, $ab[2]);
$lsname=mysqli_real_escape_string($conn, $ab[3]);

 if($Senpense!="3"){

	 $result= "insert into Leads_table(Title,FirstName,LastName,MobileCode,MobileNumber,contact1Code,ContactNo1,contact2Code,ContactNo2,Company,Designation,EmailId,Status,leadEntryef,Hotel_Name,Excel,ExcelReason,LeadSource,City,PinCode,Country,Nationality,State,Creation) values('".$ab[1]."','".$fistname."','".$lsname."','".$ab[7]."','".$ab[8]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$Senpense."','".$_SESSION['id']."','".$hotelname."','".$exclError."','".$exclreason."','".$LeadSource."','".$ab[13]."','".$ab[14]."','India','Indian','1','".$dates."')";
}else if($Senpense=="3"){
     $result= "insert into Leads_tableSuspend(Title,FirstName,LastName,MobileCode,MobileNumber,contact1Code,ContactNo1,contact2Code,ContactNo2,Company,Designation,EmailId,Status,leadEntryef,Hotel_Name,Excel,ExcelReason,LeadSource,City,PinCode,Country,Nationality,State,Creation,delegatedSalesmanID) values('".$ab[1]."','".$fistname."','".$lsname."','".$ab[7]."','".$ab[8]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$Senpense."','".$_SESSION['id']."','".$hotelname."','".$exclError."','".$exclreason."','".$LeadSource."','".$ab[13]."','".$ab[14]."','India','Indian','1','".$dates."','".$SalesAsso."')";
}

	 $runresult=mysqli_query($conn,$result);
	
	 $Lid=mysqli_insert_id($conn);
	
	 //$atmid=mysqli_insert_id($conn);
	 //echo $atmid;
	 

	 if($runresult && $SalesAsso!=""){
	  $sql="insert into LeadDelegation(LeadId,SalesmanId,DelegatedTIme) values('".$Lid."','".$SalesAsso."','".$dates."')";
  	//  $sql="insert into LeadDelegation(LeadId,SalesmanId,DelegatedTIme) values('".$Lid."','".$ab[15]."','".$dates."')";
  
    $runsql=mysqli_query($conn,$sql);
    
    if($Senpense!=3){
    $sql2="update Leads_table set Status='1',Assigned='".$dates."' where Lead_id='".$Lid."'";
    $runsql2=mysqli_query($conn,$sql2);
    }
	 
	 }
	 
	 
	 
		 if(!$runresult){
		 echo "failed".mysql_error();
		 }else{
		     ?>
		     
		     <script type="text/javascript">
		     
		      swal({
  title: "Success!",
  text: "Thank you, Data uploaded Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
window.location.href = "prospect_view.php";
// .then((willDelete) => {
//   if (willDelete) {
 
//     // window.open("prospect_view.php","_self");
//       window.location.href = "prospect_view.php";
    
//   } 
// });
     
		     
		     
//alert("Data uploaded successfully");
//window.location='prospect_view.php';
</script>
		  <?php   
		 }


}//end x ka for loop
//end sales site

//header('location:newsite.php');
//}
//}
 }//print $contents;

if(count($err)>0)
{
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=rejectedsites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  //echo "<br>";
echo "<script type='text/javascript'>window.location='prospect_view.php';</script>";

}
else
{
?>
<!--<script type="text/javascript">
alert("Data uploaded successfully");
window.location='prospect_view.php';
</script>
-->
<?php
}
///print_r($data);
////print_r($data->formatRecords);
?>