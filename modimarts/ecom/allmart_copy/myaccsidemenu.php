<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){ ?>
 <a href="myacc.php" class="list-group-item">My Account</a>
    <a href="Register.php" class="list-group-item">Edit Account</a> 
    <a href="changepass.php" class="list-group-item">Password</a>
   <!-- <a href="">Address Book</a>-->
    <a href="WishList.php" class="list-group-item">Wish List</a> 
    <!--<a href="http://sarmicrosystems.in/oc/index.php?route=account/order" class="list-group-item">Order History</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/download" class="list-group-item">Downloads</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/recurring" class="list-group-item">Recurring payments</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/reward" class="list-group-item">Reward Points</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/return" class="list-group-item">Returns</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/transaction" class="list-group-item">Transactions</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/newsletter" class="list-group-item">Newsletter</a>-->
    
    <a href="logout.php" class="list-group-item">Logout</a>
   <?php  } ?>