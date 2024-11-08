 <div class="left-side-menu">

    <?php
$CI = &get_instance();
$CI->load->model('Settings_M');
$Settings = $CI->Settings_M->getSettingdetails(1);
?>
                <!-- LOGO -->
                <a href="<?=base_url()?>" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="<?=base_url() . "/" . $Settings->logo?>" alt="" style="background: white;border-radius: 50px;" height="66">
                    </span>
                    <span class="logo-sm">
                        <img src="<?=base_url() . "/" . $Settings->logo?>" alt="" style="background: white;border-radius: 50px;" height="66">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="index.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="<?=base_url() . "/" . $Settings->logo?>" alt="" style="background: white;border-radius: 50px;" height="66">
                    </span>
                    <span class="logo-sm">
                        <img src="<?=base_url() . "/" . $Settings->logo?>" alt="" style="background: white;border-radius: 50px;" height="66">
                    </span>
                </a>

                <div class="h-100" id="left-side-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="metismenu side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <li class="side-nav-item">
                            <a href="<?=base_url()?>" class="side-nav-link">
                                 <i class="uil-home-alt"></i>
                                <span> Home </span>
                            </a>
                            
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Report </span>
                                <span class="menu-arrow"></span>
                            </a>
                        <ul class="side-nav-second-level" aria-expanded="false">
                            <li>
                                <a href="<?=base_url('Product/ProductExpiry')?>">Inventory Report</a>
                            </li>
                        </ul>
                        </li>
                        


                        <!-- <li class="side-nav-title side-nav-item">Apps</li> -->

                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Purchase </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Supplier/Bill_entry')?>">Entry Bill</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Supplier/View_Bill')?>">View Bill</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Bill/ViewAll')?>">View Payments</a>
                                </li>

                            </ul>
                        </li>
                        <!-- <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Sale</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Sale/Bill_entry')?>">Entry Sale Bill</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Sale/View_Bill')?>">View Bill</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Sale/ViewAllBill')?>">View Sale Bill</a>
                                </li>

                            </ul>
                        </li> -->
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Sale</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Sale/BillRetailer')?>">Entry Sale Bill</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Sale/View_BillRetailer')?>">View Bill</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Sale/ViewAllBill')?>">View Sale Bill</a>
                                </li>

                            </ul>
                        </li>

                      <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-shop"></i>
                                <span>Suppliers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Supplier/Manage')?>">Manage</a>
                                </li>

                            </ul>
                        </li>
                      <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-shop"></i>
                                <span>Customers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Customers/Manage')?>">Manage</a>
                                </li>

                            </ul>
                        </li>
                        
                        <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-shop"></i>
                                <span>Doctors</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Doctors/Manage')?>">Manage</a>
                                </li>

                            </ul>
                        </li>

                      <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-money-withdrawal"></i>
                                <span>Bank </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Bank/View')?>">View</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Bank/Transaction')?>">Transaction</a>
                                </li>


                            </ul>
                        </li>

                      <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-notebooks"></i>
                                <span>Product </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Product/Add')?>">Add Product</a>
                                    <!-- <a href="<?=base_url('Product/Stock')?>">Stock</a> -->
                                    <a href="<?=base_url('Product/Category')?>">Category</a>
                                    <a href="<?=base_url('Product/Manage')?>">Manage Product</a>
                                </li>


                            </ul>
                        </li>
                      <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-notebooks"></i>
                                <span>Return </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Return')?>">Add Return</a>
                                </li>


                            </ul>
                        </li>

                      <li class="side-nav-item">

                             <a href="javascript: void(0);" class="side-nav-link">
                                <i class="uil-notebooks"></i>
                                <span>Settings</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="<?=base_url('Settings/ManageSettings')?>">Manage</a>
                                    <a href="<?=base_url('Settings/ManageScheme')?>">Manage Scheme</a>
                                </li>


                            </ul>
                        </li>

                       <!--    <li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-comments-alt"></i>
                                <span> Chat </span>
                            </a>
                        </li> -->


                    </ul>


                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">