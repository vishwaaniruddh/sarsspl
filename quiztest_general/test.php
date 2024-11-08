<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->

<?php 
     
     if($_GET['aid']=="1")
            {
                $cntd="20";
                
            }else if($_GET['aid']=="2")
            {
                $cntd="15";
                
            }else if($_GET['aid']=="3" || $_GET['aid']=="4")
            {
                $cntd="10";
                
            } 
            
            $aid=$_GET['aid'];
     //echo "ctimer".$cntd;       
                ?>

<html lang="en" class="no-js">
<!--<![endif]-->


<head>
    <meta charset="UTF-8">
    <title>Quiz2shine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.png">
    
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/js/rs-plugin/css/settings.css">

    <link rel="stylesheet" href="assets/css/styles.css">

    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
     <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet" />
       

    <script type="text/javascript" src="assets/js/modernizr.custom.32033.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
 <style>
 
 #tm{
  background-color:#419D78;
  color:#EFD0CA;
  font-size:20px;
  text-align:center;
}
 
 
 </style>
 <script>
     function findGif(){
         swal({
                        title: "",
text: "<img src='img/thumbs-up.gif' style='width:150px;'>",
        html: true,                        
type: "",
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'OK',
                    },
    function (isConfirm) {

        if (isConfirm) {
} else {

        }
    }); 
     }
     

function losefunc(){
    
   //  $('div').fireworks('destroy');
         swal({
                        title: "",
text: "<img src='img/thumbs-down.gif' style='width:150px;'>",
        html: true,                        
type: "",
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'OK',
                    },
    function (isConfirm) {

        if (isConfirm) {
} else {

        }
    }); 
     }
 </script>
    <script>
    
    function getqfunc(sts)
    {
        
        try
        
        {
            
            
            
           var qn= document.getElementById("qno").value;
           var mcqn="1";
           
          //  var mcqn=parseInt(qn)+parseInt(1);
    
    //var qn
            if(sts==" ")
           {
               
             qn=parseInt(qn)+parseInt(1);  
                mcqn=parseInt(qn)+parseInt(1);
                document.getElementById("qno").value=qn;
           }
           
           if(sts=="1")
           {
               
             qn=parseInt(qn)+parseInt(1);  
                mcqn=parseInt(qn)+parseInt(1);
                document.getElementById("qno").value=qn;
     
           }
           
           if(sts=="2")
           {
              // alert(qn);
               mcqn=parseInt(qn)+parseInt(1)-parseInt(1);
            
               qn=parseInt(qn)-parseInt(1);  
                document.getElementById("qno").value=qn;
     
           }
         // alert(qn);
          
          //document.getElementById("qno").value
           
           
           if(parseInt(mcqn)>1)
           {
               
               document.getElementById("previous").style.display="block";
           }else
           {
               
               
               document.getElementById("previous").style.display="none";
           }
           $.ajax({
  type: "POST",
  url: "getques.php",
  data: "nxt="+qn,
  cache: false,
  success: function(data){
    // alert(data);
     
     var mcqs=data.split("##@@##");
     
     document.getElementById("mcqshw").innerHTML="("+mcqn+")"+mcqs[0];
   
  // var mcqops=mcqs[0].split("##@@##");
   
     document.getElementById("mcqoptsshw").innerHTML=mcqs[1];
   
   
  }
});
   /*        
            $.ajax({
                
  url: "getques.php",
  data: "nxt="+qn,
  success: function(msg){
      
      alert(msg);
    //$("#results").append(html);
  }
});*/
   
  
            
        }catch(ex)
        {
            
            alert(ex);
            
        }
        
        
    }
    
    
    var timeoutHandle;
function countdown(minutes,stat) {
    var seconds = 60;
    var mins = minutes;
	 
	if(getCookie("minutes<?php echo $aid.$cntd;?>")&&getCookie("seconds")&&stat)
	{
		 var seconds = getCookie("seconds<?php echo $aid.$cntd;?>");
    	 var mins = getCookie("minutes<?php echo $aid.$cntd;?>");
    	 //alert("cookie"+mins);
	}
	 
    function tick() {
		
        var counter = document.getElementById("timer");
		setCookie("minutes<?php echo $aid.$cntd;?>",mins,10)
		setCookie("seconds<?php echo $aid.$cntd;?>",seconds,10)
        var current_minutes = mins-1
        seconds--;
        counter.innerHTML ="TIME LEFT-"+
		current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
		//save the time in cookie
		
		
		
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {
             
            if(mins > 1){
                 
               // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst    
               setTimeout(function () { countdown(parseInt(mins)-1,false); }, 1000);
                     
            }
        }
    }
    tick();
}
function setCookie(cname,cvalue,exdays) {
   // alert(cname);
   try
   {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}catch(ex)
{
    
    alert(ex);
}
       
   }
 function getCookie(cname) {
     try
     {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
     }catch(ex)
{
    
    alert(ex);
}

    return "";
}


  
    </script>
    
</head>

<body onload="getqfunc('');">
    <input type="text" id="qno" name="qno" value="0">
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
        
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="fa fa-bars fa-lg"></span>
                        </button>
                        <a class="navbar-brand" href="index.html">
                           <h1 style="color:#fff;font-size:50px;">Quiz2shine</h1><!--- <img src="assets/img/freeze/logo.png" alt="" class="logo">--->
                        </a>
                        <button id="on_all" style="width: 100px;" onClick="findGif();">Win</button>
                        <button id="on_lose" style="width: 100px;" onClick="losefunc();">Lose</button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#about">about</a></li>
                            <li><a href="#features">features</a></li>
                            <li><a href="#reviews">reviews</a></li>
                            <li><a href="#screens">Play</a></li>
                            <!--<li><a href="#demo">demo</a></li>---->
                            <li><a class="getApp" href="#getApp">get app</a></li>
                            <li><a href="#support">support</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
        </nav>

         <div class="tp-banner-container">
            <div class="tp-banner" >
                <ul>
                    <!-- SLIDE  -->
                   <!-- <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <!-- MAIN IMAGE --
                        <img src="assets/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS --
                        <!-- LAYER NR. 1 --
                        <div class="tp-caption lfl fadeout hidden-xs"
                            data-x="left"
                            data-y="bottom"
                            data-hoffset="30"
                            data-voffset="0"
                            data-speed="500"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assets/img/berry/Slides/index.png"  style="height:500px;" alt="">
                        </div>

                        <div class="tp-caption lfl fadeout visible-xs"
                            data-x="left"
                            data-y="center"
                            data-hoffset="700"
                            data-voffset="0"
                            data-speed="500"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assets/img/freeze/iphone-freeze.png" alt="">
                        </div>

                        <div class="tp-caption large_white_bold sft" data-x="550" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1200" data-easing="Power4.easeOut">
                            Quiz2shine
                        </div>
                        <div class="tp-caption large_white_light sfr" data-x="770" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1400" data-easing="Power4.easeOut">
                          
                        </div>
                       <!--- <div class="tp-caption large_white_light sfb" data-x="550" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1500" data-easing="Power4.easeOut">
                            Landing Theme
                        </div>---

                        <div class="tp-caption sfb hidden-xs" data-x="550" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1000" data-start="1700" data-easing="Power4.easeOut">
                            <a href="#about" class="btn btn-primary inverse btn-lg">SIGN UP</a>
                        </div>
                        <div class="tp-caption sfr hidden-xs" data-x="730" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1500" data-start="1900" data-easing="Power4.easeOut">
                            <a href="#getApp" class="btn btn-default btn-lg">LOG IN</a>
                        </div>

                    </li>-->
                    <!-- SLIDE 2 --
                    <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
                        <!-- MAIN IMAGE --
                        <img src="assets/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS 
                        <!-- LAYER NR. 1 
                        <div class="tp-caption lfb fadeout hidden-xs"
                            data-x="center"
                            data-y="bottom"
                            data-hoffset="0"
                            data-voffset="0"
                            data-speed="1000"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assets/img/berry/Slides/quzi2.png" style="width:900px;height:400px;" alt="">
                        </div>

                        
                        <div class="tp-caption large_white_light sft" data-x="center" data-y="250" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1400" data-easing="Power4.easeOut">
                            Every Pixel <i class="fa fa-heart"></i>
                        </div>
                        
                        
                    </li>----->

                    <!-- SLIDE 3 -->
                    <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
                        <!-- MAIN IMAGE -->
                        <img src="assets/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption customin customout hidden-xs"
                            data-x="right"
                            data-y="center"
                            data-hoffset="0"
                            data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                        data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-voffset="50"
                            data-speed="1000"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <!--<img src="assets/img/berry/Slides/quiz1.jpg" style="height:400px;" alt="AI">-->
                            
                        </div>

                        <div class="tp-caption customin customout visible-xs"
                            data-x="center"
                            data-y="center"
                            data-hoffset="0"
                            data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                        data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-voffset="0"
                            data-speed="1000"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assets/img/freeze/Slides/family-freeze.png" alt="">
                        </div>

                        <div class="tp-caption lfb visible-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="400" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                            <a href="#" class="btn btn-primary inverse btn-lg">Purchase</a>
                        </div>


                        
                        <div class="tp-caption mediumlarge_light_white sfl hidden-xs" data-x="left"data-y="center"  data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                           YOU 
                           
                        </div>
                        
                         <div class="tp-caption mediumlarge_light_white " data-x="left" data-y="center"  data-easing="Power4.easeOut">
                           <img src="img/6a00d834525fff69e2013480933f66970c-600wi.png" style="width:120px; height:120px; margin-top:110px;" alt="">
                        </div>
                        
                         <div  class="tp-caption mediumlarge_light_white sft hidden-xs" style="margin-bottom:10px;max-width:100px; " data-x="center" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                            
  
                          <div id="timer" style="margin-bottom:20px;"></div>
                        </div>
                        <div class="tp-caption mediumlarge_light_white sft hidden-xs" data-x="left" style="margin-top:300px;" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                          Score
                        </div>
                        

                        <div class="tp-caption mediumlarge_light_white sfl hidden-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                           Question
                        </div>
                        
                        <div class="tp-caption mediumlarge_light_white sfl hidden-xs" data-x="right" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                           AI
                        </div>
                         <div class="tp-caption mediumlarge_light_white " data-x="right" data-y="center"  data-easing="Power4.easeOut">
                           <img src="img/Armed robot.png" style="width:120px; height:120px; margin-top:110px;" alt="">
                        </div>
                          <div class="tp-caption mediumlarge_light_white sft hidden-xs" style="margin-top:300px;" data-x="right" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                          Score
                        </div>
                        
                        
                        
                        <div  class="tp-caption mediumlarge_light_white sft hidden-xs" style="margin-left:-350px;max-width:100px; " data-x="center" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                        <DIV id="mcqshw" style="font-size:14px;"></DIV>
                        </div>
                       
                        <div class="tp-caption small_light_white sfb hidden-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="80" data-speed="1000" data-start="1600" data-easing="Power4.easeOut">
                        <ul>
                        <!--<li><a href="quiz.php?aid=4" >I am unpredictable </a></li>-->
                        </ul>
                        
                        <DIV id="mcqoptsshw" style="font-size:14px;"></DIV>
                        
                        
                        <div>
<center>
<input type="button" class="btn btn-default btn-lg" id="previous" onclick="getqfunc(2)" value="Previous">
<input type="button" class="btn btn-default btn-lg" onclick="getqfunc(1)" value="Next">

</center>
</div>

                           </div>

                      <!--  <div class="tp-caption lfl hidden-xs" data-x="left" data-y="center" data-hoffset="0" data-voffset="160" data-speed="1000" data-start="1800" data-easing="Power4.easeOut">
                            <a href="#" class="btn btn-primary inverse btn-lg">Join Now</a>-->
                        </div>
                    </li>
                </ul>
            </div>
        </div>

      
    </header>


    <div class="wrapper">

        


       <!--- <section id="about">
            <div class="container">
                
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>About Us</h1>
                    <div class="divider"></div>
                    <p>Oleose Beautiful App Landing Page</p>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="about-item scrollpoint sp-effect2">
                            <i class="fa fa-download fa-2x"></i>
                            <h3>Easy setup</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect5">
                            <i class="fa fa-mobile fa-2x"></i>
                            <h3>On-the-go</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect5">
                            <i class="fa fa-users fa-2x"></i>
                            <h3>Social connect</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect1">
                            <i class="fa fa-sliders fa-2x"></i>
                            <h3>Dedicated support</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Features</h1>
                    <div class="divider"></div>
                    <p>Learn more about this feature packed App</p>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 scrollpoint sp-effect1">
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-cogs fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">User Settings</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-envelope fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Messages Inbox</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-users fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Friends List</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-comments fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Live Chat Messages</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-calendar fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Calendar / Planner</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4" >
                        <img src="assets/img/freeze/iphone-freeze.png" class="img-responsive scrollpoint sp-effect5" alt="">
                    </div>
                    <div class="col-md-4 col-sm-4 scrollpoint sp-effect2">
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-map-marker fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">My Places</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-film fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Media Player™</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-compass fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Intuitive Statistics</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-picture-o fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Weather on-the-go</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="media active feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-plus fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">And much more!</h3>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="reviews">
            <div class="container">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>Reviews</h1>
                    <div class="divider"></div>
                    <p>Read What's The People Are Saying About Us</p>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-push-1 scrollpoint sp-effect3">
                        <div class="review-filtering">
                            <div class="review">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="review-person">
                                            <img src="http://api.randomuser.me/portraits/women/94.jpg" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review-comment">
                                            <h3>“I love Oleose, I highly rfreezemmend it, Everyone Try It Now”</h3>
                                            <p>
                                                - Krin Fox
                                                <span>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star-o fa-lg"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review rollitin">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="review-person">
                                            <img src="http://api.randomuser.me/portraits/men/70.jpg" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review-comment">
                                            <h3>“Oleaose Is The Best Stable, Fast App I Have Ever Experienced”</h3>
                                            <p>
                                                - Theodore Willis
                                                <span>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star-half-o fa-lg"></i>
                                                    <i class="fa fa-star-o fa-lg"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review rollitin">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="review-person">
                                            <img src="http://api.randomuser.me/portraits/men/93.jpg" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="review-comment">
                                            <h3>“Keep It Up Guys Your Work Rules, Cheers :)”</h3>
                                            <p>
                                                - Ricky Grant
                                                <span>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star-half-o fa-lg"></i>
                                                    <i class="fa fa-star-o fa-lg"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="screens">
            <div class="container">

                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Screens</h1>
                    <div class="divider"></div>
                    <p>See what’s included in the App</p>
                </div>

                <div class="filter scrollpoint sp-effect3">
                    <a href="javascript:void(0)" class="button js-filter-all active">All Screens</a>
                    <a href="javascript:void(0)" class="button js-filter-one">User Access</a>
                    <a href="javascript:void(0)" class="button js-filter-two">Social Network</a>
                    <a href="javascript:void(0)" class="button js-filter-three">Media Players</a>
                </div>
                <div class="slider filtering scrollpoint sp-effect5" >
                    <div class="one">
                        <img src="assets/img/freeze/screens/profile.jpg" alt="">
                        <h4>Profile Page</h4>
                    </div>
                    <div class="two">
                        <img src="assets/img/freeze/screens/menu.jpg" alt="">
                        <h4>Toggel Menu</h4>
                    </div>
                    <div class="three">
                        <img src="assets/img/freeze/screens/weather.jpg" alt="">
                        <h4>Weather Forcast</h4>
                    </div>
                    <div class="one">
                        <img src="assets/img/freeze/screens/signup.jpg" alt="">
                        <h4>Sign Up</h4>
                    </div>
                    <div class="one">
                        <img src="assets/img/freeze/screens/calendar.jpg" alt="">
                        <h4>Event Calendar</h4>
                    </div>
                    <div class="two">
                        <img src="assets/img/freeze/screens/options.jpg" alt="">
                        <h4>Some Options</h4>
                    </div>
                    <div class="three">
                        <img src="assets/img/freeze/screens/sales.jpg" alt="">
                        <h4>Sales Analysis</h4>
                    </div>
                </div>
            </div>
        </section>

        <section id="demo">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Demo</h1>
                    <div class="divider"></div>
                    <p>Take a closer look in more detail</p>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 scrollpoint sp-effect2">
                        <div class="video-container" >
                            <iframe src="http://player.vimeo.com/video/70984663"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="getApp">
            <div class="container-fluid">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>Get App</h1>
                    <div class="divider"></div>
                    <p>Choose your native platform and get started!</p>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="hanging-phone scrollpoint sp-effect2 hidden-xs">
                            <img src="assets/img/freeze/freeze-angled2.png" alt="">
                        </div>
                        <div class="platforms">
                            <a href="#" class="btn btn-primary inverse scrollpoint sp-effect1">
                                <i class="fa fa-android fa-3x pull-left"></i>
                                <span>Download for</span><br>
                                <b>Android</b>
                            </a>
                            
                                <a href="#" class="btn btn-primary inverse scrollpoint sp-effect2">
                                    <i class="fa fa-apple fa-3x pull-left"></i>
                                    <span>Download for</span><br>
                                    <b>Apple IOS</b>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="support" class="doublediagonal">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Support</h1>
                    <div class="divider"></div>
                    <p>For more info and support, contact us!</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 scrollpoint sp-effect1">
                                <form role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your email">
                                    </div>
                                    <div class="form-group">
                                        <textarea cols="30" rows="10" class="form-control" placeholder="Your message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </form>
                            </div>
                            <div class="col-md-4 col-sm-4 contact-details scrollpoint sp-effect2">
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">4, Some street, California, USA</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-envelope fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="mailto:support@oleose.com">support@oleose.com</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-phone fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">+1 234 567890</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>----->
        
        
        

        <footer>
            <div class="container">
                <a href="#" class="scrollpoint sp-effect3">
                    <img src="assets/img/freeze/logo.png" alt="" class="logo">
                </a>
                <div class="social">
                    <a href="#" class="scrollpoint sp-effect3"><i class="fa fa-twitter fa-lg"></i></a>
                    <a href="#" class="scrollpoint sp-effect3"><i class="fa fa-google-plus fa-lg"></i></a>
                    <a href="#" class="scrollpoint sp-effect3"><i class="fa fa-facebook fa-lg"></i></a>
                </div>
                <div class="rights">
                    <p>Copyright &copy; 2014</p>
                    <p>Template by <a href="http://www.scoopthemes.com" target="_blank">ScoopThemes</a></p>
                </div>
            </div>
        </footer>


    </div>
    
    
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/placeholdem.min.js"></script>
    <script src="assets/js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/scripts.js"></script>
     
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    
        <script type="text/javascript" src="jquery.fireworks.js"></script>
        <script type="text/javascript" src="test.js"></script>
    
    <script>
        $(document).ready(function() {
            appMaster.preLoader();
            
                            countdown('<?php echo $cntd;?>',false);

        });
    </script>
 
    
</body>



</html>
