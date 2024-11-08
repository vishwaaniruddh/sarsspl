<style>

@font-face { font-family: 'YatraOne-Regular'; src: url('YatraOne-Regular.ttf'); src: url('YatraOne-Regular.ttf') 
format('embedded-opentype'), url('YatraOne-Regular.ttf') format('woff'), url('YatraOne-Regular.ttf') format('truetype');
font-weight: normal; font-style: normal;}
body {
/*font-family: 'YatraOne-Regular', Arial, Helvetica, san-serif;*/
}
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f1f1f1}

th {
    background-color: #002a5f;
    color: white;
}
navbar-inverse {
background-color:#2980b9;
     }
</style>
<?php
$permission=$_SESSION['permission'];
$myString = $permission;

$myArray = explode(',', $myString);

foreach($myArray as $my_Array){
    //echo $my_Array.'<br>'; 
    
    if($my_Array==1){?>
    <script>$(function(){$("#1").show();$("#hdm1").show();});</script><?php } 
    
     if($my_Array==2) {?>
    <script>$(function(){$("#2").show();$("#hdm1").show();});</script><?php } 
    
      if($my_Array==3) {?>
    <script>$(function(){ $("#3").show();$("#hdm1").show();});</script><?php } 

     if($my_Array==4) {?>
    <script>$(function(){ $("#4").show();$("#hdm1").show();});</script><?php } 
        
   if($my_Array==5) {?>
    <script>$(function(){ $("#5").show();$("#hdm1").show();});</script> <?php }

    if($my_Array==6){ ?>
    <script> $(function(){  $("#6").show();$("#hdm1").show(); });</script> <?php } 
  
     if($my_Array==7){ ?>
    <script> $(function(){  $("#7").show();$("#hdm1").show(); });</script> <?php } 
  
  if($my_Array==8){ ?>
    <script> $(function(){  $("#8").show();$("#hdm1").show(); });</script> <?php }
    
    if($my_Array==9){ ?>
    <script> $(function(){  $("#9").show();$("#hdm2").show(); });</script> <?php }
    
    if($my_Array==10){ ?>
    <script> $(function(){  $("#10").show();$("#hdm2").show(); });</script> <?php }
    if($my_Array==11){ ?>
    <script> $(function(){  $("#11").show();$("#hdm2").show(); });</script> <?php }
    
    if($my_Array==12){ ?>
    <script> $(function(){  $("#12").show();$("#hdm2").show(); });</script> <?php }
    if($my_Array==13){ ?>
    <script> $(function(){  $("#13").show();$("#hdm3").show(); });</script> <?php }
    
    if($my_Array==14){ ?>
    <script> $(function(){  $("#14").show();$("#hdm3").show(); });</script> <?php }
    if($my_Array==15){ ?>
    <script> $(function(){  $("#15").show();$("#hdm4").show(); });</script> <?php }
    
    if($my_Array==16){ ?>
    <script> $(function(){  $("#16").show();$("#hdm4").show(); });</script> <?php }
    
    if($my_Array==17){ ?>
    <script> $(function(){  $("#17").show();$("#hdm5").show(); });</script> <?php }
    if($my_Array==18){ ?>
    <script> $(function(){  $("#18").show();$("#hdm5").show(); });</script> <?php }
    if($my_Array==19){ ?>
    <script> $(function(){  $("#19").show();$("#hdm5").show(); });</script> <?php }
    
    if($my_Array==20){ ?>
    <script> $(function(){  $("#20").show();$("#hdm2").show(); });</script> <?php }
    ?>
   <?php 
    }

?>


<!--<body style="background-color:#E0FDE0;" >-->
    
<nav class="navbar navbar-inverse" style="margin-right: 0px;

    border-right-width: 0px;
    border-left-width: 0px;
    margin-bottom: 0px;">
  <div class="container-fluid" style="background-color:#002a5f;">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CSS</a>
    </div>
    <ul class="nav navbar-nav">
        
      <li><a class="navbar-brand"  href="dashboard1.php">HOME</a></li>
      <!--<a class="navbar-brand" href="dashboard.php">DASH BOARD</a></li>
      <a class="navbar-brand" href="Inventory_out.php">STOCK OUT</a></li>-->
      <li class="dropdown"><a class="dropdown-toggle" id="hdm1" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"  >ADD<span class="caret" ></span></a>
        <ul class="dropdown-menu">
            <li><a id="1" style="display:none;" class="dropdown-item" href="addvendor.php">ADD VENDOR</a></li>
        <!--- <li><a id="2" style="display:none;" class="dropdown-item" href="company.php">ADD COMPANY</a></li>-->
            <li><a id="3" style="display:none;" class="dropdown-item" href="addmaterial.php">ADD MATERIAL</a></li>
            <li><a id="4" style="display:none;" class="dropdown-item" href="addteam.php">ADD Team</a></li>
         
            <li><a id="5" style="display:none;" class="dropdown-item" href="viewvendor.php">View Vendor</a></li> 
        <!-- <li><a id="6" style="display:none;" class="dropdown-item" href="viewcompany.php">View Company</a></li>-->
            <li><a id="7" style="display:none;" class="dropdown-item" href="viewmaterial.php">View Material</a></li> 
            <li><a id="8" style="display:none;" class="dropdown-item" href="dashboard1.php">new dash board</a></li>  
        
        </ul>
      </li>
      
      
      
        <li class="dropdown"><a class="dropdown-toggle" id="hdm2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  href="#">STOCK<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a id="9" style="display:none;" class="dropdown-item" href="inventory.php">Stock In</a></li>
              <!--  <li><a id="10" style="display:none;" class="dropdown-item" href="Inventory_out2.php">Stock Out</a></li>-->
              <li><a id="11" style="display:none;" class="dropdown-item" href="viewstock.php">View Stock In</a></li>
              <li><a id="20" style="display:none;" class="dropdown-item" href="bulk_inventory.php">Excel Stock In</a></li>
             
             
            </ul>
        </li>
      
       <li class="dropdown"><a class="dropdown-toggle" id="hdm3" data-toggle="dropdown" href="#">FAULTY MATERIAL<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="13" style="display:none;" class="dropdown-item" href="Faulty.php">Faulty Material</a></li>
            <li><a id="14" style="display:none;" class="dropdown-item" href="viewfaulty.php">Faulty View</a></li>
          
        </ul>
      </li>
      
      
      
      <li class="dropdown"><a class="dropdown-toggle" id="hdm4" data-toggle="dropdown" href="#">ADD USER<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="15" style="display:none;" class="dropdown-item" href="addusers.php">Add USer</a></li>
            <li><a id="16" style="display:none;" class="dropdown-item" href="viewusers.php">View User</a></li>
            
          
        </ul>
      </li>
      
      
      <li class="dropdown"><a class="dropdown-toggle" id="hdm5" data-toggle="dropdown" href="#">PO<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="17" style="display:none;" class="dropdown-item" href="po.php">CREATE PO</a></li>
            <li><a id="18" style="display:none;" class="dropdown-item" href="viewpo.php">VIEW PO</a></li>
            <li><a id="19" style="display:none;" class="dropdown-item" href="approved.php">APPROVED PO</a></li>
            
          
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" id="" data-toggle="dropdown" href="#">OFFICE INVENTORY<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="" class="dropdown-item" href="#">Office Team</a></li>
            <li><a id="" class="dropdown-item" href="Inventory_out2.php">Filed Team</a></li>
            <li><a id=""  class="dropdown-item" href="viewstockout.php">View Stock Out</a></li>
            <li><a id=""  class="dropdown-item" href="viewstock_summary.php">View Stock Summary</a></li>
        </ul>
      </li>
       <li class="dropdown"><a class="dropdown-toggle" id="hdm6" data-toggle="dropdown" href="#">MATERIAL<span class="caret"></span></a>
        <ul class="dropdown-menu">
           <!-- <li><a id="" class="dropdown-item" href="material.php">Material</a></li>-->
            <li><a id="" class="dropdown-item" href="material_status.php">Material Status</a></li>
          
        </ul>
      </li>
      
       <li class="dropdown"><a class="dropdown-toggle" id="hdm6" data-toggle="dropdown" href="#">PROJECT<span class="caret"></span></a>
        <ul class="dropdown-menu">
           <!-- <li><a id="" class="dropdown-item" href="material.php">Material</a></li>-->
            <li><a id="" class="dropdown-item" href="incoming_boq.php">Incoming BOQ</a></li>
          
        </ul>
      </li>
      
      
      <li><a  href="log_out.php">LOG OUT</a></li>    
      
           

      

     <!--  <li><a style="align:right;padding-left: 130px;margin-left: 321px;padding-right: 0px;" href="log_out.php">Log Out</a>
       <ul class="dropdown-menu">
          <li><a href="Stock_Tr_to_Branch.php">stock tr to branch</a></li>
          
        </ul>
      </li>-->
    
     
     <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Log Out<span class="caret"></span></a>
       <ul class="dropdown-menu">
          <li><a href="addengineer.php">Add Engineer</a></li>
          <li><a href="view_engineer.php">View Engineer</a></li>
          <!--<li><a href="editengineer.php">Edit Engineer</a></li>
          <li><a href="DailyActivity.php">Daily Activity</a></li>
           <li><a href="viewdailyActivity.php">View Daily Activity</a></li>
        </ul>
      </li>-->
    </ul>
  </div>
</nav>
 <!-- </body>-->

