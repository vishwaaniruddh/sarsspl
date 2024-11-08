<?php
if (!isset($_SESSION)) session_start();
include("config.php");
$std= $_SESSION['std'];


/*$url = 'api/ai/leader.php';
$json = file_get_contents($url);
$data=json_decode($json);*/
//var_dump($data);

$maketemp = "CREATE TEMPORARY TABLE temp(`student_id` int NOT NULL, `points` float)"; 

mysqli_query($con, $maketemp);


$first_day_this_month = date('Y-m-01-'); // hard-coded '01' for first day
$last_day_this_month  = date('Y-m-t');

 
$qrtmn=mysqli_query($con,"select distinct(student_id) from points_details where date(entrydt)>='".$first_day_this_month."' and date(entrydt)<='".$last_day_this_month."'");
$pointsarr=array();
$srn=1;
while($rws=mysqli_fetch_array($qrtmn))
{

 
$qrt=mysqli_query($con,"select sum(points) from points_details where date(entrydt)>='".$first_day_this_month."' and date(entrydt)<='".$last_day_this_month."' and student_id='".$rws[0]."'");


$rfrws=mysqli_fetch_array($qrt);

if(!in_array($rfrws[0],$pointsarr))
{

$pointsarr[]=$rfrws[0];

}

$insqr=mysqli_query($con,"Insert into temp(student_id,points)values('".$rws[0]."','".$rfrws[0]."')");



}
rsort($pointsarr);


//print_r($pointsarr);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Leaderboard</title>
           <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        
         <?php include("includeinallpages.php");?>
    </head>
<style>
body {font-family: Arial;}
* {box-sizing: border-box}

/* Full-width input fields */
hr {
    border: 1px solid #002156;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
.button {
    background-color: #28ece3;
    color: white;
    padding: 10px 15px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
     border-radius: 25px;
     font-size:22px;
}
.button:hover {
    opacity:1;
}
.div1 {
    background-color: #28ece3;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
  
    width: 100%;
    opacity: 0.9;
     border-radius: 0px;
     font-size:22px;
	 box-shadow:25px 86px 113px rgba(0, 0, 0, 0.3);
}


.div2 {
    background-color: #786;
    color: white;
    padding: 10px 20px;
    margin: 2px 0;
    border: none;
    width: 100%;
    opacity: 0.9;
     border-radius: 0px;
     font-size:20px;
	 box-shadow:25px 86px 113px rgba(0, 0, 0, 0.3);
}

.brd{ border: 0px solid red;}
.img {
        width: 50px;
		height:50px;
    color: white;
    
     border-radius: 50px;
}


/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 70%;
  margin-left:15%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.body{background-image: url("img/background-mg.png");}


/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<script>
</script>
<body class="body">
    
      <header>
     <?php include('menu.php');?>  
       </header>
    
 <div class="container" >
<form id="formf" method="post"  style="margin-top:18%;">
 
      <div class="row">
          <div class="col-md-2"></div>
           <div class="col-md-8 " style="background-color:#fff;border:1px solid fff;border-radius: 10px; box-shadow:25px 86px 113px rgba(0, 0, 0, 0.3);">
               
               <?php
               $selqrr=mysqli_query($con,"select * from temp order by points desc");
               $nmrws=mysqli_num_rows($selqrr);
                //echo $nmrws;
               ?>
             <h1 style="color:#002156;"><center><b>Leaderboard</b></center></h1>
             <hr>
			  <div class="row">
			 <div class="col-md-12 div1 ">
				 <div class="col-md-2 " >SR No.</div>
				 <div class="col-md-6">Name</div>
				 <div class="col-md-3 ">Score</div>
			 </div>
<?php
while($frtws=mysqli_fetch_array($selqrr))
  {
  
  $result2sl = mysqli_query($con,"select * from quiz_regdetails where id='".$frtws["student_id"]."'");
 $nrtyu=mysqli_num_rows($result2sl); 
 $rwsc2n=mysqli_fetch_array($result2sl);
 $nm=$rwsc2n["name"]." ".$rwsc2n["lname"];
 
 if($rwsc2n["img_path"]!="")
 {
   $imgs=$rwsc2n["img_path"]; 
 }
 ?>
 <div class="col-md-12 div2">
				 <div class="col-md-2">
				 <?php 
				  $key=array_search($frtws["points"],$pointsarr);
				 echo $key+1;
				 ?>
				 </div>
				 <div class="col-md-6 ">
				     <img  class="img"src="<?php echo $imgs;?>"> <?php echo $nm;?> </div>
				 <div class="col-md-3"><?php echo $frtws["points"];?></div>
			 </div>
<?php 
$srn++;
} ?>

			  <!--<div class="col-md-12 div2">
				 <div class="col-md-2">1</div>
				 <div class="col-md-6 "><img  class="img"src="img/sacred.jpg"> Deepak kumar </div>
				 <div class="col-md-3">97356</div>
				
			 </div>
			 
			 
			  <div class="col-md-12 div2">
				 <div class="col-md-2">2</div>
				 <div class="col-md-6 "><img  class="img"src="img/sacred.jpg"> Rahul </div>
				 <div class="col-md-3">97356</div>
				
			 </div>-->
			 <div>
  </div>
  
   <div class="col-md-2"></div>
  </div>
 
     </div>
</form>
 </div>
</body>
</html>
