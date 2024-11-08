<!DOCTYPE html>
<html>
    <head>
        <title>history</title>
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


.div3 {
    background-color: #28ece3;
    border: 1px solid #dddddd;
    padding: 20px 20px;
    margin: 0px 0;
    height: 510px; overflow: scroll;
  
 
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

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    
    background-color: #fff;
    font-size:16px;padding:8px;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 10px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<script>

 function gethis(pg)
    {
      
      try
      {
           $.ajax({
       url: 'getHistory.php',
       type: 'POST',
       data: 'page='+pg,
       success: function (response) {
         alert(response);
         
        //$("#shwf").append();
        
        
      //  var jsr=JSON.parse(response);
    document.getElementById("shwf").innerHTML=response;  
         
      }

   
   
   });
      }catch(ex)
      {
          
          alert(ex);
      }
    }
   
</script>
<body class="body" onload="gethis();">
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
        </header>
      <div class="wrapper">
 <div class="container" >
<form id="formf" method="post"  style="margin-top:15%;">
 
 
 <div id="shwf">
      </div>
</form>
 </div>
</body>
</html>
