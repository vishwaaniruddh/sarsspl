<?php 
include('config.php');
?>

<div class="login pull-left hidden-xs hidden-sm">
    <ol class="breadcrumb">
         <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?>
              <li>  <a href="user/index.php">Merchant Login /</a><a href="Sell.php"> Register</a></li>
        <li>  <a href="login.php">Login /</a><a href="Register.php">Register</a>  </li>
        <?php } ?>
        <!--<li>  <a href="Register.php">Register</a>  </li>-->
            </ol>
  </div>
  <!-- Show Mobile -->          
      <!--<div class="show-mobile hidden-lg hidden-md pull-right">     
        <div class="quick-user pull-left">
          <div class="quickaccess-toggle">
            <i class="fa fa-user"></i> <i class="fa fa-angle-down"></i>
          </div>  
          <div class="inner-toggle">
            <div class="login links">
                              <ul>
                  <li><a href="Register.php">Register</a></li>
                  <li><a href="login.php">Login</a></li>
                </ul>
                 
            </div>
          </div>            
        </div>
      </div>-->
    <!-- End -->
  <div class="current-lang pull-right">
    <div class="btn-group box-language">
            </div>
   
    <div class="btn-group box-setting">   
    
        <div class="btn-group dropdown " >
             
            <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
               
                 
              <i class="fa fa-cog"></i>
              <span class="text-label hidden-xs hidden-sm hidden-md">Setting</span> 
              <i class="fa fa-angle-down"></i>                  
            </button>
            <ul class="dropdown-menu">
              
              <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
              <li><a class="" href="myacc.php"><i class="fa fa-user"></i>My Account</a></li>
              <li><a class="wishlist" href="WishList.php"><i class="fa fa-list-alt"></i> <span id="wishlist-total">Wish List (0)</span></a></li>
              <?php }else{ ?>
               <li><a class="" href="login.php"><i class="fa fa-user"></i>My Account</a></li>
              <?php } ?>
              <li><a class="last" href="compare.php"><i class="fa fa-share"></i>Compare</a></li>
              <li><a class="last" href="cart.php"><i class="fa fa-share"></i>Cart</a></li>
              <li><a class="last" href="Checkout.php"><i class="fa fa-share"></i>Checkout</a></li>
              <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
              <li><a class="last" href="logout.php"><i class="fa fa-share"></i>Logout</a></li>
             <?php } ?>
              
            </ul>
        </div>
    </div>
    <div class="login pull-left hidden-xs hidden-sm">
    <ol class="breadcrumb">
     
                  <li ><a  href="trackorder.php">Track Order </a></li>
                  <li >
                      <?php 
                      if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){
                      $slctqry=mysqli_query($con1,"SELECT Firstname FROM `Registration` WHERE id='".$_SESSION['gid']."'");
                      $sltqryftch=mysqli_fetch_array($slctqry);
                      if($sltqryftch[0]!=""){
                      ?>
                      
                      <a  href=""><?php echo "Hi, ".$sltqryftch[0]; ?></a></li>
                      <?php }} ?>
                 </ol>
                 </div>
  </div>
  