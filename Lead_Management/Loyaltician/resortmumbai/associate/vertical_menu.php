<?php  if($_SESSION['id']!=""){?>
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        
        <span class="admin-brand-content font-secondary" style="user-select: auto;"><a href="dashboard.php" style="user-select: auto;"><img class="admin-brand-logo" src="../newassets/wlogo.png" alt="atmos Logo" style="user-select: auto;"></a></span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
            <li class="menu-item active ">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Dashboard
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                           <span class="icon-badge badge-success badge badge-pill">1</span>
                                                 <i class="icon-placeholder mdi mdi-shape-outline "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">

                    <li class="menu-item ">
                        <a href="dashboard.php" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Hotel User Dashboard</span>
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  mdi mdi-shape-circle-plus ">

                                                </i>
                                            </span>
                        </a>
                    </li>
                                    </ul>
            </li>
           
           
           
           <!---=========================================-->
          <!--  <li class="menu-item active ">
            <a href="#" class="open-dropdown menu-link">
            <span class="menu-label">
                <span class="menu-name">Masters
                <span class="menu-arrow"></span>
                </span>
            </span>
            <span class="menu-icon">
            <span class="icon-badge badge-success badge badge-pill">2</span>
                <i class="icon-placeholder">M</i>
            </span>
            </a>
                
                <ul class="sub-menu">
                <li class="menu-item ">
                <a href="services.php" class=" menu-link">
                <span class="menu-label">
                <span class="menu-name">Services/Outlet</span>
                </span>
                <span class="menu-icon">
                <i class="icon-placeholder">O
                </i>
                </span>
            </a>
                </li>
                
                
                  <li class="menu-item">
                        <a href="brand.php" class=" menu-link">
                            <span class="menu-label">
                            <span class="menu-name">Brand </span>
                            </span>
                            <span class="menu-icon">
                            <i class="icon-placeholder">B</i>
                            </span>
                        </a>
                    </li>
                   
                     <li class="menu-item">
                        <a href="hotel_creation.php" class=" menu-link">
                            <span class="menu-label">
                            <span class="menu-name">Hotel</span>
                            </span>
                            <span class="menu-icon">
                            <i class="icon-placeholder">H</i>
                            </span>
                        </a>
                    </li>
                    
                    
                    <li class="menu-item">
                        <a href="Program.php" class=" menu-link">
                            <span class="menu-label">
                            <span class="menu-name">Program</span>
                            </span>
                            <span class="menu-icon">
                            <i class="icon-placeholder">P</i>
                            </span>
                        </a>
                    </li>
                    
                <li class="menu-item">
                        <a href="Level.php" class=" menu-link">
                            <span class="menu-label">
                            <span class="menu-name">Level</span>
                            </span>
                            <span class="menu-icon">
                            <i class="icon-placeholder">L</i>
                            </span>
                        </a>
                    </li>
                
                
                <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                        <span class="menu-name">Rules
                        <span class="menu-arrow"></span>
                        </span>
                        </span>
                        <span class="menu-icon">
                          <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                        </span>
                </a>
               
                <ul class="sub-menu">

                    <li class="menu-item">
                        <a href="validity.php" class=" menu-link">
                                <span class="menu-label">
                                <span class="menu-name">validity
                                </span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-checkbook "></i>
                                </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="voucher_booklet.php" class=" menu-link">
                                <span class="menu-label">
                                <span class="menu-name">Voucher Booklet Series
                                </span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-checkbook "></i>
                                </span>
                        </a>
                    </li>
                    
                     <li class="menu-item">
                        <a href="voucher_Type.php" class=" menu-link">
                                <span class="menu-label">
                                <span class="menu-name">Voucher Details/Type
                                </span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-checkbook "></i>
                                </span>
                        </a>
                    </li>
                  
                </ul>
            </li>
           
           
                
                
                
                
                
                
                
                
                
                
                </ul>
                
                       
                
                
            </li>-->
           
           <!--==========================================-->
           
            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Leads
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">

                    <li class="menu-item">
                        <a href="lead_entry1.php" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">New Prospect
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-checkbook "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="prospect_view.php" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">View Prospect
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-checkbook "></i>
                                            </span>
                        </a>
                    </li>
                    <!--<li class="menu-item">-->
                    <!--    <a href="epm.php" class=" menu-link">-->
                    <!--                    <span class="menu-label">-->
                    <!--                            <span class="menu-name">EnglishPointMarina-->
                    <!--                            </span>-->
                    <!--                        </span>-->
                    <!--        <span class="menu-icon">-->

                    <!--                                <i class="icon-placeholder mdi mdi-calendar-edit "></i>-->
                    <!--                        </span>-->
                    <!--    </a>-->
                    <!--</li>-->
                

                </ul>
            </li>
           
           
                   <!-- <li class="menu-item">
                        <a href="reset.html" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Reset Password </span>
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  ">
                                                    R
                                                </i>
                                            </span>
                        </a>
                    </li>-->
                    <li class="menu-item">
                        <a href="logout.php" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Logout </span>
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  ">
                                                    L
                                                </i>
                                            </span>
                        </a>
                    </li>
                  



                </ul>
            </li>

            
                </ul>
            </li>
        </ul>

    </div>
<?php } else{?>
   <script>window.open("login.php","_self") </script>
<?php }
?>
</aside>