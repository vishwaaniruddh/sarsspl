<?php 
$contact_names=$_POST['contact_names'];
$from=$_POST['contact_email'];
$contact_number=$_POST['contact_phone'];
$contact_ticket=$_POST['contact_ticket'];
$contact_message=$_POST['contact_message'];

//echo json_encode($_POST);
$to = "contact@allmart.world";
//$to = "prabir.d06@gmail.com";
//$to = "hellbinderkumar@gmail.com";
if ($from!='') {

         $subject = "Franchise Leads From Landing Page";
         $message = "<b>Details of the interested person.</b>";
         $message .= "<h1>Name :".$contact_names."<br>Mobile Number : ".$contact_number."<br>Area Pincode : ".$contact_ticket."<br>Email : ".$from." <br>Message : ".$contact_message."</h1>";
         $header = "From:".$from." \r\n";
        // $header .= "Cc:prabir.d06@gmail.com \r\n";
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