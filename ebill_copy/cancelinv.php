<?php

include("config.php");
$qid=$_GET['qid'];
//echo $qid;

?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">     
      
   function delfunc()
   {
   
var reqid=document.getElementById('reqid').value;
   var conf=confirm('Do you really want to Unclub the record?');
    
 

if(conf==true)
{


$.ajax({
            type: "POST",
            url: "remv_clubbed.php",
    
            data: {reqid:reqid},
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(msg){
               
                 
                alert(msg);
                window.open('cancelinv.php','_self');
               
                
            }
        });

}


   }   
      
      
      
      
      function func()
{

var reqid=document.getElementById('reqid').value;

//alert(reqid);
$.ajax({
   type: 'POST',    
url:'getreqdetails.php',
data:'reqid='+reqid,
success: function(msg){

//alert(msg);
 document.getElementById('show').innerHTML=msg;
         }
     });

}
      
      
</script>
</head>
<body>
<center>
<?php include("menubar.php"); ?>
<h2>Unclub</h2>
<div id="maind">
<form id="frmup1" name="frmup1"  method="post" >

<div id="mdiv" <label>Request Id</label><input type="text" id="reqid" name="reqid" />

 <input type="button" name ="search" id="search" value="Search" onclick="func()"/></div>

<div id="show"></div>

</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</center>
</body>

</html>





