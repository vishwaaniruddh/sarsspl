<?php
session_Start();?>
<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    	
	}
	
// 	var_dump($ab);
// 	echo '<br>';echo '<br>';
	
   $exclError='2';
    $exclreason='';
    $exclreason2='';

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
    }else{
        $LastNamecount="0";
    }
}else{
    $LastNamecount="0";
}    


if($ab[7]!=""){
        if(strlen($ab[7])=="10"){
            $MobileNotValid="0";
        }
        else{
             $MobileNotValid="1";
        }
     }

if($ab[7]!=""){

    if($ab[6]!=""){
      

      $checkMobile=mysqli_query($conn,"select Lead_id from Leads_table where MobileNumber='".$ab[7]."' and MobileCode='".$ab[6]."' and  MobileNumber!=''");
  	if($checkMobile){
	    $Mobilecount=mysqli_num_rows($checkMobile);
	}else{
	    $Mobilecount="0";
	}
  
  
    }else{

	$checkMobile=mysqli_query($conn,"select Lead_id,MobileNumber from Leads_table where MobileNumber='".$ab[7]."'  and  MobileNumber!='' ");
    	if($checkMobile){
    	    $fetchMobileNm= mysqli_fetch_array($checkMobile); 
    	    if($fetchFirstNm['FirstName']==$ab[2] && $fetchLastNm['LastName']==$ab[3] && $fetchMobileNm['MobileNumber']==$ab[7]){
    	    
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

    if($Mobilecount>0){
       
       $exclreason2="Mobile No. Exist";
       $exclError='1';
       $Senpense='3';
    }
    
    
    if($ab[7]==""){
      
       $exclError='1';
       $exclreason2="Mobile No. Empty";
       $Senpense='3';
    }
    
    if($MobileNotValid>0){
       
       $exclreason2="Mobile No. Not Valid";
       $exclError='1';
       $Senpense='3';
    }
    
  $exclreason=$exclreason2 ;

  $hotelname='1';
$LeadSource=$_POST['LeadSource'];
$SalesAsso=$_POST['Sales'];
	 date_default_timezone_set('Asia/Kolkata');
    $dates = date('Y-m-d H:i:s');
    
$fistname=mysqli_real_escape_string($conn, $ab[2]);
$lsname=mysqli_real_escape_string($conn, $ab[3]);

 if($Senpense!="3"){

	 $result= "insert into Leads_table(Title,FirstName,LastName,MobileCode,MobileNumber,status,Creation,LeadSource,leadEntryef,EmailId) values('".$ab[1]."','".$fistname."','".$lsname."','".$ab[6]."','".$ab[7]."',1,'".$dates."','".$LeadSource."','".$_SESSION['id']."','".$ab[5]."')";
	 
// 	 contact1Code,ContactNo1,contact2Code,ContactNo2,Company,Designation,EmailId,Status,leadEntryef,Hotel_Name,Excel,ExcelReason,LeadSource,City,PinCode,Country,Nationality,State,Creation) values('".$ab[1]."','".$fistname."','".$lsname."','".$ab[6]."','".$ab[7]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$Senpense."','".$_SESSION['id']."','".$hotelname."','".$exclError."','".$exclreason."','".$LeadSource."','".$ab[13]."','".$ab[14]."','India','Indian','1','".$dates."')";

}else if($Senpense=="3"){
     $result= "insert into Leads_tableSuspend(Title,FirstName,LastName,MobileCode,MobileNumber,status,Creation,LeadSource,leadEntryef,EmailId) values('".$ab[1]."','".$fistname."','".$lsname."','".$ab[6]."','".$ab[7]."',1,'".$dates."','".$LeadSource."','".$_SESSION['id']."','".$ab[5]."')";

    //  contact1Code,ContactNo1,contact2Code,ContactNo2,Company,Designation,EmailId,Status,leadEntryef,Hotel_Name,Excel,ExcelReason,LeadSource,City,PinCode,Country,Nationality,State,Creation,delegatedSalesmanID) values('".$ab[1]."','".$fistname."','".$lsname."','".$ab[7]."','".$ab[8]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$Senpense."','".$_SESSION['id']."','".$hotelname."','".$exclError."','".$exclreason."','".$LeadSource."','".$ab[13]."','".$ab[14]."','India','Indian','1','".$dates."','".$SalesAsso."')";
}

	 $runresult=mysqli_query($conn,$result);
	
	 $Lid=mysqli_insert_id($conn);
	
	 //$atmid=mysqli_insert_id($conn);
	 //echo $atmid;
	 

	 if($runresult && $SalesAsso!=""){
	  $sql="insert into LeadDelegation(LeadId,SalesmanId,DelegatedTIme) values('".$Lid."','".$SalesAsso."','".$dates."')";
  
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
})
.then((willDelete) => {
  if (willDelete) {
 
    window.open("prospect_view.php","_self");
    
  } 
});
     
		     
		     
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