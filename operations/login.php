<?php  include("myclass/CheckLogin.class.php");
       include("form/forms.php");
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               echo "hi";
       $login=new CheckLogin();
       if($login->Process())        
       {
       
       if($_SESSION['designation']=='2'){ header("location: view_callalert.php");  }
	  else if($_SESSION['designation']=='4'){ header("location: eng_alert.php");  }
       else header("location: view_alert.php"); 
       }
       else
       {
               ?>
<link href="style.css" rel="stylesheet" type="text/css" />               
        <center>
<h2>Please Login to Continue..</h2>
<div id="header">
       <?php
               $login->ShowErrors();
LoginForm();
?>
</div></center>
<?php
       }
       }
       else
       {
?>
        <center>
<h2>Please Login to Continue..</h2>
<div id="header">
       <?php
LoginForm();
?>
</div></center>
<?php        }
       /*}
       else
       {
               if($_SESSION['designation']=="Engineer") { header("location: eng_alert.php"); }
else if($_SESSION['designation']=="call_centre") { header("location: view_callalert.php"); }
else{ header("location: view_alert.php"); }
       }*/
?>