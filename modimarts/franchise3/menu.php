<? session_start(); ?>

<ul class="nav navbar-nav navbar-right" style="width:auto;">
                    <!-- Call Search -->
                    <li>
                        <a href="http://www.modimart.world/franchise3/get_members.php" class="">Member Filter</a>
                    </li>
                    
                    <!--<li>-->
                        <!--<a href="http://www.modimart.world/franchise3/pay" class="">franchise3 Payment</a>-->
                        <!--<a href="http://www.modimart.world/franchise3/pay" class="">franchise3 Payment</a>-->
                    <!--</li>-->
                    
                    

                    
                    
                    <? if(isset($_SESSION) && $_SESSION['rollid']==1){ ?>                    

                    <li>
                        <a href="https://modimart.world/franchise3/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="http://www.modimart.world/franchise3/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                    
                   <li>
                        <a href="http://www.modimart.world/franchise3/admin/waiting.php" class="">Waiting list</a>
                    </li>
                    
                    <li>
                        <a href="http://www.modimart.world/franchise3/admin/commission.php" class="">Commission</a>
                    </li>
                    
                    
                   <? }
                   elseif($_SERVER['PHP_SELF']=="/waiting.php" || $_SERVER['PHP_SELF']=="/apply.php"){
                       
                   }
                   
                   else{ ?>
                    <li>
                        <a href="http://www.modimart.world/franchise3/admin/index.php" class="">Admin</a>
                    </li>     
                    <? } ?>
                </ul>