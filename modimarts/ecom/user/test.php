<?php
session_start();
$cid=$_SESSION['id'];
include('config.php');
$avtar=mysqli_query($con1,"select * from clients where code='".$cid."'");
$avtarres=mysqli_fetch_row($avtar);
$cname=$avtarres[1];   
$conname=$avtarres[11];
?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Collapsible sidebar using Bootstrap 4</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet"  href="css/style4.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
<!--            <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
                <strong>BS</strong>
            </div>-->
            <div class="sidebar-header">
                <div class="logo">
                  <a href="sarmicrosystems.com/oc1" target="_blank">
                    <img class="logo-sidebar-big" src="logomera.png" alt="MERABAZA-logo" style="width:200px;">
                  </a>
                  <strong>MB</strong>
                </div>
                <div class="reduce-sidebar">&#xf0c9;</div>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#">
                        <i class="fas fa-briefcase"></i>
                        Home
                    </a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Personlize
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="edit_profile.php">Edit Profile</a>
                        </li>
                        <li>
                            <a href="changepassword.php">Change Password</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        My Products
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="add_product.php">Add Products</a>
                        </li>
                        <li>
                            <a href="view_products.php">View Products</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        My Subscriptions / Offers
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="view_subscriptions.php">My Subscriptions</a>
                        </li>
                        <li>
                            <a href="view_offer.php">My Offers</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Reports
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Subscriptions</a>
                        </li>
                        <li>
                            <a href="#">Offers</a>
                        </li>
                        <li>
                            <a href="#">Slot Booked</a>
                        </li>
                        <li>
                            <a href="#">Claim Bill</a>
                        </li>
                        <li>
                            <a href="#">Billing Report</a>
                        </li>
                        <li>
                            <a href="#">Pending Payments</a>
                        </li>
                        <li>
                            <a href="#">Order History</a>
                        </li>
                    </ul>
                </li>
                <?php 
                    $admin_cid=mysqli_query($con1,"select cid,department from users where  cid='".$_SESSION["id"]."' ");
                    $result_admin=mysqli_fetch_array($admin_cid);
                    if($result_admin[0]!=0 && $result_admin[1]!='admin'){
                ?>
                <li>
                    <a href="HomePageImage.php">
                        <i class="fas fa-image"></i>
                        Advertise
                    </a>
                </li>
                <li>
                    <a href="upload_ads_videos.php">
                        <i class="fas fa-question"></i>
                        Upload Ads
                    </a>
                </li>
                <?php } ?>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-paper-plane"></i>
                        LogOut
                    </a>
                </li>
            </ul>
            <!--<ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>-->
        </nav>
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!--<span>Toggle Sidebar</span>-->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <img src="<?php echo $mainpath.$avtarres[18]; ?>" alt="<?php echo $conname ?>" width="65" height="65">
                            </li>
                            <li class="nav-item" style="color: #5c5c5c;font-size: 12px;">
                                <h4><a href="#"><?php echo $conname ?></a></h4>
                                <h6><?php echo $cname; ?></h6>
                            </li>
                            <li class="nav-item">
                                <a href="#userSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class='fas fa-user-cog' style='font-size:24px'></i>
                                </a>
                                <ul class="collapse list-unstyled" id="userSettings">
                                    <li>
                                        <a href="edit_profile.php">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
           </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>