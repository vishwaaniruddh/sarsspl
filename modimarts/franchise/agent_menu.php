<?php session_start();

include_once('../agent/function.php');


$pdo=con();

$email= $_SESSION["email"];
$password =$_SESSION["password"];    






$statement= $pdo->prepare("select email,password from agent_register WHERE email='$email' AND password='$password'");
$statement->execute();
		
		
$result=$statement->fetchAll(PDO::FETCH_ASSOC);

   	// if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){ 
   	if(isset($_SESSION["email"]) && isset($_SESSION["password"])){ 
   	?>
  	
  	
   	
    <div class="container-fluid header">
         <ul class="nav justify-content-center hiddenxs">
            <li class="nav-item">
               <a class="nav-link active" href="dashboard_temp/index.php">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="member3.php">Members</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="viewmember.php">View Members</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="PHP_Bolt-master/Online_Donation.php">Payment</a>
            </li>
            <li class="nav-item nav-img">
               <a class="nav-link " href="../index.php">
                   <div class="hindilogo">
                    <img class="logoimg" src="../images/hindi-logo.png">
                  </div>
               </a>
            </li>
               <li class="nav-item">
                    <a class="nav-link" href="https://shyambabadham.com/agent/data_updation.php">Data Updation</a>
                  </li>
                  
            <!--<li class="nav-item">-->
            <!--   <a class="nav-link" href="../agent/offline" style="padding-left: 75px;">Donation</a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--   <a class="nav-link" href="ViewDonation.php">View Donation</a>-->
            <!--</li>-->
            <li class="nav-item">
               <a class="nav-link" href="./admin/change_password.php">Change Password</a>
            </li>
             <li class="nav-item">
               <a class="nav-link" href="./admin/logout.php">Log Out</a>
            </li>
              <!--<li class="nav-item">
               <a class="nav-link lang-align" href="https://shyambabadham.com/en"><button class="btn lang">English</button></a>
            </li>-->
         </ul>
         <nav class="navbar navbar-expand-lg navbar-light bg-light d-block d-sm-none">
         	<div class="row">
              <div class="col-8">
            		<a class="navbar-brand mobile-nav" href="../index.php"><img src="/images/hindi-logo.png"></a>
              </div>
                <div class="col-2">
             		 <a class="navbar-brand mobile-nav" href="https://shyambabadham.com/en"><button class="btn lang mt-3">English</button></a>
               </div>
               <div class="col-2">
		            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		            <span class="navbar-toggler-icon"></span>
		            </button>
		        </div>
		    </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="dashboard_temp/index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="member3.php">Members</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="viewmember.php">View Members</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="PHP_Bolt-master/Online_Donation.php">Payment</a>
                   </li>
                      <li class="nav-item">
                    <a class="nav-link" href="https://shyambabadham.com/agent/data_updation.php">Data Updation</a>
                  </li>
                  
                  <!--<li class="nav-item">-->
                  <!--   <a class="nav-link" href="Recipt.php">Donation</a>-->
                  <!--</li>-->
                  <!--<li class="nav-item">-->
                  <!--   <a class="nav-link" href="ViewDonation.php">View Donation</a>-->
                  <!--</li>-->
                  <li class="nav-item">
                     <a class="nav-link" href="./admin/change_password.php">Change Password</a>
                <!--   <li class="nav-item">
                     <a class="nav-link" href="https://shyambabadham.com/en">English</a>
                  </li>-->
                  </li>
            
                   <li class="nav-item">
                     <a class="nav-link" href="./admin/logout.php">Log Out</a>
                  </li>
               </ul>
            </div>
         </nav>
      </div>
  	
  	
  	
  	
  
   <?php }else{ ?>
   
   	
  	
  	
    <div class="container-fluid header">
         <ul class="nav justify-content-center hiddenxs">
            <li class="nav-item">
               <a class="nav-link active" href="../index.php">मुख्य पेज</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../about_us.php">धाम के बारे में</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../mandir.php">मंदिर</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../facilities.php">सुविधाएं</a>
            </li>
            
            <li class="nav-item nav-img">
               <a class="nav-link " href="../index.php">
                   <div class="hindilogo">
                    <img class="logoimg" src="../images/hindi-logo.png">
                  </div>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../membership.php">सदस्यता</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="member3.php">समिति</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../gallery.php">चित्रशालाएं</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../contact-us.php">संपर्क</a>
            </li>
            
          
                  
              <li class="nav-item">
               <a class="nav-link lang-align" href="member3.php"><button class="btn lang">English</button></a>
            </li>
         </ul>
         <nav class="navbar navbar-expand-lg navbar-light bg-light d-block d-sm-none">
         	<div class="row">
              <div class="col-8">
            		<a class="navbar-brand mobile-nav" href="../index.php"><img src="../images/hindi-logo.png"></a>
              </div>
                <div class="col-2">
             		 <a class="navbar-brand mobile-nav" href="member3.php"><button class="btn lang mt-3">English</button></a>
               </div>
               <div class="col-2">
		            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		            <span class="navbar-toggler-icon"></span>
		            </button>
		        </div>
		    </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="../index.php">मुख्य पेज</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="../about_us.php">धाम के बारे में</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="../mandir.php">मंदिर</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="../facilities.php">सुविधाएं</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="../membership.php">सदस्यता</a>
                   </li>
                  
                  <li class="nav-item">
                     <a class="nav-link" href="member3.php">समिति</a>
                  </li>
                  <li class="nav-item">
                      <li class="nav-item">
               <a class="nav-link" href="../gallery.php">चित्रशालाएं</a>
            </li>
                     <a class="nav-link" href="../contact-us.php">संपर्क</a>
                
                   
                   
                   <li class="nav-item">
                     <a class="nav-link" href="member3.php">English</a>
                  </li>
                  </li>
               </ul>
            </div>
         </nav>
      </div>
   
   
   <?php  
   }
   ?>