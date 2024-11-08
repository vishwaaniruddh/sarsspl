<?php
if (!isset($_SESSION)) session_start();
//echo getcwd();
include 'config.php';
unset($_SESSION["test_against"]);
unset($_SESSION["test_against_type"]);
unset($_SESSION["test_against_id"]);
unset($_SESSION["subject"]);

if($_SESSION['rtest_id']=="")
{
$_SESSION['rtest_id']=$_SESSION['test_id'];
}
unset($_SESSION["test_id"]);
echo $_SESSION["teststatsn"];
?>

<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>Quiz2shine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    
    <?php include("includeinallpages.php");?>
    <script>
    function fn()
    {
    }
    
    </script>
    
    <style>
      .wbpr{border: 2px solid #FFD700; border-radius: 10px; padding:10px;color:#fff; font-size:16px;}
    </style>
</head>
<body onload="" >
    <div class="pre-loader">
        <div class="load-con">
            <img src="assets/img/freeze/logo.png" class="animated fadeInDown" alt="">
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
            </div>
        </div>
    </div>
    <header>
      <?php include('menu.php');?>  
        <div id="show">
</div>
    </header>
    <div class="wrapper demo" >
         <section id="reviews">
            <div class="container-fluid">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>Result</h1>
                    <div class="divider"></div>
                    
                </div>
              

</div>
  </section>      
 <?php
 
 $getdetsmain=mysqli_query($con,"select * from quiztest_test_appeared where id='".$_SESSION['rtest_id']."'");
 $mnfre=mysqli_fetch_array($getdetsmain);
           $getdets=mysqli_query($con,"select * from quiztest_qids_details where test_id='".$_SESSION['rtest_id']."'");
          echo mysqli_error($con);
           ?> 
        
<?php
          $n=1;
           while($fr=mysqli_fetch_array($getdets))
           {
               
               $qri2="select * from quiztest where srno ='".$fr[2]."' ";
//echo $qri2;
$qr=mysqli_query($con,$qri2);
$rw=mysql_fetch_array($qr);

 $sec="reviews";
 //echo $n/$n;
if($n % 2 == 0)
{
$sec="reviews";
    
    
}else
{
    
    $sec="getApp";

}
          ?> 
        <section id="<?php echo $sec;?>" class="fr">
          
            <div class="container-fluid">
                <!--<div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>Result</h1>
                    <div class="divider"></div>
                    <p>Choose your native platform and get started!</p>
                </div>-->
              

                <div class="row">
                    <div class="col-md-12">
                        <div class="hanging-phone scrollpoint sp-effect2 hidden-xs">
                            <!--<img src="assets/img/freeze/freeze-angled2.png" alt="">-->
                        </div>
                         <div class="col-md-12">
                            <div class="col-md-1"></div>
                        <div class="col-md-10" style="border: 3px solid #FFD700; border-radius: 10px;  padding:10px; padding-top:0px; ">
                                        <div  class=" scrollpoint sp-effect1">
                                            <h3 style="color:#fff;"><?php echo "(Q:".$n.")".$rw["mcq"];?></h3>
                                          
                                        </div>
                                        
                                        
                                    </div>
                                  
                                    <div class="col-md-1"></div>
                                    </div>
                            <div class="platforms">
                                <div class="col-md-12">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                         </br>
                                         
                                         
                                         <?php 
                            $a="";
                            $b="";
                            $c="";
                            $d="";
                            
                               if($fr["correct_option"]==$fr["selected_option"])
                                {
                                    
                                    if($fr["selected_option"]=="a")
                                    {
                                       $a="green"; 
                                        
                                    }
                                    if($fr["selected_option"]=="b")
                                    {
                                       $b="green"; 
                                        
                                    }
                                    if($fr["selected_option"]=="c")
                                    {
                                       $c="green"; 
                                        
                                    }
                                    if($fr["selected_option"]=="d")
                                    {
                                       $d="green"; 
                                        
                                    }
                                    
                                    
                                }
                                
                                
                                if($fr["correct_option"]!="" && $fr["correct_option"]!=$fr["selected_option"])
                                {
                                    
                                    if($fr["selected_option"]=="a")
                                    {
                                       $a="red"; 
                                        
                                    }
                                    if($fr["selected_option"]=="b")
                                    {
                                       $b="red"; 
                                        
                                    }
                                    if($fr["selected_option"]=="c")
                                    {
                                       $c="red"; 
                                        
                                    }
                                    if($fr["selected_option"]=="d")
                                    {
                                       $d="red"; 
                                        
                                    }
                                    
                                    
                                }
                                
                            
                            
                            
                            
                            
                            ?>
                            
                                <div class="wbpr" style="background-color:<?php echo $a;?>">
                                   <span><b>(a)</b> <b><?php echo $rw["a"];?></b></span><br>
                                </div>
                            
                            </div>
                            <div class="col-md-5">
                            </br>
                            <div class="wbpr" style="background-color:<?php echo $b;?>">
                                <span><b>(b)<?php echo $rw["b"];?></b></span><br>
                            </div>
                            </div>
                            <div class="col-md-1"></div>
                            </div>
                            
                           
                                <div class="col-md-12" style="margin-top:15px; margin-bottom:20px;">
                                     <div class="col-md-1"></div>
                                  <div class="col-md-5">
                                   
                                       <div class="wbpr" style="background-color:<?php echo $c;?>">
                                       <span><b>(c)<?php echo $rw["c"];?></b></span><br>
                                       </div>
                                    </div>
                                    
                                <div class="col-md-5">
                                   <div class="wbpr" style="background-color:<?php echo $d;?>">
                                      <span><b>(d)<?php echo $rw["d"];?></b></span><br>
                                   </div>
                               </div>
                             <div class="col-md-1"></div>
                            </div>
                           
                           
                           
                           
                            <div class="col-md-12" >
                            <div class="col-md-1" ></div>
                            <div class="col-md-5" style="background-color:grey;">
                                        <div  class=" scrollpoint sp-effect1" >
                                            <h3 style="color:#FFD700">Correct Option : <?php echo $fr["correct_option"];?></h3>
                                          
                                        </div>  </br>
                            </div>  
                            
                            
                            <div class="col-md-5" style="background-color:grey;">
                                <div  class=" scrollpoint sp-effect1">
                                            <h3 style="color:#FFD700">Selected Option : <?php echo $fr["selected_option"];?></h3>
                                          
                                        </div>  </br>
                           <div class="col-md-1" ></div>
                           </div>
                           
                           
                                 <div class="col-md-12" >
                                 <div class="col-md-1" ></div>
                                  <?php $col=""; 
                           
                           if(trim($fr["correct_option"])==trim($fr["selected_option"]))
                           {
                               $col="green";
                               $txt="Your Answer is Correct";
                           }else
                           {
                               $col="red";
                               $txt="Your Answer is Wrong";
                           }
                           ?>
                           
                            <div class="col-md-10"  style="background-color:<?php echo $col;?>; margin-left: -13px;width: 1076px; padding:10px;font-size:17px;color:#fff;text-align:center">
                                
                               
                           <?php echo $txt;?>
                           
                           
                           </div>
                           
                                 
                                 
                                   <div class="col-md-1" ></div>
                                 
                                 </div>
     
                    </div>
                </div>
                
            </div>
        </section>
        <?php 
                $n++;
                } ?>

        
        <br><br>
                              <center>
                                    <button type="button" class="btn btn-primary  btn-lg" onclick="window.open('quizt.php','_self');">Take Another Test</button>
                                    </center>
                                    </form>
        
 <?php include("footer.php");
 mysqli_close($con);
 ?>
       

    </div>

<script type="text/javascript" src="jquery.fireworks.js"></script>
     
<script>

$( document ).ready(function() {
   
   if(<?php echo $mnfre["test_stats"];?>=="1")
   {
       
       showfireworks();
   }
   
});
function showfireworks()
{
    
    $('.fr').fireworks();
}


</script>
</body>

</html>