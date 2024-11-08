<?php 
session_start();
if (!isset($_SESSION['gid']) && !isset($_SESSION['mem_id']) ) { 
    ?>
  <script>
    alert('Login Please');
    window.location.href="https://allmart.world/login.php";
  </script>
  <?php
} else {

    if($_SESSION['gid']!='')
     {
       $user_id   = $_SESSION['gid'];
     }
     if($_SESSION['mem_id']!='')
     {
       $user_id   = $_SESSION['mem_id'];
     }
}
 ?>