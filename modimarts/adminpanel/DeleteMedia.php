<?php
session_start();
include 'config.php';
include 'adminaccess.php';

if (isset($_GET['mediaid'])) {
    mysqli_query($con1,"DELETE FROM `PressReleases` WHERE `id`='".$_GET['mediaid']."'");
    ?>
            <script>
               alert("This Record Delete successfully!");    
                setTimeout(function(){
                    window.location.href='/adminpanel/ManagePress.php';        
                }, 1500);
            </script>

            <?php
}
else
{
    ?>
            <script>
               alert("This Record Not Delete!");    
                setTimeout(function(){
                    window.location.href='/adminpanel/ManagePress.php';        
                }, 1500);
            </script>

            <?php

}