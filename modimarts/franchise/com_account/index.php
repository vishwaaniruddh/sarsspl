<? session_start();


if(!isset($_SESSION["username"])) {
	header("Location:../admin/login_form.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 260px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 260px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

table{
    width:100% ! important;
}
.nav_head{
    color:white;
    text-align:center;
}

#loading {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #8c8686;
  z-index: 99;
  text-align: center;
}

#loading-image {
position: absolute;
    top: 35%;
    left: 45%;
    z-index: 100;
}


</style>


</head>
<body>

<div id="loading">
  <img id="loading-image" src="loader.gif" alt="Loading..." />
</div>




<div class="sidenav">
<h3 class="nav_head">Selling Commission</h3>
  <a id="com_distribution">Commissions By Transactions</a>
  <a id="all_com">Overall Commission</a>
  <a id="recent_pay">Recent Payment</a>
  
<!--<a href="https://allmart.world/franchise/admin/add_commission.php" id="add_commission">Add Product Commission</a>-->
<a href="https://allmart.world/franchise/admin/add_commission.php" >Add Product Commission</a>


 
 
<h3 class="nav_head">Joining Commission</h3>

  <a id="join_distribution">Total Commissions</a>
  <a id="join_com">View Joinees</a>
  <a id="join_recent_pay">Recent Payment</a>
  
  
</div>

<div class="main">
  <h2>Commission</h2>
<div id="content">
    
</div>
</div>
 

   <script>
   



       $(document).ready(function(){
           $('#loading').show();
           $('#content').load( 'com_distribution.php' );     
                         
           $("#com_distribution").on('click',function(){
                  $('#loading').show();
                  $('#content').load( 'com_distribution.php' ); 
           });
   
           $("#all_com").on('click',function(){
               $('#loading').show();
                  $('#content').load( 'all_com.php' ); 
           });
           
           $("#recent_pay").on('click',function(){
               $('#loading').show();
                  $('#content').load( 'recent.php' ); 
           });
           
           
           
           $("#add_commission").on('click',function(){
               $('#loading').show();
                  $('#content').load( 'add_commission.php' ); 
           });
          
          $("#join_distribution").on('click',function(){
                  $('#loading').show();
                  $('#content').load( 'join_distribution.php' ); 
           });
   
           $("#join_com").on('click',function(){
                  $('#loading').show();
                  $('#content').load( 'join_com.php' ); 
           });
           
           $("#join_recent_pay").on('click',function(){
               $('#loading').show();
                  $('#content').load( 'join_recent_pay.php' ); 
           });
           
           
       });
   </script>
</body>
</html> 
