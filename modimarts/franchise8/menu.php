<? session_start(); ?>

<ul class="nav navbar-nav navbar-right" style="width:auto;">
                    <!-- Call Search -->
                    <li>
                        <a href="http://www.modimarts.com/franchise6/get_members.php" class="">Member Filter</a>
                    </li>
                    
                    <!--<li>-->
                        <!--<a href="http://www.modimarts.com/franchise6/pay" class="">franchise6 Payment</a>-->
                        <!--<a href="http://www.modimarts.com/franchise6/pay" class="">franchise6 Payment</a>-->
                    <!--</li>-->
                    
                    

                    
                    
                    <? if(isset($_SESSION) && $_SESSION['rollid']==1){ ?>                    

                    <li>
                        <a href="https://modimarts.com/franchise6/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="http://www.modimarts.com/franchise6/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                    
                   <li>
                        <a href="http://www.modimarts.com/franchise6/admin/waiting.php" class="">Waiting list</a>
                    </li>
                    
                    <li>
                        <a href="http://www.modimarts.com/franchise6/admin/commission.php" class="">Commission</a>
                    </li>
                    
                    
                   <? }
                   elseif($_SERVER['PHP_SELF']=="/waiting.php" || $_SERVER['PHP_SELF']=="/apply.php"){
                       
                   }
                   
                   else{ ?>
                    <li>
                        <a href="http://www.modimarts.com/franchise6/admin/index.php" class="">Admin</a>
                    </li>     
                    <? } ?>
                </ul>