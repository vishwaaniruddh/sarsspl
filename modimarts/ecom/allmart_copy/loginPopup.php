<!DOCTYPE html>
<html>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <head>
                <script>
                    function popup(){
                        document.getElementById('id01').style.display='block';
                    }
                    function popupclose(){
                        
                      document.getElementById('id01').style.display='none';
                      //  window.open("index.php","_self");
                    }
                    
                </script>
                
            </head>
          

<body onload="popup()">



<div class="w3-container">
  
 <!-- <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Open Animated Modal</button>-->

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4" style="width: 559px;">
      <header class="w3-container w3-teal" style="background-color:#0acefb!important "> 
        <span onclick="popupclose()" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 style="margin-left: 110px;">Welcome To Merabazzar</h2>
      </header><br />
      <div class="w3-container">
        
        
        
        
        <div class="row">                <div id="content" class="col-sm-9">      <div class="row">
        <div class="col-sm-4">
         
        </div>
        <div class="col-sm-8">
          <div class="well">
           
            
            <img src="image/TLlogin.gif" alt="Login" height="72" style="align:center;width: 170px;margin-left: 18px;height: 93px;" width="72"/>
            <form action="process_login.php" method="post" enctype="multipart/form-data" style="width: 463px;margin-left: 47px;">
              <div class="form-group">
                <label class="control-label" for="input-email">E-Mail Address</label>
                <input type="text" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password">Password</label>
                <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
                <a href="forgot_pass.php">Forgotten Password</a></div>
              <input type="button" value="Login" id="button-login" class="btn btn-primary" onclick="logfnn();"/>
              <input type="button" value="Sing up" id="signup" class="btn btn-primary" style="margin-left: 53px;" onclick=""/>
                          </form>
          </div>
        </div>
      </div>
      </div> </div>
        
        
        
        
  
<script type="text/javascript">

function logfnn()
{
   
     var eml=document.getElementById('input-email').value;
    var passw=document.getElementById('input-password').value;
   
    $.ajax({
        url: 'loginprocessnew.php',
        type: 'post',
        data:'email='+eml+'&password='+passw,
        success: function(msg) {
           alert(msg)
            if (msg==1) {
                location = 'index.php';
            } else {
            }
        }
    });
}
</script>
        
        
      </div>
      <footer class="w3-container w3-teal" style="background-color:#0acefb!important">
        <p>Merabazzar</p>
      </footer>
    </div>
  </div>
</div>
          
</body>
</html>
