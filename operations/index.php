<?php
session_start();
   if(isset($_SESSION['user']))
   header('location:redirection.php');    
       
               include("myclass/CheckLogin.class.php");
       
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
              // echo "hi";
              include("config.php"); 
       $login=new CheckLogin();
       if($login->Process($con))        
       {   //echo "hi1";die;
      header('location:redirection.php');
       }
       else
       {  // echo "hi2";
       include("form/forms.php");
               ?>
              <!-- <link href="style.css" rel="stylesheet" type="text/css" />-->
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
<?php 
       }
      
?>