<?php
include('config.php');


       //$id=$_GET['std'];
      // echo $id;
       $sub=$_POST['sub'];
       //echo $sud;

     $out="";   
       if($sub!=''){
       $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($sub)");
       
//  echo "SELECT id,name FROM `project_catT` where under in($sub)";
                      
	  $out=$out."<select name='topic[]' id='topic' multiple>";
                      
                      
                    while($row=mysqli_fetch_row($sqlm)){
                   

                       /* if(strtoupper($row[2])==strtoupper($city)){ */
                    
             $out=$out." <option value='$row[0]' selected>$row[1]</option>"; 
                      /*  }
                        else{
                            $out=$out." <option value='$row[1]'>$row[2]</option>";
                            
                        }*/
			   } 
             $out=$out." </select>";
       }
echo $out;  
mysqli_close($con);
?>