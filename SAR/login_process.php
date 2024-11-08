
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
<?php
include 'config.php';
// session_start();

$uname = $_POST['username'];
$password = $_POST['password'];

if($uname && $password){
    
    $sql = mysqli_query($con,"select * from users where name = '".$uname."' and password='".$password."'");
    $result = mysqli_num_rows($sql);
    if($result>0){
        $sql_result = mysqli_fetch_assoc($sql);
        if($sql_result['user_status']==1){
                $_SESSION['auth']=1;
                $_SESSION['username']=$sql_result['name'];
                $_SESSION['userid'] = $sql_result['id'];
                $userid = $sql_result['id'];
                print_r($_SESSION); 
                
                // if($uname == 'admin' ){
                //     $_SESSION['access']=1 ;
                // }
                
                ?>
               <script>
               swal("Good job!", "Login Success !", "success");
        
                   setTimeout(function(){ 
                       window.location.href="blog_str.php";
                   }, 2000);
        
               </script> 
        <? }else{ ?>       
                <script>
                   swal("Error", "You are inactive !", "error");
                      
                       setTimeout(function(){ 
                          window.history.back();
                       }, 3000);
            
                   </script>
        <? } ?>           
    <? }else{ ?>
       <script>
       swal("Error", "Incorrect Username or Password !", "error");
           swal('error','','Login Error');
           setTimeout(function(){ 
              window.history.back();
           }, 3000);

       </script>
<? }

    
    
}
else{ ?>
       <script>
       swal("Error", "Please Put Username and Password  !", "error");
            setTimeout(function(){ 
              window.history.back();
           }, 3000);

       </script>
<? }

?>