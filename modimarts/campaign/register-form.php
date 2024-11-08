<?php 
$register_names=$_POST['register_names'];
$from=$_POST['register_email'];
$register_number=$_POST['register_number'];
$register_ticket=$_POST['register_ticket'];

//echo json_encode($_POST);
//$to = "franapp.allmart@gmail.com";
//$to = "prabir.d06@gmail.com";
$to = "contact@allmart.world";
if ($from!='') {

         $subject = "Franchise Leads From Landing Page";
         $message = "<b>Details of the interested person.</b>";
         $message .= "<h1>Name :".$register_names."<br>Mobile Number : ".$register_number."<br>Area Pincode : ".$register_ticket."<br>Email : ".$from." </h1>";
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