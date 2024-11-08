<?PHP
session_start();
include("config.php");
/*if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include("../config.php");
	
	function endsWithChar($needle, $haystack)
{
   return ($needle[strlen($needle) - 1] === $haystack);
}*/
?>
﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Lead</title>
   
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
 
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

<style>
    .container{
       width: 303px;
    padding-left: 0px;
    margin-right: 4px;
    padding-right: 34px; 
    }
  
</style>


<script type="text/javascript">
function load()
{
setTimeout("window.open(self.location, '_self');", 15000);
}

//================== This code for refresh every 10 second===============
  /*  setInterval(function(){
   //Call ajax here
   alert("hii")
   autoRun(); 
   
    },10000)*/
//=======================================================================    
 


</script>




</head>

<body onload="" class="theme-red">
<!--<body onload="autoRun();load();" class="theme-red">-->
    
<?php
$permission=$_SESSION['permission'];
$myString = $permission;
//echo $myString;
$myArray = explode(',', $myString);

foreach($myArray as $my_Array){
    //echo $my_Array.'<br>'; 
    
    if($my_Array==1){?>
    <script>$(function(){$("#1").show();$("#hdm1").show();});</script><?php } 
    
     if($my_Array==2) {?>
    <script>$(function(){$("#2").show();$("#hdm1").show();});</script><?php } 
    
      if($my_Array==3) {?>
    <script>$(function(){ $("#3").show();$("#hdm2").show();});</script><?php } 

     if($my_Array==4) {?>
    <script>$(function(){ $("#4").show();$("#hdm2").show();});</script><?php } 
        
   if($my_Array==5) {?>
    <script>$(function(){ $("#5").show();$("#hdm2").show();});</script> <?php }

    if($my_Array==6){ ?>
    <script> $(function(){  $("#6").show();$("#hdm3").show(); });</script> <?php } 
  
     if($my_Array==7){ ?>
    <script> $(function(){  $("#7").show();$("#hdm3").show(); });</script> <?php } 
  
    if($my_Array==8){ ?>
    <script> $(function(){  $("#8").show();$("#hdm3").show(); });</script> <?php } 
  
	
	if($my_Array==9){ ?>
    <script> $(function(){  $("#9").show();$("#hdm4").show(); });</script> <?php }
   if($my_Array==10){ ?>
    <script> $(function(){  $("#10").show();$("#hdm4").show(); });</script> <?php }	
	
	
	if($my_Array==11){ ?>
    <script> $(function(){  $("#11").show();$("#hdm5").show(); });</script> <?php }	
  
  if($my_Array==12){ ?>
    <script> $(function(){  $("#12").show();$("#hdm5").show(); });</script> <?php }
    ?>
   <?php 
    }

?>


    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING..." value="V1901200">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    
    
    
    <nav class="navbar">
        
        
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><span><img src="../Capture1.PNG"/ style="margin-top: -16px;"></span></a>
           
           
           
 
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="hdm1" style="display:none;">Lead Entry <span class="caret"></span></a>
        <ul class="dropdown-menu">
         <!-- <li><a href="../addsite.php">Add Site</a></li>-->
          <li><a id="1" style="display:none;" href="../lead_entry1.php" >Lead Entry</a></li>
          <li><a id="2" style="display:none;" href="../viewlead.php" >View Lead</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"  id="hdm2" style="display:none;color:#fff;">Users <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id=3 style="display:none;" href="../roll.php">Create roll</a></li>
          <li><a id=4 style="display:none;" href="../addusers.php">Add user</a></li>
          <li><a id=5 style="display:none;" href="../viewusers.php">View user</a></li>
        </ul>
      </li>
     
       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="hdm3" style="display:none;color:#fff;">Employee<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a  id="6" style="display:none;" href="../salesassociate.php">Add Employee</a></li>
         <li><a  id="7" style="display:none;" href="../viewsalesassociate.php">View Employee</a></li>
          <li><a  id="8" style="" href="../excelsales.php">bulk upload Employee</a></li>
          
                  
        </ul>
      </li>
     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="hdm4" style="display:none;color:#fff;">Lead Update<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a id="9" style="display:none;" href="../leadupdatebysales.php">Update Lead</a></li>
          <li><a id="10" style="display:none;" href="../viewleadupdate.php">View Update</a></li>
        </ul>
      </li>
      
       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="hdm5" style="display:none;color:#fff;">Lead Sources<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a id="11" style="display:none;" href="../leadsource.php">Add Lead source</a></li>
          <li><a id="12" style="display:none;" href="../viewleadsource.php">View Lead source</a></li>
        </ul>
      </li>
      
      <li><a href="../logout.php">LogOut</a></li>
    </ul>
 
  
           
            </div>
            
            
            
            
            
            
            
            
        </div>
    </nav>
