<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if ($_SESSION['ADVANTAGE_username']) {


    $id = $_SESSION['ADVANTAGE_userid'];


    $user = "select * from user where userid=" . $id;
    $usersql = mysqli_query($con, $user);
    $usersql_result = mysqli_fetch_assoc($usersql);

    $level = $usersql_result['level'];
    $permission = $usersql_result['permission'];
    $permission = explode(',', $permission);
    sort($permission);

    $cpermission = json_encode($permission);
    $cpermission = str_replace(array('[', ']', '"'), '', $cpermission);
    $cpermission = explode(',', $cpermission);
    $cpermission = "'" . implode("', '", $cpermission) . "'";
    $mainmenu = [];
    foreach ($permission as $key => $val) {
        $sub_menu_sql = mysqli_query($con, "select * from sub_menu where id='" . $val . "' and status=1");

        if (mysqli_num_rows($sub_menu_sql) > 0) {
            $sub_menu_sql_result = mysqli_fetch_assoc($sub_menu_sql);
            $mainmenu[] = $sub_menu_sql_result['main_menu'];
        }
    }
    $mainmenu = array_unique($mainmenu);
    sort($mainmenu);






    ?>

    <nav class="sidebar sidebar-offcanvas" id="sidebar" >
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="<?php echo $base_url ; ?>" >
                <!-- <img src=$base_url ."assets/3.png" alt="logo" /> -->
                <!-- Smart TellerTrack Workspace -->
                 <!-- Smart TellerTracker -->
                 <!-- 𝓢𝓶𝓪𝓻𝓽 𝓣𝓮𝓵𝓵𝓮𝓻𝓣𝓻𝓪𝓬𝓴𝓮𝓻 -->
                 𝕊𝕞𝕒𝕣𝕥 𝕋𝕖𝕝𝕝𝕖𝕣𝕋𝕣𝕒𝕔𝕜𝕖𝕣

            </a>
            <a class="sidebar-brand brand-logo-mini" href="<?php echo $base_url ; ?>">
                <!-- <img src="<?php echo $base_url ; ?>/assets/images/railtellogo.png" alt="logo"></a> -->
                    STW
        </div>


        <ul class="nav">
            <li class="nav-item menu-items">
                <a class="nav-link" href="#">
                    <span class="menu-title" id="clock" class="clock"></span>
                </a>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>




            <?php
            foreach ($mainmenu as $menu => $menu_id) {
                $menu_sql = mysqli_query($con, "select * from main_menu where id='" . $menu_id . "' and status=1");
                $menu_sql_result = mysqli_fetch_assoc($menu_sql);
                $main_name = $menu_sql_result['name'];
                $targetDiv = str_replace(' ', '', $main_name);
                ?>

                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#<?php echo  $targetDiv; ?>" aria-expanded="false"
                        aria-controls="<?php echo  $targetDiv; ?>">
                        <span class="menu-icon">
                            <!-- <i class="mdi mdi-security"></i> -->
                            <?php

                            if ($main_name == 'Admin') {
                                echo '<i class="mdi mdi-security" ></i>';
                                // echo '<i class="fa fa-american-sign-language-interpreting"></i>';                                                
                            } else if ($main_name == 'Service') {
                                echo '<i class="mdi mdi-sitemap"></i></span>';
                            } else if ($main_name == 'Project') {
                                echo '<i class="mdi mdi-chart-areaspline" style="color: #FFB64D;"></i>';
                            } else if ($main_name == 'Inventory') {
                                echo '<i class="mdi mdi-playlist-check" style="color: #8df3ff;"></i>';
                            } else if ($main_name == 'Actions') {
                                echo '<i class="feather icon-navigation-2"></i>';
                            } else if ($main_name == 'IP Configuration') {
                                echo '<i class="mdi mdi-screwdriver" style="color: #23ff23;"></i>';
                            } else if ($main_name == 'Leads') {
                                echo '<i class="mdi mdi-format-align-center" style="color: #23ff23;"></i>';
                            } else if ($main_name == 'Reports') {
                                echo '<i class="mdi mdi-file-chart align-center" style="color: #23ff23;"></i>';
                            } else if ($main_name == 'MIS') {
                                echo '<i class="mdi mdi-message-image align-center" style="color: #23ff23;"></i>';
                            }




                            ?>
                        </span>
                        <span class="menu-title">
                            <?php echo $main_name; ?>
                        </span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="collapse" id="<?php echo  $targetDiv; ?>">
                        <ul class="nav flex-column sub-menu">
                            <?php
                            $submenu_sql = mysqli_query($con, "select * from sub_menu where main_menu = '" . $menu_id . "' and id in ($cpermission) and status=1 order by weight asc");
                            while ($submenu_sql_result = mysqli_fetch_assoc($submenu_sql)) {
                                $page = $submenu_sql_result['page'];
                                $submenu_name = $submenu_sql_result['sub_menu'];
                                $folder = $submenu_sql_result['folder'];

                                if (basename($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == $page) {
                                    $className = 'active';
                                } else {
                                    $className = '';
                                }
                                ?>
                                <li class="nav-item <?php echo $className; ?>">
                                    <a class="nav-link" href="<?php echo  $base_url . $folder . '/' . $page; ?>">
                                        <?php echo $submenu_name; ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>

            <?php } ?>





            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo $base_url; ?>/logout.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Logout</span>
                </a>
            </li>


        </ul>
    </nav>

<?php } ?>

<script>
    function updateClock() {
        var now = new Date();
        var date = now.toDateString();
        var time = now.toLocaleTimeString();

        var clockElement = document.getElementById('clock');
        clockElement.textContent = date + ' ' + time;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);

    // Initial call to display the clock immediately
    updateClock();
</script>