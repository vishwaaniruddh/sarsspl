<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];

include "config.php"; 
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Meta -->
  <meta charset="UTF-8">
  <meta name="author" content="Acura">
  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <!-- Title -->
  <title>Merchant-Change password</title>
  <?php
  include('header.php');
  ?> 
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Section</span></h1>
         <!-- <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">User Panel</a></li>
            </ul>
          </div>-->
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-8">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Change Password Section </strong></h3>
            </header>
            <div class="widget-body">
             <div>
                 
                 <script>
                     function validation(){
                         	 var oldpass=document.getElementById('passwd').value;
                         	
                         var cpass=document.getElementById('cpasswd').value;
                         
                         var nwpass=document.getElementById('npasswd').value;
                         
                          //alert("test");
                        if(cpass=="" || nwpass=="" || oldpass==""){
                            
                             alert('All feilds are required!!');
                              return false;
                        }
                        
                         if(cpass!=nwpass){
                             alert('confirm password not matched!!');
                            return false;
                         }
                         return true;
                         
                     }
                     
                     
                     function changepass(){
                         try{
                         if(validation()){
                             
                          var cnfpass=document.getElementById('cpasswd').value;
                         var newpass=document.getElementById('npasswd').value;
                         var oldpass=document.getElementById('passwd').value;
                         if (confirm("Are you sure, you want to Change your password?")) {
                             
                             $.ajax({
             type: "POST",
             url: "submitchangepasswd.php",
			
             data: 'cnfpass='+cnfpass+'&newpass='+newpass+'&oldpass='+oldpass,
			
             success: function(msg){
              
            // alert(msg);
			   if(msg==1)
			   {
				   
				  alert("Your Password has been sucessfully changed.");
				  window.open('welcome.php','_self');
			   }else if(msg==5)
			   {
				   
				  alert("old Password is incorrect!!");
			   }
			   else
			   {
				   alert("Error! Please try again!!!");

				   
				   window.location.reload();
			   }
			   
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
			   
             },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
                         }
                         	
                         }
                         }catch(e){
                             
                             alert(e);
                         }
                     }
                     
                 </script>
      
  
   <form id="form11" name="form11" method="post"  >
	                                      <table  class="tables" cellpadding="4" cellspacing="0" >
                                                
                                                <tr>
                                                  <td><span class="style30">Please enter your old password </span></td>
                                                  <td  ><input type="password" name="passwd" id="passwd"  class="form" required/></td>
                                                </tr>
                                                <tr>
                                                  <td ><div align="left">Enter your new password </div></td>
                                                  <td><input class="form" type="password" id="npasswd" name="npasswd"  required/></td>
                                                </tr>
                                                <tr>
                                                                                                                                                 
                                              
                                                  <td><div align="left">Confirm your password  </div></td>
                                                  <td ><input type="password" name="cpasswd" id="cpasswd" class="form"  required/></td>
                                                  
                                                </tr>
                                                <tr><td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="button" value="Change" id="submit" name="submit" class="btn btn-submit" onclick="changepass();"/></td><td>
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" id="submit" name="submit" class="btn btn-error"  onClick="history.go(-1);"/>
      </td></tr>
		                                
        </table>
       </form>
     </div>
 
</div>
          </div>
        </div>
      </div>
    </div>
        
       <!-- Footer 
      <footer class="footer grid-12" >
        <ul class="footer-sitemap grid-12" >
          <li><a href="http://www.1clickguide.org">Home</a><span>/</span></li>
          
          <li><a href="http://www.1clickguide.org/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2013 1clickguide.org. All rights Reserved!
        </div>
      </footer>-->
    </div>
  </div>
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>