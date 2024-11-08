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
    <script>$(function(){$("#15").show();$("#hdm1").show();});</script><?php } 
    
      if($my_Array==3) {?>
    <script>$(function(){ $("#3").show();$("#hdm1").show();});</script><?php } 

     if($my_Array==4) {?>
    <script>$(function(){ $("#4").show();$("#hdm1").show();});</script><?php } 
        
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



<nav class="navbar navbar-inverse" style="margin-right: 0px;
    width: 1449px;
    border-right-width: 0px;
    border-left-width: 0px;
    margin-bottom: 0px;">
    
  <div class="container-fluid menu-color">
    
    <ul class="nav navbar-nav">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand bg-color-menu" href="index.php"><span><img src="manir.jpg"/  width="100px" height="40px"style="margin-top: -13px;"></span></a>
        <a class="navbar-brand bg-color-menu"  href="../dashboard_temp/index.php" >Home</a></li>
        <a class="navbar-brand bg-color-menu"  href="../member2.php" >Members</a></li>
        <?php if(isset($_SESSION) && $_SESSION['user_name']=='Admin'){ ?>
           <li><a class="navbar-brand bg-color-menu"  href="../viewmember.php" >View Members</a></li>
           <li> <a class="navbar-brand bg-color-menu"  href="./admin/change_password.php" >Change Password</a></li>
            <a class="navbar-brand bg-color-menu"  href="./admin/logout.php" style="align:right;margin-left: 30em;">Log Out</a></li>
    <?php } ?>
<!--      <a class="navbar-brand"  href="viewleadupdate.php" style="color:#fff";>HOME</a></li>
-->        <li class="dropdown"><a class="dropdown-toggle" id="hdm1" style="display:none;color:#fff;" data-toggle="dropdown" href="#">Member<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="1" style="display:none;" class="dropdown-item" href="../member2.php">Add Member</a></li>
            <li><a id="2" style="display:none;" class="dropdown-item" href="../viewmember.php">View Member</a></li>
            <li><a id="15" style="display:none;" class="dropdown-item" href="../Recipt.php">Donation</a></li>
            <li><a id="3" style="display:none;" class="dropdown-item" href="../ViewDonation.php">View Donation</a></li>
            
             <li><a id="4" style="display:none;" class="dropdown-item" href="Online_Donation.php">Payment</a></li>
        </ul>
      </li>
     
     <!--<li class="dropdown"><a class="dropdown-toggle" id="hdm2" style="display:none;color:#fff;" data-toggle="dropdown" href="#">User<span class="caret"></span></a>
        <ul class="dropdown-menu">
            
            <li><a id="4" style="display:none;" class="dropdown-item" href="user.php">Add User</a></li>
            <li><a id="5" style="display:none;" class="dropdown-item" href="viewuser.php">View User</a></li>
             
        </ul>
      </li>
      
      <li class="dropdown"><a class="dropdown-toggle" id="hdm3" style="display:none;color:#fff;" data-toggle="dropdown" href="#">Employee<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="6" style="display:none;" class="dropdown-item" href="salesassociate.php">Add Employee</a></li>
            <li><a id="7" style="display:none;" class="dropdown-item" href="viewsalesassociate.php">View Employee</a></li>
            <li><a id="8" style="display:none;" class="dropdown-item" href="excelsales.php">bulk upload Employee</a></li>
             
        </ul>
      </li>

<li class="dropdown"><a class="dropdown-toggle" id="hdm4" style="display:none;color:#fff;" data-toggle="dropdown" href="#">Lead Update<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="9" style="display:none;" class="dropdown-item" href="leadupdatebysales.php">Update Lead</a></li>
            <li><a id="10" style="display:none;" class="dropdown-item" href="viewleadupdate.php">View Update</a></li>
            
           
        </ul>
      </li>
      
     <li class="dropdown"><a class="dropdown-toggle" id="hdm5" style="display:none;color:#fff;" data-toggle="dropdown" href="#">Lead Sources<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="11" style="display:none;" class="dropdown-item" href="leadsource.php">Add Lead source</a></li>
            <li><a id="12" style="display:none;" class="dropdown-item" href="viewleadsource.php">View Lead source</a></li>
        </ul>
      </li>
      
      <li class="dropdown"><a class="dropdown-toggle" id="hdm6" style="display:none;color:#fff;" data-toggle="dropdown" href="#">Location<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="13" style="display:none;" class="dropdown-item" href="location.php">Add Location</a></li>
            <li><a id="14" style="display:none;" class="dropdown-item" href="viewlocation.php">View Location</a></li>
            <i class="fas fa-bars fa-1x"></i>
        </ul>
      </li>
    -->
    <!--<li class="dropdown"><a class="dropdown-toggle" id="hdm1" style="color:#fff;" data-toggle="dropdown" href="#">LogOut<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a style=" color:#fff;" href="logout.php">Log Out</a></li>
        </ul>
      </li>-->
       <?php /*if(isset($_SESSION) && $_SESSION['user_name']=='Admin'){ ?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="align:right;padding-left: 130px; color:#fff;">USer<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a  class="dropdown-item" href="./admin/change_password.php">Change Password</a></li>
            <li><a  class="dropdown-item" href="./admin/logout.php">Logout</a></li>
            
        </ul>
      </li>
      <?php } */ ?>
     <?php /*if(isset($_SESSION) && $_SESSION['user_name']=='Admin'){ ?>
     
     <li class="dropdown" > 
        <a style="align:right; color: rgb(255, 255, 255) !important;;" href="./admin/change_password.php">Change Password</a>
    </li>
    <li class="dropdown" > 
        <a style="align:right;padding-left: 130px;margin-left: 41em;padding-right: 0px; color:#fff;" href="./admin/logout.php">Log Out</a>
    </li>
    
    <?php }*/ ?>
    </ul>
  </div>
</nav>
  

