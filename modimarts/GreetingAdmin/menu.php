<? session_start(); ?>

<ul class="nav navbar-nav navbar-right" style="width:auto;">
                    <!-- Call Search -->
                    <li>
                        <a href="https://allmart.world/franchise/get_members.php" class="">Member Filter</a>
                    </li>
                    
                    
                    
                    <? if(isset($_SESSION) && isset($_SESSION['id'])) { 
                        $id=$_GET['id'];
                        $getcommi=mysqli_fetch_assoc(mysqli_query($con1,"SELECT SUM(amount) as Total FROM `commission_details` WHERE `commission_to`='".$id."' AND com_givien='0'"));
                        // var_dump($getcommi);

                        ?>
                    
                        <li><a href="https://allmart.world/franchise/showComMember.php?id=<?=$id?>">Commision ( <?php
                         if($getcommi['Total']!=null){ echo number_format($getcommi['Total'],2);} else { echo "0";} ?>)</a></li>
                        <li><a href="https://allmart.world/franchise/franchise_products.php">Products</a></li>
                     
                    <? } ?>
                    <?php 
                   if (isset($_SESSION['mem_id']) || isset($_SESSION['userid'])) {
                        ?>
                         <li>
                        <a href="https://allmart.world/franchise/admin/logout.php" class="">Logout</a>
                    </li>
                        <?php
                    } ?>
                    
                    <? if(isset($_SESSION) && $_SESSION['rollid']==1){ ?>                    

                    <li>
                        <a href="https://allmart.world/franchise/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="https://allmart.world/franchise/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                    
                   <li>
                        <a href="https://allmart.world/franchise/admin/waiting.php" class="">Waiting list</a>
                    </li>                    
                    <!-- <li>
                        <a href="https://allmart.world/franchise/com_account" class="">Commission</a>
                    </li>                    -->
                    <?php  if (isset($_SESSION['username'])) { ?>
                    <li>
                        <a href="https://allmart.world/franchise/admin/FranchiseTransferData.php" class="">Transfer History</a>
                    </li>
                <?php } ?>


                    
                   <? }
                   elseif($_SERVER['PHP_SELF']=="/waiting.php" || $_SERVER['PHP_SELF']=="/apply.php"){
                       
                   }
                   ?>
                  
                    <li>
                        <a href="https://allmart.world/franchise/admin/index.php" class="">Admin</a>
                    </li> 
                    <?php if (isset($_SESSION['username'])){
                    if (isset($_SESSION['username']) && $_SESSION['userid']=='1') {  ?>
                    <li>
                        <a href="https://allmart.world/franchise/admin/Users.php" class="">Users</a>
                    </li> 
                    <?php }else{ ?>
                        <li>
                        <a href="https://allmart.world/franchise/admin/MyProfile.php" class="">My Profile</a>
                    </li>
                    <?php }} 

                    if (isset($_SESSION['username'])) {  ?>
                    <li>
                        <a href="https://allmart.world/franchise/admin/Promotions.php?id=<?=$_SESSION['userid']?>" class="">Promotions</a>
                    </li>  
                    <?php } ?>  
                    <?php  if (isset($_SESSION['username'])) { ?>
                    <li>
                        <a href="https://allmart.world/franchise/promotions_cms" class="">Add Promotions</a>
                    </li>
                <?php } ?>
                    
                </ul>