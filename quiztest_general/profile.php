<?php
session_start();
include("config.php");
$result2 = mysqli_query($con,"select * from quiz_regdetails where id='".$_SESSION['userid']."'");
$rwsc2=mysqli_fetch_array($result2);
$imgs="img/download.png";

if($rwsc2["img_path"]!="")
{
   $imgs=$rwsc2["img_path"];
}
//echo $imgs;
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
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <?php include("includeinallpages.php");?>
    <script>
    function fn()
    {
        //$("#show").load("indexslider");
    }
    
    function validation()
{

try
{

 $(".errlable").css("display", "none");

var name=document.getElementById('name').value;
var lname=document.getElementById('lname').value;
var email=document.getElementById('email').value;


var class1=document.getElementById('class1').value;
var schn=document.getElementById('schname').value;



 var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

var errc="Red";
var errexs=0;


if(class1=="")
{
document.getElementById("label5").innerHTML="Select Class  !";
 document.getElementById("label5").style.color=errc;
 document.getElementById("label5").style.display="block";
 document.getElementById("label5").focus();

errexs++;
}


if(schn=="")
{
document.getElementById("label4").innerHTML="Enter School Name !";
 document.getElementById("label4").style.color=errc;
 document.getElementById("label4").style.display="block";
 document.getElementById("label4").focus();

errexs++;
}


if(email!="")
{
//alert(email);    
if(!re.test(email))
{
document.getElementById("label3").innerHTML="Enter Your Valid Email !";
 document.getElementById("label3").style.color=errc;
 document.getElementById("label3").style.display="block";
 document.getElementById("label3").focus();

errexs++;
}
}

/*if(email=="")
{
document.getElementById("label3").innerHTML="Enter Your Email !";
 document.getElementById("label3").style.color=errc;
 document.getElementById("label3").style.display="block";
errexs++;

}
*/

if(lname=="")
{
document.getElementById("label2").innerHTML="Enter Your Last Name !";
 document.getElementById("label2").style.color=errc;
 document.getElementById("label2").style.display="block";
document.getElementById("label2").focus();

errexs++;

}


if(name=="")
{
document.getElementById("label1").innerHTML="Enter Your First Name !";
 document.getElementById("label1").style.color=errc;
 document.getElementById("label1").style.display="block";
//alert('Enter Your Name');
document.getElementById("label1").focus();

errexs++;

} 




}catch(ex)
{
    
    alert(ex);
}

if(errexs==0)
{
    
    
    return true;
}else
{
    
    document.getElementById("label10").innerHTML="Rectify Validation Errors to continue";
 document.getElementById("label10").style.color=errc;
 document.getElementById("label10").style.display="block";

    
    return false;
}

}

    
    function subfunc()
    {
      
      try
      {
        
        if(validation())
        {
            
            if(chkmailexs())
            {
                
               
      var formData = new FormData($('#formf')[0]);
       $.ajax({
       url: 'edit_process.php',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
        // alert(response);
         
         
         if(response=="1")
         {
             
             //swal("","Registration successful","success");
             
             swal({
                        title: "",
text: "Update successful",            
type: "success",
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'OK',
                    },
    function (isConfirm) {

        if (isConfirm) {
            window.location.reload(true);

} else {
        }
    }); 
             
         }else
         {
             
             swal("","Error","error");
         }
       }
       
  
   
   
   });
        
            }
        
        }
    
    }catch(ex)
   {
       
       
       
   }
    }
    
    
    var bool = false; 
function chkmailexs()
{


var email=document.getElementById('email').value;
var orgemail=document.getElementById('orgemail').value;


if(email!="")
{
if(orgemail!=email)
{

var exs="0";
//alert(email);
$.ajax({
   type: 'POST',
   url: 'checkpg.php',
   data:"val="+email+"&sts=1",
   error: function() {
      
   },
success: function(data) {

//alert(data);

if(data>0)
{

document.getElementById("label3").innerHTML="Email id Already Exists !";
document.getElementById("label3").style.color="Red";
document.getElementById("label3").style.display="block";
bool = false;
}
else
{
document.getElementById("label3").innerHTML="";
document.getElementById("label3").style.display="none";

bool = true;
}

  },error: function (data) {
            bool = false;
        }

});
}else
{
    
bool = true;
    
}
}
else
{
bool = true;

}

return bool;
}

 
    var bool2 = false; 
function chkusenmxs()
{


var usn=document.getElementById('uname').value;
//alert(usn);
if(usn!="")
{
var exs="0";
//alert(email);
$.ajax({
   type: 'POST',
   url: 'checkpg.php',
   data:"val="+usn+"&sts=2",
   error: function() {
      
   },
success: function(data) {

//alert(data);

if(data>0)
{

document.getElementById("label6").innerHTML="User Name already Exists !";
document.getElementById("label6").style.color="Red";
document.getElementById("label6").style.display="block";

//document.getElementById('uname').focus();
bool2 = false;
}
else
{
document.getElementById("label6").innerHTML="";
document.getElementById("label6").style.display="none";
bool2 = true;
}

  },error: function (data) {
            bool2 = false;
        }

});

}
else
{
bool2 = true;

}

return bool2;
}


function showedfunc(sts)
{
    
    if(sts=="1")
    {
        
        $('.editc').show();
         $('.viewc').hide();
    }
    
}
 
    </script>
    
    <style>
    label{
        font-size:16px;
        color:#fff;
        text-align:center;
    }
    
    .card {
    background:-moz-linear-gradient(-45deg, #cc6698 0%, #6b396c 100%) ;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 70px 70px rgba(0, 0, 0, 0.3);
}
    
    </style>
</head>
<body onload="">
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
      <?php
      include('menu.php');
      ?> 
    <div>
    <section id="reviews" class="editc" style="display:none">
            <div class="container">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <br><br>
                     <h1 style="color:cyan;">Your Profile</h1>
                    <div class="divider"></div>
                    
                
                </div>
               <div class="row">
                    <div  class="col-md-4"></div>
                    
                    <div class="col-md-4" style="margin-top:-130px;">
                         <div class="card " >
                        <div class="row">
                            <div class="col-md-12 col-sm-12 scrollpoint sp-effect3">
                                <form role="form" id="formf" enctype='multipart/form-data'>
                                    <div class="form-group">
                                       <label ><font color="Red"size="6">*</font><b>First name:</b></label><label id="label1" class="errlable">
                                           
                                       </label>
          <input type="text" id="name" name="name" class="form-control" value='<?php echo $rwsc2['name'];?>'>
                                    </div>
                                    <div class="form-group">
                                        
                                        
                                        <label for="lname"><font color="Red"size="6">*</font><b>Last name:</b></label><label id="label2" class="errlable"></label>
          <input type="text" id="lname" name="lname"  class="form-control" value='<?php echo $rwsc2['lname'];?>'>
          
                                    </div>
                                    <div class="form-group">
                                     <label for="mail"><b>Email:</b></label><label id="label3" class="errlable"></label>
          <input type="email" id="email" name="email"  onblur="chkmailexs();"  class="form-control" value='<?php echo $rwsc2['emailid'];?>'>
          
          <input type="hidden" id="orgemail" name="orgemail"  class="form-control" value='<?php echo $rwsc2['emailid'];?>'>
          
                                    </div>
                                    
                                      <div class="form-group">
                                     <label for="img"><b>Profile Image:</b></label>
                                       <input type="hidden"  name="oldimg" id="oldimg" value='<?php echo $rwsc2['img_path'];?>' class="form-control" >
         
          <input type="file" id="img" name="img">
           <div class="tp-caption mediumlarge_light_white " data-x="left" data-y="center"  data-easing="Power4.easeOut">
                           <img src="<?php echo $imgs;?>" style="width:120px; height:120px; margin-top:110px;" alt="">
                        </div>
          
                                    </div>
                                    
                                    
                                  <div class="form-group">
                                     <label for="img"><font color="Red"size="6">*</font><b>School  Name:</b></label><label id="label4" class="errlable"></label>
          <input type="text"  name="schname" id="schname" value='<?php echo $rwsc2['school'];?>' class="form-control" >
          
                                    </div>
                                       
                                    
                                    
                                     <div class="form-group">
                                     <label for="board"><font color="Red"size="6">*</font><b>Class:</b></label><label id="label5" class="errlable"></label>
 
         <select name="class1" id="class1"  class="form-control" >
<?php

$qrstd=mysqli_query($con,"select * from std_details");
while($strws=mysqli_fetch_array($qrstd))
{

?>

<option value='<?php echo $strws[1]; ?>' <?php if($strws[1]==$rwsc2['class']){ echo "selected"; } ?> ><?php echo $strws[2]; ?></option>

<?php } ?>

</select>
                                    </div>
 
 
                        <!-- <div class="form-group">
                                    <label for="password"><font color="Red"size="6">*</font><b>User name:</b> </label><label id="label6" class="errlable"></label>
          <input type="text" id="uname" name="uname" maxlength="20" class="form-control" onblur="chkusenmxs();">
                                    </div>
                                                      
 <div class="form-group">
                                    <label for="password"><font color="Red"size="6">*</font><b>Password:</b> </label><label id="label7" class="errlable"></label>
          <input type="password" id="password" name="password" maxlength="20" class="form-control" >
                                    </div>
                               

<div class="form-group">
                                    <label for="password"><font color="Red"size="6">*</font><b>Confirm Password:</b> </label><label id="label8" class="errlable"></label>
          <input type="password" id="cpassword" name="cpassword" maxlength="20" class="form-control">
                                    </div>-->
 
<div><center>
                                    <button type="button" class="btn btn-default btn-lg" onclick="subfunc();">Submit</button>
                                    
                                    <button type="button" class="btn btn-default btn-lg" onclick='window.open("index.php","_self");'>Cancel</button>
                                    
                                   <label id="label10" class="errlable"></label>
    </center>
    </div>
    <div>
       <br/>
        </div>
                                </form>
                            </div>
    </div>
            </div>
        </section>
        
        </div>
        <div>
    
     <section id="reviews" class="viewc" >
            <div class="container">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <br><br>
                     <h1 style="color:cyan;">Your Profile</h1>
                    <div class="divider">
                    </div>
                </div>
               <div class="row">
                    <div  class="col-md-4">
                    </div>
                    <div class="col-md-4" style="margin-top:-130px;">
                         <div class="card " >
                        <div class="row">
                            <div class="col-md-12 col-sm-12 scrollpoint sp-effect3">
                                <form role="form" id="formf" enctype='multipart/form-data'>
                                    <div class="form-group">
                                        <img src="<?php echo $imgs;?>" style="width:120px; height:120px; margin-top:110px;" alt="">
                                    </div>
                                    <div class="form-group">
                                       <label><b>First name:</b>  <?php echo $rwsc2['name'];?></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname"><b>Last name:</b>   <?php echo $rwsc2['lname'];?>
                                    </div>
                                    <div class="form-group">
                                     <label for="mail"><b>Email:</b>  <?php echo $rwsc2['emailid'];?></label>
                                    </div>
                                  <div class="form-group">
                                     <label for="img"><b>School Name:</b>  <?php echo $rwsc2['school'];?>
                                </div>
                                <div class="form-group">
                                    <label for="board"><b>Class:</b>
                                    <?php echo $rwsc2['class'];?>
                                    </label>
                                </div>
                                <div>
                                    <center>
                                        <button type="button" class="btn btn-default btn-lg" onclick="showedfunc(1);">Edit</button>
                                        <button type="button" class="btn btn-default btn-lg" onclick='window.open("index.php","_self");'>Cancel</button>
                                    </center>
                                </div>
                            <div>
       <br/>
        </div>
                                </form>
                            </div>
    </div>
            </div>
        </section>
        
        </div>
        
        
        
        
    </header>


        <?php include("footer.php");
        mysqli_close($con);
        ?>   


    </div>
    
    
   </div>
   </section>
</body>

</html>
