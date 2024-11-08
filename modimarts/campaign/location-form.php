<?php 
$location_names=$_POST['location_names'];
$from=$_POST['location_email'];
$location_number=$_POST['location_number'];
$location_ticket=$_POST['location_ticket'];

//echo json_encode($_POST);
//$to = "franapp.allmart@gmail.com";
//$to = "Cc:prabir.d06@gmail.com";
//$to= "hellbinderkumar@gmail.com";
$to = "contact@allmart.world";
if ($from!='') {

          $subject = "Franchise Leads From Landing Page";
         $message = "<b>Details of the interested person.</b>";
         $message .= "<h1>Name :".$location_names."<br>Mobile Number : ".$location_number."<br>Area Pincode : ".$location_ticket."<br>Email : ".$from." </h1>";
         $header = "From:".$from." \r\n";
       //  $header .= "Cc:prabir.d06@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "1";
         }else {
            echo "2";
         }

}else{
    echo "3";
}  
 ?>