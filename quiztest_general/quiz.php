<?php
session_start();
include("config.php");
$imgs="img/download.png";

//echo $imgs;
?>
<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->

<?php 
echo $_SESSION['test_id'];


if (isset($_SESSION['test_id']) && !empty($_SESSION['test_id'])) 
{

$result2 = mysqli_query($con,"select unique(*) from quiztest_test_appeared where id='".$_SESSION['test_id']."'");

$rwsc2=mysqli_fetch_array($result2);

unset($_SESSION["test_against"]);
unset($_SESSION["test_against_type"]);
unset($_SESSION["test_against_id"]);
unset($_SESSION["subject"]);
unset($_SESSION["topic"]);
unset($_SESSION["reqidts"]);

$_SESSION["test_against"]=$frtreqs['test_against'];
$_SESSION["test_against_type"]=$frtreqs['test_against_type'];
$_SESSION["test_against_id"]=$frtreqs['test_against_id'];
$_SESSION["subject"]=$frtreqs['subject'];
$_SESSION["topic"]=$frtreqs['topic'];
$_SESSION["totqtns"]="1"; 
$_SESSION["reqidts"]=$rwsc2["reqid"];
    
}else
{
$_SESSION["reqidts"]=$_POST["reqid"];
$_SESSION["test_against"]=$_POST['ptyp'];
$_SESSION["test_against_type"]=$_POST['ptyp2'];
$_SESSION["test_against_id"]="0";
$_SESSION["subject"]=$_POST['subject'];
$_SESSION["topic"]=$_POST['topicsids'];
$_SESSION["totqtns"]="5";

}

$test_against=$_SESSION["test_against"];

$test_against_type=$_SESSION["test_against_type"];

$cntd="20";
$_SESSION["allowtym"]=$cntd;

   if($test_against_type=="4")
            {
                $_SESSION["aitym"]="20";
                
            }else if($test_against_type=="5")
            {
                $_SESSION["aitym"]="15";
                
            }else if($test_against_type=="6" || $test_against_type=="7")
            {
                $_SESSION["aitym"]="10";
                
            } 
            
   
        
   //  echo "ctimer".$cntd;       
                ?>
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>Quiz2shine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
       <?php include("includeinallpages.php");?>
  
  
    <script>
    
    var completsts="0";
    $( document ).ready(function() 
    {
        
        <?php if (!isset($_SESSION['test_id']) && empty($_SESSION['test_id'])) 
     {
    ?>
    
   inserttestdetails();
     
    <?php }
    else
    {?>
    setimgfunc();
    getqfunc("");   
    myCounter.start();
 
    <?php } ?>
    });


  var interval1=null;
  //checks if player 2 has joined or not
    function setintvfunc(reqid)
    {
    
interval1=setInterval('doSomething('+reqid+')',3000);

    }
  
  var interval2=null;
  //checks if player 2 has answered or not
  
    function chkans(qsrno)
    {
    
interval2=setInterval('checkanswerstats('+qsrno+')',3000);

    }
    
    
    function checkanswerstats(qsrno)
    {
        
         var reqid=0;
      
    
         var pl2id=document.getElementById("pl2id").value;
         var pl1id=document.getElementById("pl1id").value;
    
        
          md1.style.display="block"; 
             $.ajax({
             type: "POST",
             url: "get_answerdets.php",
			 
             data: 'qsrno='+qsrno+'&pl2id='+pl2id+'&pl1id='+pl1id,
             
			
             success: function(msg)
             {
                 //alert(msg);
     		if(msg=="1")
     		{
     		    window.clearInterval(interval2);
     		    getscorefunc(0);
     	        //getqfunc("1");
    	        md1.style.display="none"; 
         	    
     		}
             }
             });
        
        
    }
    
    
    function setimgfunc()
    {
        try
        {
             $.ajax({
             type: "POST",
             url: "setimgonquizpg.php",
			 
             data: '',
			
             success: function(msg)
             {
     		
     	//	alert(msg);
     		
     		
     		var jsrdets=JSON.parse(msg);
     		
     		//alert(jsrdets["img2"]);
     		document.getElementById("pl1img").src=jsrdets["img1"];
     	//	alert(jsrdets["player1id"]);
     		document.getElementById("pl1id").value=jsrdets["player1id"];
     		
     		document.getElementById("pl2img").src=jsrdets["img2"];
     		document.getElementById("pl2id").value=jsrdets["player2id"];
     		
     		document.getElementById("plname2").innerHTML=jsrdets["name2"];
     		
     		
             }
             })
            
        }catch(ex)
        {
            
            alert(ex);
            
        }
     
        
    }
    
     function doSomething(reqid) 
      {
    
         try
        {
            
             $.ajax({
             type: "POST",
             url: "get_quiz_req_status.php",
			 
             data: 'reqid='+reqid+'&sts=2',
			

             success: function(msg)
             {
			     		
     		    alert(msg);
     		
                  if(msg=="1")
                  {
                      window.clearInterval(interval1);
                 
              	 md1.style.display="none";    
                     getqfunc("");
                     myCounter.start();
                  }
                   else if(msg=="2")
                  {
                       md1.style.display="none";
                      
                      alert("request rejected");
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
    
    
  function inserttestdetails()
  {
      var reqid=0;
      
      <?php if($_POST["reqid"]!="")
      {?>
    
    reqid=<?php echo $_POST["reqid"];?>;
    
    <?php } ?>
    
    
     $.ajax({
  type: "POST",
  url: "insertestdetails.php",
  data: "reqid="+reqid,
  cache: false,
  success: function(data){
  
//   alert(data);
 
   
   if(data=="1")
   {
       if(reqid=="")
       {
    //       alert("ok");
       getqfunc("");
       }else
       {
      //     alert("ok2");
        setintvfunc(reqid);
        
       }
    
    setimgfunc();   
   }
   
   if(data=="20")
   {
       swal("No questions");
       window.open("quizt.php","_self");
   }
   if(data=="10")
   {
       swal("Session Expired");
       window.open("login.php","_self");
   }

  }
});
    
 }
    
    
    function getqfunc(sts)
    {
        
        try
        {
            
             document.getElementById("totalrws").value='<?php echo $_SESSION["totqtns"];?>';
 
            
           var qn= document.getElementById("qno").value;

           var mcqn="1";
          console.log('qn='+qn);
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
                     // alert(qn);
    
           if(sts=="2")
           {
              // alert(qn);
               mcqn=parseInt(qn)+parseInt(1)-parseInt(1);
            
               qn=parseInt(qn)-parseInt(1);  
                document.getElementById("qno").value=qn;
     
           }
        //   alert(qn);
          
          //document.getElementById("qno").value
           document.getElementById("previous").style.display="none";
           
           /*if(parseInt(mcqn)>1)
           {
               
               document.getElementById("previous").style.display="none";
           }else
           {
               
               
               document.getElementById("previous").style.display="none";
           }*/
           
           var nmm=document.getElementById("totalrws").value;
           //alert(nmm);
           var exs=0;
           if(nmm=="")
           {
              exs=1; 
           }else
           {
           if(parseInt(qn)<parseInt(nmm))
           {
           exs=1; 
           }
           else
           {
               
            // alert("Completed");  
               exs=0;
               completsts="1";
               
           }
           }
           if(exs==1)
           {
               
               var subj='<?php echo $_SESSION["subject"];?>';
               
           $.ajax({
  type: "POST",
  url: "getques.php",
  data: "nxt="+qn+"&subj="+subj,
  cache: false,
  success: function(data)
  {
  
//  alert(data);
     
  
    var jsr=JSON.parse(data);
   
  document.getElementById("mcqshw").innerHTML="("+mcqn+")"+jsr["mcq"];
   
 document.getElementById("mcqoptsshw").innerHTML=jsr["options"];
 //document.getElementById("srno").val=jsr["options"];
   
   
   myCounter.start();
   
   

        document.getElementById("subm").style.display="block";
  }
});
}
            
        }catch(ex)
        {
            
            alert(ex);
            
        }
        
        
    }
    
    
    
    
     function updtselct()
    {
        myCounter.pause();
        document.getElementById("subm").style.display="none";
        
        var optss="";
        if ($("input[name='optsv']:checked").size()!=0) 
{
        
        var optss=$("input[name='optsv']:checked").val();
}
       // alert(optss);
       
       
         var tym=document.getElementById("tym").innerHTML;
       
         var p1=document.getElementById("p1").innerHTML;
         var p2=document.getElementById("p2").innerHTML;
            
        try
        {
            
            var qsrno=document.getElementById("qsrno").value;
            var qno=document.getElementById("qno").value;
            
         var url="";
         var pl2id=document.getElementById("pl2id").value;
         var pl1id=document.getElementById("pl1id").value;
    
    //     alert(pl2id);
         if(pl2id=="0")
         {
             
            url="updtques_ai.php";
         }else
         {
             
             url="updtques_other.php";
         }
           
      //  alert(url); 
  $.ajax({
  type:"POST",
  url: url,
  data: "qsrno="+qsrno+"&tym="+tym+'&optss='+optss+'&plscore='+p1+'&qno='+qno+'&pl2score='+p2+"&pl1id="+pl1id+"&pl2id="+pl2id+"&reqidts=<?php echo $_SESSION["reqidts"];?>",
  cache: false,
  success: function(data){
  
   //  alert(data);
   
     var jsr=JSON.parse(data);
   
   
  if(jsr["updtstats"]=="1")
  {
      scorefunc(optss,jsr["answerstats"]);
      
      if(jsr["ftchnxt"]=="1")
      {
      
      
          if(jsr["islastques"]=="")
            {
                
        
                          getscorefunc(0);
                          //getqfunc("1");
            }else
            {
        
                          getscorefunc(1);
            
                
            }
          
          
      }else
      {
        
        md1.style.display="block"; 
        chkans(qsrno);
                   
      }
      
      
  }
  else
  {
      
      swal("Some error occured");
 
  }
  /*   
  if(jsr["updtstats"]=="1")
  {
      
    scorefunc(optss,qsrno);
    if(jsr["islastques"]=="")
    {
        
    settmfornextqn();
    
    }else
    {
        
        completedfunc(jsr["teststats"]);
    }
    
  }else
  {
      
      swal("Some error occured");
 
  }*/
 
  }
});

            
        }catch(ex)
        {
            
            alert(ex);
            
        }

        
    }
    
    var myVarn;
    function settmfornextqn()
    {
        
        

    myVarn = setTimeout(function(){ getqfunc("1"); }, 3000);

        
    }
    
    
 function getscorefunc(sts)
 {
     
     try
     {
         
         var pl2id=document.getElementById("pl2id").value;
         var pl1id=document.getElementById("pl1id").value;
    
         $.ajax({
  type: "POST",
  url: "getscorefunc.php",
  data: "pl1id="+pl1id+"&pl2id="+pl2id+"&sts=1",
  cache: false,
  success: function(data)
  {
  
// alert(data);
      var jsr=JSON.parse(data);
      document.getElementById("p1").innerHTML=jsr["pl1score"];
      document.getElementById("p2").innerHTML=jsr["pl2score"];
      
if(sts=="0")//it is not last ques

{      setTimeout(function() {
    getqfunc("1");
},2000);
      
  }
  
  else //it is last ques
  {
      
      
      getwinorlose();    
      
  }
  }
 });
         
     }catch(ex)
     {
         
         alert(ex);
     }
 }
 
 
 function getwinorlose()
 {
     try
     {
        // alert("ok");
         var pl2id=document.getElementById("pl2id").value;
         var pl1id=document.getElementById("pl1id").value;
         
         $.ajax({
  type: "POST",
  url: "getscorefunc.php",
  data: "pl1id="+pl1id+"&pl2id="+pl2id+"&sts=2",
  cache: false,
  success: function(data)
  {
   // alert(data);
    var jsrd=JSON.parse(data);
    
    completedfunc(jsrd["tststats"]);
  }
    });
         
         
     }catch(ex)
     {
         alert(ex);
     }
     
     
 }
 
 
 
 function scorefunc(optss,sttrs)
 {
     //alert(sttrs);
    /*
    
 $.ajax({
  type: "POST",
  url: url,
  data: "qsrno="+qsrno+"&tym="+tym+'&optss='+optss+'&plscore='+p1+'&qno='+qno+'&pl2score='+p2,
  cache: false,
  success: function(data){
  }
 });*/
 
/*if(sttrs2=="1")
{
 
 
      
      var val=document.getElementById("p2").innerHTML;
      var val2=parseInt(val)+parseInt(1);
     
      document.getElementById("p2").innerHTML=val2;
     
}*/
 try
 {
    if(sttrs=="1")
      {
    /*  var val=document.getElementById("p1").innerHTML;
      
      var val2=parseInt(val)+parseInt(1);
      document.getElementById("p1").innerHTML=val2;*/
      
      document.getElementById("div"+optss).style.backgroundColor="green";
      document.getElementById("div"+optss).style.borderRadius = "25px";
      document.getElementById("img"+optss).style.display="block";
     
      }
      else if(sttrs=="0")
      {
      
if(optss!="")
{
      document.getElementById("div"+optss).style.backgroundColor="red";
       document.getElementById("div"+optss).style.borderRadius = "25px";
     
      document.getElementById("wrong"+optss).style.display="block";
}
          
      }
 }catch(ex)
 {
     
     alert(ex);
 }
     
 }
 
 
 function completedfunc(stats)
 {
     
     try
     {
         var p1s=document.getElementById("p1").innerHTML;
         
         
         
         if(stats=="1")
         {
             showfireworks();
            // alert("ok");
              
             swal({
                        title: "You Win",
text: "<img src='img/thumbs-up.gif' style='width:150px;'>",
        html: true,                        
type: "",
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'OK',
                    },
    function (isConfirm) {

        if (isConfirm) {
             window.open("result.php","_self");
} else {
    
   

        }
    }); 
         
         }else
         {
             
              swal({
                        title: "You Lose",
text: "<img src='img/thumbs-down.gif' style='width:150px;'>",
        html: true,                        
type: "",
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'OK',
                    },
    function (isConfirm) {

        if (isConfirm) {
             window.open("result.php","_self");
} else {

        }
    }); 
             
         }
         
         
     }catch(ex)
     {
         alert(ex);
     }
     
     
     
 }
   
    
    /*
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


*/

var myCounter = new Countdown({  
    seconds:'<?php echo $cntd;?>',  // number of seconds to count down
    onUpdateStatus: function(sec){
        
           document.getElementById("timer").innerHTML='<font size="5">Time Left </font><span id="tym" style="font-size:30px;">'+sec+ ' seconds</span> ';
  
        console.log(sec);}, // callback for each second
    onCounterEnd: function(){ 
        
       // getqfunc(1);
       // alert('Times Up!');
       
       if(completsts=="0")
       {
       updtselct();
       }
        
    } // final action
});


function Countdown(options) {
  var timer,
  instance = this,
  seconds = options.seconds || 10,
  updateStatus = options.onUpdateStatus || function () {},
  counterEnd = options.onCounterEnd || function () {};

  function decrementCounter() {
    updateStatus(seconds);
    if (seconds === 0) {
      counterEnd();
      instance.stop();
    }
    seconds--;
  }

  this.start = function () {
    clearInterval(timer);
    timer = 0;
    seconds = options.seconds;
    timer = setInterval(decrementCounter, 1000);
  };

  this.stop = function () {
    clearInterval(timer);
  };
  
  this.pause = function () {
    clearInterval(timer);
  };
}

   
   /*function pauseTimer()
			{
			    //alert("ok");
			    //clearInterval(timer);
			}*/
    </script>
    
    
</head>

<body class="fr">
  		
    
    <input type="hidden" id="qno" name="qno" value="0">
    <input type="hidden" id="totalrws" name="totalrws" value="">
    
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
                            <a href="#" class="btn btn-primary inverse btn-lg"></a>
                        </div>

                         
                         
                        <div class="tp-caption mediumlarge_light_white sfl hidden-xs" data-x="left"data-y="center"  data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                           YOU 
                           
                        </div>
                        
                        
                        
                         <div class="tp-caption mediumlarge_light_white " data-x="left" data-y="center" id="pl1img"  data-easing="Power4.easeOut">
                           <img id="pl1img" src="<?php echo $imgs;?>" style="width:120px; height:120px; margin-top:110px;" alt="">
                        </div>
                        
                        <div   style="margin-left:555px;margin-top:-450px;max-width:350px;color:#fff;width:60%;border: 0px solid red; " data-y="center">
                             <div id="timer" style=" "></div>
                        </div>
                        
                        <div class="tp-caption mediumlarge_light_white sft hidden-xs" data-x="left" style="margin-top:300px;" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                          Score</br>
                          
                          <div id="p1">0</div>
                          <input type="hidden" name="pl1id" id="pl1id" readonly/>
                        </div>
                        
                        
                        <div class="tp-caption mediumlarge_light_white sfl hidden-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                           Question
                        </div>
                        
                         
                        <div id="plname2" class="tp-caption mediumlarge_light_white sfl hidden-xs" data-x="right" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut" align="center">
                           
                        </div>
                         <div  class="tp-caption mediumlarge_light_white " data-x="right" data-y="center"  data-easing="Power4.easeOut">
                           <img id="pl2img" src="<?php echo $imgs;?>" style="width:120px; height:120px; margin-top:110px;" alt="">
                        </div>
                          <div class="tp-caption mediumlarge_light_white sft hidden-xs" style="margin-top:300px;" data-x="right" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                          Score</br>
                           <div id="p2">0</div>
                    <input type="hidden" name="pl2id" id="pl2id" readonly/>
                        </div>
                        <div  class=" row " style="margin-left:350px;max-width:680px;color:#fff;width:60%; border: 0px solid red;z-index:2; " data-x="" data-y="center" >
                           
                        <div  style="font-size:17px; ; ">
                            
                          <p style="text-align:center" id="mcqshw"> 
                            
                        </div>
                        
                        </div>
                       
                        <div class="tp-caption small_light_white sfb hidden-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="80" data-speed="1000" data-start="1600" data-easing="Power4.easeOut">
                        <ul>
                        <!--<li><a href="quiz.php?aid=4" >I am unpredictable </a></li>-->
                        </ul>
                        
                        <div id="mcqoptsshw" style="font-size:18px; margin-top:40px;">
                         
                         
    
 
                        </div>
                        
                        
                        <div style="margin-top:25px;">
<center>
<input type="button" style="display:none;" class="btn btn-default btn-lg" id="previous" onclick="getqfunc(2)" value="Previous">

<input type="button" style="display:none;" class="btn btn-default btn-lg" id="subm" onclick="updtselct();" value="Submit">

<!--<input type="button" class="btn btn-default btn-lg" id="next"  onclick="updtselct();" value="Next">-->



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

        

 <?php include("loading_modal.php");?>   
        
        
        

        <footer>
 <?php include("footer.php");
 mysqli_close($con);
 ?>   
       </footer>
    
   
<script>

 
</script>
    </div>
    
    <script type="text/javascript" src="jquery.fireworks.js"></script>
     
<script>


function showfireworks()
{
    
    $('.fr').fireworks();
}


</script>

    
    
    
</body>

</html>
