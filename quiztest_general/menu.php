<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="fa fa-bars fa-lg"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">
                           <h1 style="color:#fff;font-size:50px;">Quiz2shine</h1>
                           <!--- <img src="assets/img/freeze/logo.png" alt="" class="logo">--->
                        </a>
                    </div>
<h3 style="color:#fff;font-size:20px;text-align: right;"> 
<?php 

include("config.php");

$qry=mysqli_query($con,"select * from quiz_regdetails where id='".$_SESSION['userid']."'");

$row=mysqli_fetch_array($qry);
        //echo $row['emailid'];
                
                ?> 
                </h3>
             </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="javascript:void(0);" onclick='window.open("<?php echo  $urlp;?>","_self");'>Home</a></li>
                           <!-- <li><a href="#features">features</a></li>
                            <li><a href="#reviews">reviews</a></li>
                            <li><a href="#screens">Play</a></li>-->
                            <!--<li><a href="#demo">demo</a></li>---->
                            <li><a class="getApp" href="#getApp">get app</a></li>
                            <!--<li><a href="#support">support</a></li>-->
                            <?php if($_SESSION['userid']!=""){?>
                            
                          
                            
                             <li><a href="profile.php" >View Profile</a></li>
                            <li><a href="leaderboard.php">Leaderboard</a></li>
                            <li><a href="history_dets.php">History</a></li>
                            <li><a href="requests_view.php">Requests</a></li>
                            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsarmicrosystems.in%2Fquiztest%2Fregister.php?rg=<?php echo $_SESSION['userid'];?>">Invite Friends</a></li>
                            
                            
                            <li><a href="javascript:void(0);" onclick='promptfunc("Are you sure to Logout?","warning","1");'>Logout</a></li>
                            
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
        </nav>

      