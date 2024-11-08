<?php
include('config.php');
$ip = $_SERVER['REMOTE_ADDR'];
$clientDetails = json_decode(file_get_contents("http://ipinfo.io/$ip/json"));
//$clientDetails->region;

       $id=$_GET['id'];
      // echo $id;
       $city=$_GET['city'];
       
       $sqlm=mysqli_query($con1,"select * from states where state_name='$id'");
       
$rowm=mysqli_fetch_row($sqlm);
       
       $qry="SELECT * FROM `cities` WHERE `state_code`='".$rowm[0]."'";
       
       $res=mysqli_query($con1,$qry);                
                       
       // echo $city;
        $out="";                
	  $out=$out."<select name='city' id='city' class='form-control' class='styledselect_form_1' required='required'>
                      <option value=''>select City</option>";
                        while($row=mysqli_fetch_row($res)){
                        if(strtoupper($row[2])==strtoupper($city) ||$row[2]==$clientDetails->city){
                        $out=$out." <option value='$row[1]' selected>$row[2]</option>";
                        }
                        else{
                                $out=$out." <option value='$row[1]'>$row[2]</option>";
                            }
			   } 
             $out=$out." </select>";
    echo $out;  
?>