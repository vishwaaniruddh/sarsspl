<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{   
$id=$_SESSION['id'];
//echo $_POST["slotid"];
include "config.php"; 
$sql = mysqli_query($con1,"select * from clients where code='$id'");
        $row = mysqli_fetch_array($con1,$sql);             
        $catst = $row['category']; //echo $catst;
        
               /*       $qry="select code from cities";
                       $res=mysqli_query($con1,$qry);                
                          $num=mysqli_num_rows($res);

                         $qry1="select name,id from main_cat where under=".$row['cid'];
                          $res1=mysqli_query($con1,$qry1);                
                          $num1=mysqli_num_rows($res1); 
                          
                           $qry2="select * from main_cat";
                          $res2=mysqli_query($con1,$qry2);                
                          $num2=mysqli_num_rows($res2); */
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
  <title>Upload Ad</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="media/favicon.png">
  <script>
  
 function val()
 {
     
     try
     {
         
         var dt1=document.getElementById('rdate').value;
 var dt2=document.getElementById('tdate').value;
 
 if(dt1.trim()=="")
 {
     alert("Select from date");
     document.getElementById('rdate').focus();
     return false;
 }else if(dt2.trim()=="")
 {
     alert("Select to date");
          document.getElementById('tdate').focus();
          return false;
     
 }else
 {
     return true;
 }

         
     }catch(ex)
     {
         alert(ex);
         
     }
     
 }
 
 var bl=false;
  function checkavailfunc()
  {
try
{
 
 if(val())
 {
 var dt1=document.getElementById('rdate').value;
 var dt2=document.getElementById('tdate').value;
 var slotid=<?php echo $_GET["cvxrtqweroerfer"];?>;
 var slotpos=<?php echo $_GET["gvhjyuskaertfer"];?>;
//  alert("testing");
//alert(slotid);
 $.ajax({
   type: 'POST',
   async: false,
url:'check_slotbooking_availability.php',
data:'dt1='+dt1+'&dt2='+dt2+'&slotid='+slotid+'&slotpos='+slotpos,
success: function(msg){
   alert(msg);

if(msg==0)
{
    document.getElementById('st2').style.display="block";
    bl=true;
    
}else
{
  alert("Sorry this period is not available");  
     document.getElementById('st2').style.display="hidden";
     bl=false;
}

         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
     
     
 }
return bl;   
}catch(exc)
{
    alert(exc);
}

  }


function subfunc1()
{
 
 if(checkavailfunc())
 {
    subfunc();
    return false;
 }
 return false;
}

function subfunc()
{
   
try
{
    
     if(checkavailfunc())
 {
    var dt1=document.getElementById('rdate').value;
    var dt2=document.getElementById('tdate').value;
    var totamt=0;
    //=document.getElementById('amt').value;
    var slotid='<?php echo $_GET['cvxrtqweroerfer'];?>'; 
    var slotpos='<?php echo $_GET['gvhjyuskaertfer'];?>'; 
     
    var fd=new FormData($('#formf')[0]);
  fd.append('dt1',dt1);
  fd.append('dt2',dt2);
  fd.append('amt',totamt);
   fd.append('slotid',slotid);
fd.append('slotpos',slotpos);

  $.ajax({
            url: "process_slotbooking.php",
            type: "POST",
            data:fd,    
            contentType: false,
            cache: false,
            processData:false,
beforeSend:function() {
$("#Submit").attr("disabled", true);  


            },
             
            success: function(text){
    //alert("teststt");           
      alert(text);
          


if(text==1)
{
alert("Slot Booked Successfully !!");
location.reload();
}
else if(text==3)
{
alert("Error in uploading video");
}
else if(text==5)
{
alert("sql error");

} 
else if(text==50)
{
alert("Session has been expired");
window.open("logout.php");

} 


 $("#Submit").attr("disabled", false);  
 document.getElementById('Submit').innerHTML="Submit";             
           },
    error: function (request, status, error) {
        alert(request.responseText);
    }
        });
 }
        
}catch(exc)
{
    alert(exc);
}
    return false;
}




 
  
  </script>
</head>
<?php

include('header.php');
?>        
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <div class="sitemap grid-6">
            <ul>
              <li><span>allmart</span><i>/</i></li>
              <li><a href="index.php">Vendor Panel</a></li>
            </ul>
          </div>
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Book Slot</strong></h3>
            </header>
            <div class="widget-body" >
<form method="post" action="" onsubmit="return subfunc();" id="formf" name="formf">
             <div>
               <div>  
                 Select Period for which the ad will be displayed<br>
                    <input type="text" name="rdate[]" id="rdate"  class="inp-form" placeholder="from date" readonly/></td>
               <td><input type="text" name="tdate[]" id="tdate"  class="inp-form" placeholder="to date" readonly/></td>
               <td><input type="button" name="chk" id="chk"  class="inp-form" value="Check Availibility" onclick="checkavailfunc();"/></td>

                <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>
<script>
$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
$('#tdate').dcalendarpicker({format: 'dd-mm-yyyy'});
</script>
  </div>
  
  <div id="st2" style="display:none;">
  <input type="submit" name="Submit" id="Submit" value="Book" >
  <script>
  $('#adup').on('click touchstart' , function(){
    $(this).val('');
});

  </script>
  </div>
    
<div id="shprogdiv" style="display:none;">
<progress id="prog" max="100" value="0" style="height:30px"></progress><br>
<input style="width:100px;" type="text" id="shperc" readonly/>
</div>
   <table class="tables"   align="center" style="height:300px;">
                 
                                               
        </table>
  
     </div>
 </form>
</div>
          </div>
        </div>
      </div>
    </div>
        
       
   <!-- Footer
      <footer class="footer grid-12" >
        <?php include('footer.php'); ?>
      </footer>-->
    </div>
  </div>
 
  <!-- Go top -->
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>