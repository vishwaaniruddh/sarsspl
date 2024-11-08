<?php
if (!isset($_SESSION)) session_start();
include("config.php");
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
    
    
<style>
html,
body {
  height: 100%;
}
body {
  background: #e6e6e6;
  font-family: 'Source Sans Pro', sans-serif;
}
.container {
  width: 100%;
  height: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}
h1 {
  font-family: 'Alegreya Sans', sans-serif;
  font-weight: 300;
  margin-top: 0;
}
.control-group {
  display: inline-block;
  vertical-align: top;
  background: #fff;
  text-align: left;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  padding: 30px;
  width: 200px;
  height: 210px;
  margin: 10px;
}
.control {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 18px;
}
.control input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.control__indicator {
  position: absolute;
  top: 2px;
  left: 0;
  height: 20px;
  width: 20px;
  background: #e6e6e6;
}
.control--radio .control__indicator {
  border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
  background: #ccc;
}
.control input:checked ~ .control__indicator {
  background: #2aa1c0;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
  background: #0e647d;
}
.control input:disabled ~ .control__indicator {
  background: #e6e6e6;
  opacity: 0.6;
  pointer-events: none;
}
.control__indicator:after {
  content: '';
  position: absolute;
  display: none;
}
.control input:checked ~ .control__indicator:after {
  display: block;
}
.control--checkbox .control__indicator:after {
  left: 8px;
  top: 4px;
  width: 3px;
  height: 8px;
  border: solid #fff;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
  border-color: #7b7b7b;
}
.control--radio .control__indicator:after {
  left: 7px;
  top: 7px;
  height: 6px;
  width: 6px;
  border-radius: 50%;
  background: #fff;
}
.control--radio input:disabled ~ .control__indicator:after {
  background: #7b7b7b;
}
.select {
  position: relative;
  display: inline-block;
  margin-bottom: 15px;
  width: 100%;
}
.select select {
  display: inline-block;
  width: 100%;
  cursor: pointer;
  padding: 10px 15px;
  outline: 0;
  border: 0;
  border-radius: 0;
  background: #e6e6e6;
  color: #7b7b7b;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}
.select select::-ms-expand {
  display: none;
}
.select select:hover,
.select select:focus {
  color: #000;
  background: #ccc;
}
.select select:disabled {
  opacity: 0.5;
  pointer-events: none;
}
.select__arrow {
  position: absolute;
  top: 16px;
  right: 15px;
  width: 0;
  height: 0;
  pointer-events: none;
  border-style: solid;
  border-width: 8px 5px 0 5px;
  border-color: #7b7b7b transparent transparent transparent;
}
.select select:hover ~ .select__arrow,
.select select:focus ~ .select__arrow {
  border-top-color: #000;
}
.select select:disabled ~ .select__arrow {
  border-top-color: #ccc;
}


</style>
    <script>
    
    
    var interval1=null;
    function setintvfunc(reqid)
    {
    
interval1=setInterval('doSomething('+reqid+')',3000);

    }
    
    
     function doSomething(reqid) 
      {
    
         try
        {
            
             $.ajax({
             type: "POST",
             url: "get_quiz_req_status.php",
			 
             data: 'reqid='+reqid+'&sts=3',
			
             success: function(msg)
             {
     		
     		   // alert("chk"+msg);
     		
                  if(msg!=0)
                  {
                      window.clearInterval(interval1);
                 
                      document.getElementById('formf').submit();
     	
                  }
                  		
			  },
			 error: function (request, status, error) 
			     {
                 alert(request.responseText);
                 }
         });
           
            
        }catch(ex)
        {
            
            alert(ex);
        }
   
    
    
      }
    
    
  
    
    function subfunc(sts,id)
    {
        try
        {
            md1.style.display="block";
    
             $.ajax({
             type: "POST",
             url: "quiz_reqs_action.php",
			 
             data: 'status='+sts+'&id='+id,
			
             success: function(msg){
     		
     	//alert(msg);
     		
     		
     		if(msg==1)
     		{
     		  	setintvfunc(id);
     	  
     		    
     		}else
     		{
     		    
     		    alert("Error");
     		
     		      md1.style.display="none";
    
           
     		}
			
			  },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
           
            
        }catch(ex)
        {
            
            alert(ex);
        }
    }
    
    
    
function getreqfunc(frndid)
{
    
    try
    {
        
    $.ajax({
             type: "POST",
             url: "get_quiz_request.php",
			 
             data: '',
			
             success: function(msg){
             
              // alert(msg);
			 
			 
			  },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
   
    
        
    }catch(ex)
    {
        
        alert(ex);
    }
    
    
}

</script>
</head>

<body onload="">
        <form method="post" id="formf" action="quiz.php">
  <input  type="text" id="reqid" name="reqid" readonly>

    
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
      
      
      
        <div id="show" style="height:150px;">
</div>

    </header>


    <div class="wrapper">

    
    <div id="shwfrndsdiv">
        
 <table>
 
       <?php     
      $qrt=mysqli_query($con,"select * from quiz_requests where friend_id='".$_SESSION["userid"]."' and status=0");
      
      while($rws=mysqli_fetch_array($qrt))
      {
          
          
           $result2sl = mysqli_query($con,"select * from quiz_regdetails where id='".$rws["user_id"]."'  ");
 $nrtyu=mysqli_num_rows($result2sl); 
 $rwsc2n=mysqli_fetch_array($result2sl);
 $nm=$rwsc2n["name"]." ".$rwsc2n["lname"];
 
 if($rwsc2n["img_path"]!="")
 {
    
   $imgs=$rwsc2n["img_path"]; 
 }
 ?>
 
<tr>
    <td>
       <img src="<?php echo $imgs;?>">
       <?php echo $nm;?>
    </td>
    <td>
       <button type="button" onclick="subfunc(1,<?php echo $rws["id"]; ?>)">Accept</bbutton>
       
       <button type="button" onclick="subfunc(2,<?php echo $rws["id"]; ?>)">Reject</bbutton>
    </td>
</tr>
<?php } ?>
</table>
        
       
    
    </div>
    
    
    </div>  
    
<?php include("loading_modal.php");?>    



<?php include("footer.php");
mysqli_close($con);
?>
 

    </div>
 </div>
 
 </form>
</body>

</html>
