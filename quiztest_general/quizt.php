<?php
if (!isset($_SESSION)) session_start();
//echo getcwd();
include("config.php");
$std= $_SESSION['std'];

unset($_SESSION["test_against"]);
unset($_SESSION["test_against_type"]);
unset($_SESSION["test_against_id"]);
unset($_SESSION["subject"]);
unset($_SESSION["test_id"]);
unset($_SESSION["teststats"]);
unset($_SESSION["reqid"]);
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
            data: 'reqid='+reqid+'&sts=1',
            success: function(msg)
            {
     		    // alert(msg);
                 if(msg=="1")
                 {
                    window.clearInterval(interval1);
                    document.getElementById('reqid').value=reqid;
                  	md1.style.display="none";    
                    document.getElementById('formf').submit();
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
        } catch(ex)
        {
            alert(ex);
        }
      }
        function shwdivfunc()
        {
            try
            {
                document.getElementById("main").style.display="block";
                document.getElementById("shwfrndsdiv").style.display="none"; 
            }catch(ex)
            {
                alert(ex);
            }
        }
        function getfrnds()
        {
            try
            {
                $.ajax({
                    type: "POST",
                    url: " get_friends.php",
                    data: '',
                    success: function(msg){
     	                //	alert(msg);
     		            document.getElementById('shwfrndsdiv').innerHTML=msg;
                        document.getElementById("main").style.display="none";
                        document.getElementById("shwfrndsdiv").style.display="block"; 
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
        function fn(sts)
        {
            //  alert(sts);
            /* var ins='<select name="ptyp2" required>';
              ins=ins+'<option value="4">I am 100% accurate</option>';
                    ins=ins+'<option value="5">I am correct most of the time</option>';
                    ins=ins+'<option value="6">I am fast but make mistakes</option>';
                    ins=ins+'<option value="7">I am unpredictable</option>';
                    
              ins=ins+'</select>';*/
            if(sts=="")
            {
                document.getElementById("ptyp2shw").style.display="none";
                document.getElementById("aibtn").style.display="none";
                document.getElementById("othbtn").style.display="none";   
            }
             else if(sts=="1")
              {
                  
                  document.getElementById("ptyp2shw").style.display="block";
                   document.getElementById("aibtn").style.display="block";
                    document.getElementById("othbtn").style.display="none";
              }else
              {
                document.getElementById("ptyp2shw").style.display="none";
                document.getElementById("aibtn").style.display="none";
                document.getElementById("othbtn").style.display="block";
              }
            }
    function topicfunc()
    {
   // alert("test");
    var sub= document.getElementById('subject').value;
    if(sub!=''){
	 $.ajax({
             type: "POST",
             url: "topic_list.php",
             data: 'sub='+sub,
             success: function(msg){
       // alert(msg);
			  document.getElementById('showtop').innerHTML="Topic "+msg;
			   mksel();
			  },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
 //alert("ok");
}
}

function subf()
{
try
{
    
    var tp=($('#topic').val());
    document.getElementById("topicsids").value=tp;
    
    var ptypsel="0";
    if($('input[name="radio"]').is(':checked'))
    {
    ptypsel="1";
    var ptyp2t=$('input[name="radio"]:checked').val();
    
    //alert(ptyp2);
    document.getElementById("ptyp2").value=ptyp2t;
    }
    var vexs=0;
    if(document.getElementById("subject").value=="")
    {
        swal("","Select Subject","warning");    
        vexs=1;
    }
     else if(tp==null)
    {
    swal("","Select Topic","warning");
    vexs=1;
    }
    else if(document.getElementById("ptyp").value=="")
    {
        swal("","Select Player to Play against","warning");
        vexs=1;
    }
    else if(document.getElementById("ptyp").value=="1" && ptypsel=="0")
    {
        swal("","Select AI type","warning");
        vexs=1;
    }
    if(vexs==0)
    {
        document.getElementById("formf").submit();
    }
}catch(ex)
{
    alert(ex);
}
}
function sendreqfunc(frndid)
{
    try
    {
        md1.style.display="block";
        var tp=($('#topic').val());
        document.getElementById("topicsids").value=tp;
        var sub=document.getElementById("subject").value;
        $.ajax({
            type: "POST",
            url: "send_quiz_request.php",
            data: 'sub='+sub+'&topics='+tp+'&frndid='+frndid,
            success: function(msg){
                // alert(msg);
			    var jsr=JSON.parse(msg);
			    if(jsr["sts"]=="1")
			    {
			        setintvfunc(jsr["reqid"]);
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

    <div id="main" > 
    
    <section id="features">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Select Subject</h1>
                    <div class="divider"></div>
                    <p></p>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 scrollpoint sp-effect1" align="center">
                            <div class="media-body">
                                <h3 class="media-heading">Select a Subject For Quiz</h3>
                                <br><br>
                                    <input  type="hidden" id="topicsids" name="topicsids" readonly>
                                    <input  type="hidden" id="ptyp2" name="ptyp2" readonly>
                               Subject<select style="width:300px;" name="subject" id="subject" required onchange="topicfunc();">
                                    <option value="">Select Subject</option>
                                    <?php
                                    $qrs=mysqli_query($con,"select distinct(subject) from quiztest where std='".$std."'");
                                    while($rws=mysqli_fetch_array($qrs))
                                    {
                                        $csr=mysqli_query($con,"select name from project_catT where id='".$rws[0]."'");
                                        
                                        $nrw=mysqli_fetch_array($csr);
                                    ?>
                                    <option value="<?php echo $rws[0];?>"><?php echo $nrw[0];?></option>
                                    
                                    <?php } ?>
                                    </select><br><br>
                                    
                                    
                                    <div id="showtop">
                                       Topic 
                                       <select style="width:300px;">
                                    
                                            <option value="">Select Topic           </option>
                                            
                                       </select>
                                    </div>
                                    
                                    
                                    
                                    <br><br>
                        
                       Play Against
                       <select name="ptyp" id="ptyp" required onchange="fn(this.value)">
                           <option value="">Select</option>
                              <option value="1">Artifical Intelligence</option>
                                    <option value="2">Friends in real time</option>
                                    <option value="3">like-minded people</option>
                                    
                              </select>   
                              
                              </br> </br>
                              
                                <div id="mn">
                                </div>
                                <div   style="display:none" id="ptyp2shw">
                                    <div class="control-group" style="width:350px;height:200px;">
                                        <label class="control control--radio">I am 100% accurate
                                            <input type="radio" name="radio" value="4" />
                                            <div class="control__indicator"></div>
                                        </label>
                                        <label class="control control--radio">I am correct most of the time
                                          <input type="radio" name="radio" value="5" />
                                          <div class="control__indicator"></div>
                                        </label>
                                   
                                        <label class="control control--radio">I am fast but make mistakes
                                          <input type="radio" name="radio" value="6"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                   
                                        <label class="control control--radio">I am unpredictable
                                          <input type="radio" name="radio" value="7" />
                                          <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                    <button type="button" id="aibtn" style="display:none;" class="btn btn-primary  btn-lg" onclick="subf();">Start</button>
                                    
                                    
                                      <button type="button" id="othbtn" style="display:none;" class="btn btn-primary  btn-lg" onclick="getfrnds();">Continue</button>
                                   
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        
        </section>
    
    </div>

<div>
    <div id="shwfrndsdiv">
        
        
       
    
    </div>
    
    </div>  
        
       <?php include("footer.php");
       mysqli_close($con);
       ?>
 

    </div>
    
    
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <link href="jQueryMultiselect/jquery.multiselect.css" rel="stylesheet" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="jQueryMultiselect/jquery.multiselect.js"></script>


   <script>
   
   //mksel();
   
    function mksel()
    {
        $('#topic').multiselect({
            columns: 2,
            placeholder: 'Select Topic',
            search: false,
            selectAll: true,
           
        });

$('button').find('span').css("width", 100);
    }
</script>



      
      
      
 </div>
 
 
 
<?php include("loading_modal.php");?>    

 
  </form>
</body>

</html>
