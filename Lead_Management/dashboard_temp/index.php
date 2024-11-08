<?PHP
session_start();
include("../config.php");
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
    
    if($my_Array==15) {?>
    <script>$(function(){ $("#15").show();$("#hdm1").show();});</script> <?php }
    
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
    
    if($my_Array==13){ ?>
    <script> $(function(){  $("#13").show();$("#hdm6").show(); });</script> <?php }	
  
  if($my_Array==14){ ?>
    <script> $(function(){  $("#14").show();$("#hdm6").show(); });</script> <?php }
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
  
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    
    
    
    <nav class="navbar">
        
        
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><span><img src="../Capture1.PNG"/ width="100px" height="40px"style="margin-top: -20px;"></span></a>
           
           
           
 
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="hdm1" style="display:none;">Lead Entry <span class="caret"></span></a>
        <ul class="dropdown-menu">
         <!-- <li><a href="../addsite.php">Add Site</a></li>-->
          <li><a id="1" style="display:none;" href="../lead_entry1.php" >Lead Entry</a></li>
          <li><a id="2" style="display:none;" href="../viewlead.php" >View Lead</a></li>
           <li><a id=15 style="display:none;" href="../excellead.php">bulk upload lead</a></li>
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
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="hdm6" style="display:none;color:#fff;">Location<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a id="13" style="display:none;" href="../location.php">Add Location</a></li>
          <li><a id="14" style="display:none;" href="../viewlocation.php">View Location</a></li>
        </ul>
      </li>
      
      <li><a href="../logout.php">LogOut</a></li>
    </ul>
 
  
           
            </div>
            
            
            
            
            
            
            
            
        </div>
    </nav>
    <!-- #Top Bar -->
<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <!--  <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
              <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hitachi</div>
                    <div class="email">hitachi@comforttechno.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../index.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>-->
            <!-- #User Info -->
            <!-- Menu -->
            
            
            <style>
            div.ex1 {
    background-color: white;
    height: 80%;
    width: 100%;
    overflow-y: scroll;
}
</style>            
               <div class="ex1">
                    <div class="card">
                        <div class="header">
                            <h2>Status</h2>
                            <!--<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>-->
                        </div>
                        
         <div class="body" >
     
        
        
        
        
     <?php
      
      
/*  
$query=mysqli_query($conn,"select max(Last_id) from setTimeOutID ");
$fetchID=mysqli_fetch_row($query);



$query2=mysqli_query($conn,"select max(id) from alerts where id > '".$fetchID[0]."' ");
$fetchID2=mysqli_fetch_array($query2);

if($fetchID2[0]!=""){
mysqli_query($conn,"insert into setTimeOutID values('".$fetchID2[0]."') ");
}

if($fetchID2[0]=="")
{
    $query= mysqli_query($conn,"SELECT Last_id FROM setTimeOutID ORDER BY Last_id DESC LIMIT 1,1");
    $fetchID=mysqli_fetch_array($query);
   
}



$query1=mysqli_query($conn,"select zone,panelid,createtime,alarm from alerts where id > '".$fetchID[0]."' and panelid='080241'  limit 20 ");
//echo "select zone,panelid,createtime,alarm from alerts where id > '".$fetchID[0]."' and alarm!='OA' and zone NOT IN ('013','014','018','019')  limit 20  ";
$data=array();
while($fetchID1=mysqli_fetch_array($query1)){
    
//$querysensorname=mysqli_query($conn,"select Descriptor,ZoneNo from alarms where ZoneNo = '".$fetchID1[0]."'  ");
$querysensorname=mysqli_query($conn,"select SensorName,ZONE,SCODE from rass where ZONE = '".$fetchID1[0]."'  ");
//echo "select SensorName,ZONE from rass where ZONE = '".$fetchID1[0]."'  ";
$fetc_querysensorname=mysqli_fetch_array($querysensorname);




$queryAtm=mysqli_query($conn,"SELECT ATMID FROM `sites` WHERE `NewPanelID` LIKE '".$fetchID1[1]."'  ");
$fetch_Atm=mysqli_fetch_array($queryAtm);

if(endsWithChar('R',$fetchID1[3])){
   $Status="Close"; 
}
else {
   $Status="Open"; 
}
*/
//================================ teporary================
/*$querysensorname=mysqli_query($conn,"SELECT * from rass_sensor ORDER BY id DESC LIMIT 1");
$fetc_querysensorname=mysqli_fetch_array($querysensorname);
 
 for($i=0;$i<36;$i++){
  if($fetc_querysensorname[$i]=="1"){
   $data[]=$fetc_querysensorname[$i];
   $message = $fetc_querysensorname[$i];
echo "<script type='text/javascript'>alert('$message');</script>";
   
 
  }
}
$id=implode(",",$data);
echo $id;
*/
//================================ teporary================

/*
   if($fetc_querysensorname[0]!=""){
       
       
if($fetc_querysensorname['ZONE']=='003' && $fetc_querysensorname['SCODE']=='PA'){ $fetc_querysendata= "Panic Switch"; } 
else if($fetc_querysensorname['ZONE']=='003' && $fetc_querysensorname['SCODE']=='OA'){ $fetc_querysendata=  "System Disarmed by User 03"; }
else if($fetc_querysensorname['ZONE']=='001' && $fetc_querysensorname['SCODE']=='CL'){ $fetc_querysendata=  "System Armed"; }
else if($fetc_querysensorname['ZONE']=='001' && $fetc_querysensorname['SCODE']=='JP'){ $fetc_querysendata=  "Lobby PIR Motion sensor"; }
else if($fetc_querysensorname['ZONE']=='001' && $fetc_querysensorname['SCODE']=='OA'){ $fetc_querysendata=  "System Disarmed by User 01"; }
else if($fetc_querysensorname['ZONE']=='002' && $fetc_querysensorname['SCODE']=='BA'){ $fetc_querysendata=  "Glass Break Sensor"; }
else if($fetc_querysensorname['ZONE']=='002' && $fetc_querysensorname['SCODE']=='OA'){ $fetc_querysendata=  "System Disarmed by User 02"; }
else if($fetc_querysensorname['ZONE']=='004' && $fetc_querysensorname['SCODE']=='BA'){ $fetc_querysendata=  "Main Door shutter Normally NO type"; }
else if($fetc_querysensorname['ZONE']=='004' && $fetc_querysensorname['SCODE']=='OA'){ $fetc_querysendata=  "System Disarmed by User 04"; }




else{   $fetc_querysendata= $fetc_querysensorname[0]; }
    
    
       
   ?>
   <div style="background-color:red;color:white;padding-left:10px;padding-right:12px;font-size:10px;" >
  <a href="../livestream.html" style="text-decoration:none;color:white;" > <? echo " ATM-ID:- ".$fetch_Atm[0]  ." <br />". $fetchID1[2]."<br />  Zone :- ". $fetc_querysensorname[1]."<br /> ".  $fetc_querysendata ."<br /> Status:- ".$Status  ;?></a><hr />
   </div>
<?   
}  


}*/


//$id=implode(",",$data);
//echo $id."<br />";

    
?> 

                        </div>
                    </div>
             </div>
            
            
            
            
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 - 2018 <a href="javascript:void(0);">Lead Management</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2 align="center">DASHBOARD</h2>
            </div>

<!--=========================== TOTAL COUNT QUERY =========================-->


 <?php 
    // $queryalert= mysqli_query($conn,"SELECT COUNT(id) FROM alerts where  alarm!='OA' and zone NOT IN('013','014','018','019')");
      /* $queryalert= mysqli_query($conn,"SELECT COUNT(id) FROM alerts where panelid='080241'");
       $fetchAlert=mysqli_fetch_row($queryalert);
      
      $querysite= mysqli_query($conn,"SELECT COUNT(SN) FROM sites where Customer='UBI';");
      $fetchSite=mysqli_fetch_row($querysite);
      
      date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
$cminuts=date('Y-m-d H');
$prevdt=date("Y-m-d H:i:s", strtotime("-1 hours"));
$abc="select * from temperature where tdatetime between '".$prevdt."' and '".$dates."'";
$runabc=mysqli_query($conn,$abc);*/
 // echo $abc;
/*$abc2="select * from temperature order by record_no desc limit 1";
$runabc2=mysqli_query($conn,$abc2);  
$runabc2fetch=mysqli_fetch_array($runabc2);*/
//if($runabc2fetch[0]=='')

$sql="select Lead_id from Leads_table";
$runsql=mysqli_query($conn,$sql);
$myrow=mysqli_num_rows($runsql);

$emp="select SalesmanId from SalesAssociate";
$runemp=mysqli_query($conn,$emp);
$emprow=mysqli_num_rows($runemp);

$user="select UserId from Users";
$runuser=mysqli_query($conn,$user);
$userrow=mysqli_num_rows($runuser);
      ?>





<!--=======================================================================-->
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-left:12%">
                   
                   <a href="../viewlead.php" style="color:white; text-decoration: none;" >
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL LEADS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $myrow;?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    
                    <a href="../viewsalesassociate.php" style="color:white;text-decoration: none;" >
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL EMPLOYEE</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $emprow;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    
                    <a href="../viewuser.php" style="color:white;text-decoration: none;" >
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL USERS</div>
                       <div class="number count-to" data-from="0" data-to="<?php echo $userrow;?>" data-speed="1000" data-fresh-interval="20"></div>

                           <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>-->
                        </div>
                    </div>
                    </a>
                    
                </div>
              
            </div>
            <!-- #END# Widgets -->
          
            
            
            
            
<!--            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9" >
                    <div class="card" style="background-color:#FFA500;margin-left:35%"> 
                        <div class="header">
                            <h2 id="shw">Action</h2>
                           <input type="text" placeholder="NMUM9001">
                        </div>
                               
                       <div class="">
                          <style>
                              #bu{
                                    width: 39%;
                                     margin-left: 2%;
                                   
                              }
                              #bu:hover {
                                          background-color: yellow;
                                        }
                              h6{
                                 height: 10px;
                                 }
                          </style>
                          
                           <table width="100%" style="">
                            <style>  #bu:hover {
                                          background-color: yellow;
                                        }
                              
                          </style>
<tr><td><input type="button" onclick="soundOn('soundon')" value="SOUND ON" id="bu" style="background-color: red;color:white"/>&nbsp;<input type="button" onclick="soundOff('soundoff')" value="SOUND OFF"  style="width:189px;background-color: red;color:white"/></td>  <td><h6 id="shw0"></h6></td>  </tr>

<tr><td><input type="button" onclick="soundOn('ac1on')" value="AC1 ON"  id="bu" style="background-color: #00bcd4;color:white"/>&nbsp;<input type="button"  onclick="soundOff('ac1off')" value="AC1 OFF" style="width:189px;background-color: #00bcd4;color:white"/></td> <td><h6 id="shw1"></h6></td></tr>
<tr><td><input type="button" onclick="soundOn('ac2on')" value="AC2 ON" id="bu" style="background-color: #96000e;color:white"/>&nbsp;<input type="button" onclick="soundOff('ac2off')" value="AC2 OFF" style="width:189px;background-color: #96000e;color:white"/></td> <td><h6 id="shw2"></h6></td></tr>
<tr><td><input type="button" onclick="soundOn('ATMon')" value="ATM ON"  id="bu" style="background-color: #00bcd4;color:white"/>&nbsp;<input type="button"  onclick="soundOff('ATMoff')" value="ATM OFF" style="width:189px;background-color: #00bcd4;color:white"/></td> <td><h6 id="shw3"></h6></td></tr>
<tr><td><input type="button" onclick="soundOn('LIGHTon')" value="LIGHT ON" id="bu" style="background-color: #002e96;color:white"/>&nbsp;<input type="button" onclick="soundOff('LIGHToff')" value="LIGHT OFF" style="width:189px;background-color: #002e96;color:white"/></td> <td ><h6 id="shw4"></h6></td></tr>

<tr><td><input type="button" onclick="soundOn('SHUTTER OPEN')" value="SHUTTER OPEN" id="bu" style="background-color: #1334d8;color:white"/>&nbsp;<input type="button" onclick="soundOff('SHUTTER CLOSE')" value="SHUTTER CLOSE" style="width:189px;background-color: red;color:white"/></td> <td><h6 id="shw5"></h6></td></tr>
<tr><td><input type="button" onclick="soundOff('SHUTTER STOP')" value="SHUTTER STOP" id="bu" style="width:275px;background-color: #00bcd4;color:white"/></td></tr>
</table>

                        </div>
                    </div>
                </div>
                
                
               <style> 
                div.ex2 {
    background-color: lightblue;
    height: 30%;
    width: 100%;
    overflow-y: scroll;
}</style>
               -->
               
               
               
               <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="ex2">
                    <div class="card">
                        <div class="header">
                            <h2>Live Alerts</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                             
      <?php

/*
$query=mysqli_query($conn,"select max(Last_id) from setTimeOutID ");
$fetchID=mysqli_fetch_row($query);

//echo $fetchID[0];

$query2=mysqli_query($conn,"select max(id) from alerts where id > '".$fetchID[0]."' ");
$fetchID2=mysqli_fetch_array($query2);

if($fetchID2[0]!=""){
mysqli_query($conn,"insert into setTimeOutID values('".$fetchID2[0]."') ");
}

if($fetchID2[0]=="")
{
  $query= mysqli_query($conn,"SELECT Last_id FROM setTimeOutID ORDER BY Last_id DESC LIMIT 1,1");
    $fetchID=mysqli_fetch_array($query);
}


$query1=mysqli_query($conn,"select zone,panelid,createtime,alarm from alerts where id > '".$fetchID[0]."' limit 2 ");
//echo "select zone from alerts where id > '".$fetchID[0]."' ";
$data=array();
while($fetchID1=mysqli_fetch_array($query1)){
    
$querysensorname=mysqli_query($conn,"select sensorname,zone from securico where zone = '".$fetchID1[0]."' ");
$fetc_querysensorname=mysqli_fetch_array($querysensorname);


$queryAtm=mysqli_query($conn,"SELECT ATMID FROM `sites` WHERE `NewPanelID` LIKE '".$fetchID1[1]."' ");
$fetch_Atm=mysqli_fetch_array($queryAtm);

if($fetchID1[3]=="BA"){
   $Status="OPEN"; 
}
else if($fetchID1[3]=="BR"){
   $Status="Close"; 
}


   if($fetc_querysensorname[0]!=""){*/
   ?>
   <div style="background-color:red;color:white;padding-left:10px;padding-right:10px" >
  <a href="../livestream.html" style="text-decoration:none;color:white;" ><? echo " ATM-ID:- ".$fetch_Atm[0]  ." <br />". $fetchID1[2]."<br />  Zone :- ". $fetc_querysensorname[1]."<br /> ".$fetc_querysensorname[0] ."<br /> Status:- ".$Status  ;?> </a><hr />
   </div>
<?   
//}}
//$id=implode(",",$data);
//echo $id."<br />";

?> 
                        </div>
                    </div>
                </div></div>-->
                <!-- #END# Browser Usage -->
            </div>
            
         
            
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
             

        </div>
        
        
        
        
        
        
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
<? /*}else{
header("location: ../index.php");

} */
?>