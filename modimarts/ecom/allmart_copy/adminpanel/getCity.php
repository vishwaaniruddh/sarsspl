<?php
include('config.php');


       $id=$_GET['id'];
      // echo $id;
       $city=$_GET['city'];
       
       $sqlm=mysql_query("select * from states where state_name='$id'");
$rowm=mysql_fetch_row($sqlm);
       
       $qry="SELECT * FROM `cities` WHERE `state_code`='".$rowm[0]."'";
       
       $res=mysql_query($qry);                
                       
       // echo $city;
        $out="";                
	  $out=$out."<select name='city' id='city' class='form-control' class='styledselect_form_1' required='required'>
                      <option value=''>select City</option>";
                    while($row=mysql_fetch_row($res)){
                        if(strtoupper($row[2])==strtoupper($city)){
                    
             $out=$out." <option value='$row[1]' selected>$row[2]</option>";
                        }
                        else{
                            $out=$out." <option value='$row[1]'>$row[2]</option>";
                            
                        }
			   } 
             $out=$out." </select>";
echo $out;  
?>