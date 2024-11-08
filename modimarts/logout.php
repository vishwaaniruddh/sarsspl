<? 
session_start();

session_unset();
session_destroy();

include('head.php');

// print_r($_SESSION);

?>

<script>
    
    swal('Logout Successfully');
    setTimeout(function(){
    window.location.href="index.php";
    }, 2000);
</script>

<? include('footer.php');?>