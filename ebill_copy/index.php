<?php  //echo '1';die;
session_start();
if(isset($_SESSION['user']))
header("location: redirection.php");
       
 /*      if(!$_SESSION['user'] && !$_SESSION['branch'] && !$_SESSION['designation'])
       {*/
               include("myclass/CheckLogin.class.php");
       
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               //echo "hi";
       $login=new CheckLogin();
       if($login->Process())        
       {
       //echo "hi";
    header("location: redirection.php");
       }
       else
       {
       include("form/forms.php");
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
       include("form/forms.php");
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