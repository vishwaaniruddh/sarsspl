<?php include('config.php'); ?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
 <body>
 <?php
if (!is_dir("logos/")) {
    @mkdir("logos/");
}
$Latitude="";
$Longitude="";

$adhar=mysqli_real_escape_string($con1,$_POST['adhar']);
$pan=mysqli_real_escape_string($con1,$_POST['pan']);
//$Establishment=mysqli_real_escape_string($con1,$_POST['Establishment']);
$cname=mysqli_real_escape_string($con1,$_POST['cname']);
// $Ldesignation=mysqli_real_escape_string($con1,$_POST['Ldesignation']);
// $Registn=mysqli_real_escape_string($con1,$_POST['Registn']);
// $cin=mysqli_real_escape_string($con1,$_POST['cin']);
$gumastaNo=mysqli_real_escape_string($con1,$_POST['gumastaNo']);
$busiAadhar=mysqli_real_escape_string($con1,$_POST['busiAadhar']);
$comnyPan=mysqli_real_escape_string($con1,$_POST['comnyPan']);
$tanno=mysqli_real_escape_string($con1,$_POST['tanno']);
//$Establishment=mysqli_real_escape_string($con1,$con1,$_POST['Establishment']);

//=========================== bank details  ================================

$bknm=mysqli_real_escape_string($con1,$_POST['bknm']);
$ifscode=mysqli_real_escape_string($con1,$_POST['ifscode']);
$actno=mysqli_real_escape_string($con1,$_POST['actno']);
$acholnm=mysqli_real_escape_string($con1,$_POST['acholnm']);
$brchnm=mysqli_real_escape_string($con1,$_POST['brchnm']);
// Ruchi
$wing=mysqli_real_escape_string($con1,$_POST['wing']);
$flat=mysqli_real_escape_string($con1,$_POST['flat']);
$bldg=mysqli_real_escape_string($con1,$_POST['BuildingName']);
$road_no=mysqli_real_escape_string($con1,$_POST['RoadNo']);
$locality=mysqli_real_escape_string($con1,$_POST['Locality']);
$landmark=mysqli_real_escape_string($con1,$_POST['landMark']);
//============ =============================================

$vat=mysqli_real_escape_string($con1,$_POST['vat']);

$state=mysqli_real_escape_string($con1,$_POST['state']);

$city=mysqli_real_escape_string($con1,$_POST['city']);

$area=mysqli_real_escape_string($con1,$_POST['area']);

// $add2=mysqli_real_escape_string($con1,$_POST['add2']);

$Pincode=mysqli_real_escape_string($con1,$_POST['Pincode']);

$phone=mysqli_real_escape_string($con1,$_POST['phone']);

// $fax=mysqli_real_escape_string($con1,$_POST['fax']);

$email=mysqli_real_escape_string($con1,$_POST['email']);

$contact=mysqli_real_escape_string($con1,$_POST['contactPerson']);
//echo $contact;
$mobile=mysqli_real_escape_string($con1,$_POST['mobile']);

$cat=$_POST['cat'];

$ar =  explode(',', $cat);
$data =array();

foreach ($ar as $item) {
    $underName=$item;
    $under=  mysqli_query($con1,"SELECT name FROM `main_cat` WHERE id ='$underName' ");
    $underRow = mysqli_fetch_array($under);
    $data[]=$underRow[0];
}
$catn=implode(",",$data);

$companytyp=$_POST['ctyp'];

// $emp=mysqli_real_escape_string($con1,$_POST['emp']);

$memtype=mysqli_real_escape_string($con1,$_POST['memtype']);

//$logo=$_POST['logo'];

$lic=mysqli_real_escape_string($con1,$_POST['lic']);

// $fees=mysqli_real_escape_string($con1,$_POST['fees']);

//$yoe=mysqli_real_escape_string($con1,$_POST['yoe']);

$app=mysqli_real_escape_string($con1,$_POST['app']);

$mop=mysqli_real_escape_string($con1,$_POST['mop']);
$pancard=$_POST['pancard'];
$Pname=$_POST['Pname'];
$Aadharcard=$_POST['Aadharcard'];


$introducer_id=$_POST['introducer_id'];
$free_introducer_id=$_POST['free_introducer_id'];

if(count($pancard)>0)
{  
    $pancardno=implode(',',$pancard);
}
if(count($Pname)>0)
{
    $Pnameno=implode(',',$Pname);
}
if(count($Aadharcard)>0)
{
    $Aadharcardno=implode(',',$Aadharcard);
}

$rdate=$_POST['rdate'];

$xdate=str_replace("/","-",$rdate);

$tdate=date('Y-m-d', strtotime($xdate));

$str="";

if($mop=="chq")

$pay=$_POST['pay'];

else

$pay="na";

$target='';

if(basename( $_FILES['logo']['name']) ) 
{
    $frext=$_FILES['logo']['name'];
    $ext2=explode(".", $frext);//gets extension
    
    $ext=strtolower(end($ext2));
    $allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "GIF", "PJPEG", "PNG", "bmp","BMP");
    
    if ((($_FILES["logo"]["type"] == "image/gif")
    || ($_FILES["logo"]["type"] == "image/jpeg")
    || ($_FILES["logo"]["type"] == "image/png")
    || ($_FILES["logo"]["type"] == "image/pjpeg")
    || ($_FILES["logo"]["type"] == "image/JPG")
    || ($_FILES["logo"]["type"] == "image/GIF")
    || ($_FILES["logo"]["type"] == "image/JPEG")
    || ($_FILES["logo"]["type"] == "image/PNG")
    || ($_FILES["logo"]["type"] == "image/bmp")
    || ($_FILES["logo"]["type"] == "image/BMP"))
    && ($_FILES["logo"]["size"] < 60000000)
    && in_array($ext, $allowedExts))
    {
        if ($_FILES["logo"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["logo"]["error"] . "<br />";
        }
    	else
        {
    	    $target1 = time().".".$ext; 
    	
            $target = "logos/".$target1;
            $maintarget ="logos/".$target1;
            
            if(move_uploaded_file($_FILES['logo']['tmp_name'], $maintarget)) 
            {
                
            }
            else
            echo "Failed to move file";
        }
    }
}   
    
 $ok=1; 

$fdt=date("Y/m/d");

$stater=mysqli_query($con1,"select state_code from states where state_name='".$state."'");
$staterows=mysqli_fetch_row($stater);

//Ruchi : 5 aug 19
    $qry="insert into clients(`name`,`city`,`state`,`pincode`,`cid`,`category`,`phone`,`email`,`contact`,`mobile`,`memtype`,`logo`,`rdate`,`till_date`,vat, `adhar_no`, `pan_no`, partnerpancatd,partnerName,partnerAadhar,companytyp,subscribe,Gumasta,BusiAadharNo,CompanyPancard,Tanno,wing,flat_no,bldg_name,locality,landmark,road_no,introducer_id,free_introducer_id) 
    
    values('$cname','$city','".mysqli_real_escape_string($staterows[0])."','$Pincode','$cat','$catn','$phone','$email','$contact','$mobile','$memtype','$target','$fdt','$tdate','$vat','$adhar','$pan','$pancardno','$Pnameno','$Aadharcardno','$companytyp','deactive','$gumastaNo','$busiAadhar','$comnyPan','$tanno','$wing','$flat','$bldg','$locality','$landmark','$road_no','$introducer_id','$free_introducer_id')";
	$res=mysqli_query($con1,$qry);
	
	echo $qry;
	
    $code=$con1->insert_id;
    
    $_SESSION['code']=$code;
			  
	$qrybnk="insert into Bank_Details(Merchant_id,BankName,BranchName,IFScode,AccountNumber,AC_HoldersName)values('$code','$bknm','$brchnm','$ifscode','$actno','$acholnm')";	

	$resbnk=mysqli_query($con1,$qrybnk);

    $ct=count($subcat);

for($i=0;$i<$ct;$i++)

{  
    mysqli_query($con1,"insert into client_cat values('".$code."','".$subcat[$i]."')");
}

mysqli_query($con1,"insert into accounts values('".$code."','".$app."','".$mop."','".$pay."')");

if($res){
   

} else
//echo "Data not Saved ";          
// echo '<script>swal("Data not Saved")</script>';

?>
<?php
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
  $string=random_string(6);
  
       $email = strip_tags($email);
//echo $email;
$to= $email;
$subject="Your login id and password Allmart";
$headers = "From: <mail@example.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 $message="Your User Name is ".$email."<br/> Your Password is : ".$string;

/*$message = "
<html>
<head>
<title>Your email passwordl</title>
</head>
<body>
<p>Your allmart login credentials are : </p>
<table>
<tr>
<th>Email:</th>
<th>'".$email."'</th>
</tr>
<tr>
<td>Password:</td>
<td>'".$string."'</td>
</tr>
</table>
</body>
</html>
";
*/
mail($to, $subject, $message, $headers);

$insqr=mysqli_query($con1,"insert into users(`id`, `password`, `department`, `cid`) values('".$email."','".$string."','users','".$code."')");
//echo "insert into users(`id`, `password`, `department`, `cid`) values('".$email."','".$string."','users','".$code."')";
if(!$insqr)
{
    echo mysqli_error($con1);
}
$pth="userfiles/".$code."/img/";

if (!file_exists($pth)) {
    mkdir($pth, 0755, true);
}
?>
<br/><br/>
<div id="message-yellow">
	<table border="0" width="100%" cellpadding="0" cellspacing="0"> 
    	<tr>
    	</tr>
	</table>
</div>
	
<!-- The Modal -->
<div  id="myModal" class="modal" style="left: 450px">
  <!-- Modal content -->
  <div class="modal-content" style="width:45%">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h4>Product Subscription </h4>
    </div>
    <div class="modal-body">
        <table class="table table-bordered" style="width:100%" >
            <thead class="thead-dark">
                <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">1 Month Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                    </td>
                    <td>
                        <input type="button" class="btn-warning modal-css"  value="1 month" onclick="subsmonth('1','1000');"/>
                    </td>
                </tr>
                </thead>
                 <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">3 Month Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                         </td>
                    <td>
                        <input type="button" class="btn-warning modal-css" value="3 month" onclick="subsmonth('3','3000');"/>
                  </td>
                 </tr>                 
                 <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">6 Month Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                    </td>
                    <td>
                        <input type="button" class="btn-warning modal-css" value="6 month" onclick="subsmonth('6','6000');"/>
                   </td>
                </tr>            
                 <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">1 Year Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                    </td>
                    <td>
                        <input type="button" class="btn-warning modal-css" value="12 month"  onclick="subsmonth('12','12000');"/>
                    </td>
                </tr>
            </table>
		</div>   
	</div>
</div>
<script>
    /*function subscribe(){
	    var r = confirm("Choose subscription package");
    	if(r == true){
    	  subscribe_modal();
    	   return false;
    	 } else {
    	     window.open("index.php");
    	 }
    }*/
    /*function subscribe_modal(){        
	// Get the modal
	var modal = document.getElementById('myModal');
	// Get the button that opens the modal
	var btn = document.getElementById("submit1");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	// When the user clicks the button, open the modal 

	modal.style.display = "block";
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}
	    // When the user clicks anywhere outside of the modal, close it
    }*/

/*function subsmonth(m,rs)
{ 
	var month=m;
	var price=rs;
	//var mid=document.getElementById("ccode").value;
	var mid=<?php echo $code;?>;
	window.open('subscriptionRecipt.php?mo='+month+'&pr='+price+'&mid='+mid , "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}*/
</script>
<?php 
   if($qry && $insqr)
   {
       $sts="1";
    //   echo '<script type="text/javascript"> subscribe(); </script>';
    
    ?>
    <script>
        alert('Registration completed successfully!');
	    window.open('index.php','_self');
    </script>
       
  <?php }
   else{
    $sts="2";?>
	<script>
	    window.open('Sell.php?sts=<?php echo $sts;?>','_self');
    </script>
<?php } ?>
    
</body>
</html>