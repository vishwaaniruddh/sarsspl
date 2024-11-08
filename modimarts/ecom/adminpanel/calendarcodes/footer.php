<?php include_once('calendar/jqcal/functions.php'); ?> 
<section class="cp-instagram-section">
     <!-- <div class="cp-ins-text">
        <h4>Gallery</h4>
        <i class="fa fa-instagram"></i>
         </div>-->
      <ul class="cp-instagram-listed">

<?php $qryads=mysqli_query($con,"select * from uploaded_ads where status='footer' order by rank limit 4");
while($fetchads=mysqli_fetch_array($qryads))
{
?>
        <li>
          <figure class="cp-ins-item"> <a href="#"><img style='height:160px;'  src="<?php echo $fetchads[2]; ?>" alt=""> </a></figure>
        </li>
      <!--  <li>
          <figure class="cp-ins-item"> <a href="#"><img style='height:160px;' src="Latest Posts/balidan2.png" alt=""></a> </figure>
        </li>
        <li>
          <figure class="cp-ins-item"> <a href="#"><img style='height:160px;' src="Latest Posts/" alt=""></a> </figure>
        </li>
        <li>
          <figure class="cp-ins-item"> <a href="#"><img style='height:160px;' src="Latest Posts/balidan4.png" alt=""></a> </figure>
        </li>-->
        <?php } ?>
        
      </ul>
    </section>
    <!--Instagram Section End--> 
    
    <!--Middle Section Start-->
    <section class="cp-ft-middle-section">

<?php $qryfcf=mysqli_query($con,"select id,Name,poster from upload_faces where status='male' and Show_as_front=1");
$fetchfcf=mysqli_fetch_array($qryfcf);

?>
      <div class="cp-col-4" >

        <div class="cp-ft-widget-thumb"> <img style="height:500px;width:450px" src="<?php echo "../".$fetchfcf[2]; ?>" alt=""> </div>
      </div>
      
      
      
      
      
      <div class="cp-col-4" >
        <div class="cp-ft-widget-countdown"    id="dtp">

	
<?php include('mycal/cal.php');?>
<br>
<font color="yellow" size="+2">Events </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Orange" size="+2">Audition Dates </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color="white" size="+2">Both</font>
          
          </div>
      </div>




<?php $qryfcf=mysqli_query($con,"select id,Name,poster from upload_faces where status='female' and Show_as_front=1");
$fetchfcf=mysqli_fetch_array($qryfcf);

?>

      <div class="cp-col-4">
        <div > <img style="height:500px;width:450px" src="<?php echo "../".$fetchfcf[2]; ?>" alt=""> </div>
      </div>
      </div>
    </section>
    <!--Middle Section End--> 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!--Third Section Start
    <section class="cp-ft-third-section">
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-sm-5 col-xs-12"> <strong class="cp-ft-logo"><a href="index.html"><img src="images/cp-logo2.png" alt=""></a></strong> </div>
          <div class="col-md-7 col-sm-7 col-xs-12">
            <ul class="cp-ft-dropdown-listed">
              <li>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Language: English <span class="caret"></span> </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">Arabic</a></li>
                    <li><a href="#">EN</a></li>
                    <li><a href="#">Spanish</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Restricted Mode: Off <span class="caret"></span> </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li><a href="#">On</a></li>
                    <li><a href="#">Mode</a></li>
                    <li><a href="#">Off</a></li>
                  </ul>
                </div>
              </li>
              <li><a href="#"><i class="fa fa-hourglass-start"></i> History</a></li>
              <li><a href="#"><i class="fa fa-question-circle"></i> Help</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!--Third Section End--> 
    
    <!--Copyright Section Start-->
    <section class="cp-copyright-section">
      <div class="container">
        <nav class="cp-ft-nav">
          <ul>
           <li><a href="index.php">Home</a></li>
            <li><a href="AboutUs.php">About</a></li>
             <li><a href="#">MemberShip</a></li>
            <li><a href="#">News & Event</a></li>
           
            <li><a href="contact-us.php">Contact Us</a></li>
           
            
          </ul>
        </nav>
        <nav class="cp-ft-nav cp-ft-nav2">
          <ul>
            <li><a href="Disclamerd.php">Disclaimer</a></li>
            <li><a href="Terms_and_Condition.php">Terms and Condition</a></li>
            <li><a href="Grievance_Redressal_Policy.php">Grievance Redressal Policy</a></li>
            <li><a href="Cancellation_and_Refund_Policy.php">Cancellation and Refund Policy</a></li>
           
           
          </ul>
        </nav>
      </div>
    </section>