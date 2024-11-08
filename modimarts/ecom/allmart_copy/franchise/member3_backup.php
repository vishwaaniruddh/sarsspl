<?php session_start();
ini_set('memory_limit','2048M');
//error_reporting(0);
include ('config.php');
//include('query.php');

// session_start();
//var_dump($_SESSION);

$country_query="SELECT * FROM country"; 
$country_con=mysqli_query($conn,$country_query);
$cn=array();
  while($fetchs=mysqli_fetch_array($country_con)){
      $cn[]=$fetchs[1];
}

$zone_query="SELECT * FROM zone"; 
$zone_con=mysqli_query($conn,$zone_query);
$z=array();
  while($fetchs=mysqli_fetch_array($zone_con)){
      $z[]=$fetchs[1];
}

$state_query="SELECT * FROM state"; 
$state_con=mysqli_query($conn,$state_query);
$s=array();
  while($fetchs=mysqli_fetch_array($state_con)){
      $s[]=$fetchs[1];
    }

$city_query="SELECT * FROM city"; 
$city_con=mysqli_query($conn,$city_query);
$ct=array();
  while($fetchs=mysqli_fetch_array($city_con)){
      $ct[]=$fetchs[1];
  }

$district_query="SELECT * FROM district"; 
$district_con=mysqli_query($conn,$district_query);
$d=array();
  while($fetchs=mysqli_fetch_array($district_con)){
      $d[]=$fetchs[1];
  }
    
$taluka_query="SELECT * FROM taluka"; 
$taluka_con=mysqli_query($conn,$taluka_query);
$t=array();
  while($fetchs=mysqli_fetch_array($taluka_con)){
      $t[]=$fetchs[1];
  }

/*$ward_query="SELECT * FROM ward"; 
$ward_con=mysqli_query($conn,$ward_query);
$w=array();
  while($fetchs=mysqli_fetch_array($ward_con)){
      $w[]=$fetchs[1];
  }*/
/*$village_query="SELECT * FROM village"; 
$village_con=mysqli_query($conn,$village_query);
$v=array();
  while($fetchs=mysqli_fetch_array($village_con)){
      $v[]=$fetchs[1];
  }*/

//include('header.php');
?>

 <!DOCTYPE html>
<html> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shyam Committee Member</title>
   <!-- <link rel="stylesheet" href="css/normalize.css">-->
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    
     
    
    <link rel="stylesheet" href="css/sig.css">
   
    <!-- jQuery library -->
    <!-- ruchi -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ruchi : select 2-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!--	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>-->
	<!-- Typahead -->
	<link rel="stylesheet" href="css/custom.css">
	<script  type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>



<link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">
      <link href="https://fonts.googleapis.com/css?family=Amita:400,700&display=swap&subset=devanagari" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap&subset=devanagari" rel="stylesheet">
      <link rel="stylesheet" href="../css/css_new/bootstrap.min.css">
    <!--  <script src="../js/jquery.min.js"></script>
      <script src="../js/popper.min.js"></script>-->
     <!-- <script src="../js/bootstrap.min.js"></script>-->
     <!-- <link rel="stylesheet" href="../css/css_new/font-awesome.min.css">-->
      <link rel="stylesheet" type="text/css" href="../css/css_new/slick.min.css">
     <!----> <script src="../js/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/css_new/style.css">
        <link rel="stylesheet" type="text/css" href="../css/css_new/hindi.css">

      <style>.mandir_plan h5:before{left: 40px;}
     .fa-at:before{content: "\f1fa";}</style>
     
     <style>
         input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
}

/*.modal {*/
/*   position: absolute;*/
/*   top: 10px;*/
/*   right: 100px;*/
/*   bottom: 0;*/
/*   left: 0;*/
/*   z-index: 10040;*/
/*   overflow: auto;*/
/*   overflow-y: auto;*/
/*} */
     </style>





<!-- ================== anand ============================-->
<style>
  #Levelwise {
   width: 386%;
  }
  #zone_respons {
   margin-left: -173%;
  }

#ZoneHeading_respons{
   margin-top: 7px;
   margin-left: -173%;
  }
  #commity_respons{
      margin-left: -83%;
      top: 0;
  }
#form_respons{
      padding:0 !important;margin:-19px !important;min-width: 360px !important;
  }



/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
 /* .example {background: red;}
  */
  #Levelwise { width: 100%;}
  #zone_respons { margin-left: 0;}
  #ZoneHeading_respons{margin-top: 7px;margin-left: 0;}
  #commity_respons{margin-left: -110%;top: 0;}
  #form_respons{padding:0 !important;margin:-19px !important;min-width: 582px !important; }
  #com_T{margin-left: 777px; }  
 
  
   .box-heights{ width: 100%; height: 79px; border: 1px solid #bfbfbf; margin-left: 0; }

    
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
     #Levelwise { width: 100%;}
  
   .box-heights{
    width: 42%;
    height: 79px;
    border: 1px solid #bfbfbf;
    margin-left: -55%; 
}
 }

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .example {background: blue;}
} 

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .example {background: orange;}
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  .example {background: pink;}
}
</style>

<!--=============================================================================-->







 <style>
.rounded {
  border-radius: 20px;
  height: 35px;
  /* Ruchi */
  padding : 4px !important;
  margin-top: -3px;
}
        /* Ruchi : `10 june 19 */
        #search{
            margin: 18px !important;
        }
        .busy * {
            cursor: wait !important;
        }
        .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button2{
            .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        }
        .button1 {
            background-color: #FBBA00;
            color: #fff;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 22px;
            padding: 8px 10px;
        }
/* unvisited link */
.test2:link {
    color: #5B5B5B;
    text-decoration: none;
}
}
/* visited link */
.test2:visited {
    color: #5B5B5B;
}
/* mouse over link */
.test2:hover {
    color: #00A0E3;
     text-decoration: underline;
}
/* selected link */
.test2:active {
    color: #5B5B5B;
}
.col-md-6 {
    width: 33%;
}
.col-md-offset-3 {
    margin-left: 34%;
}

::placeholder {
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff;
  opacity: 1; /* Firefox */
}

input[type="text"], select {
    
    font-size: 13px !important;
    height: 27px !important;
}
.twitter-typeahead{
    height:26px !important;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    border-bottom-color: transparent;
    /*background-color:#f36700 !important;*/
    background-color:#f0ad4e !important;
    }
    .nav-tabs>li>a{
        border:1px solid  #f0ad4e !important;
        color : #333 !important;
    }
   /* table th {
    width: auto !important;
}*/


</style>
<script>
    $(document).ready(function(){
    /* Country auto suggestion */
        var cn = <?php echo json_encode($cn); ?>
    // Constructing the suggestion engine
    var cn = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: cn
    });
    // Initializing the typeahead
    $('#txtCountry').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'cn',
        source: cn,
    });
    
     /* Zone auto suggestion */
    // Defining the local dataset
        var z = <?php echo json_encode($z); ?>
    // Constructing the suggestion engine
    var z = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: z
    });
    // Initializing the typeahead
    $('#txtZone').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result*/
    },
    {
        name: 'z',
        source: z,
    });
    
     /* State auto suggestion */
    // Defining the local dataset
        var s = <?php echo json_encode($s); ?>
    // Constructing the suggestion engine
    var s = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: s
    });
    
    $('#txtState').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 's',
        source: s,
    });
    
     /* City auto suggestion */
        var ct = <?php echo json_encode($ct); ?>
    
    var ct = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: ct
    });
   
    $('#txtCity').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'ct',
        source: ct,
    });
    
     /* District auto suggestion */
    
        var d = <?php echo json_encode($d); ?>
    // Constructing the suggestion engine
    var d = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: d
    });
    
    $('#txtDistrict').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'd',
        source: d,
    });
    
     /* taluka auto suggestion */
        var t = <?php echo json_encode($t); ?>
    
    var t = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: t
    });
    // Initializing the typeahead
    $('#txtTaluka').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 't',
        source: t,
    });
    
    
    //==========comment by anand=======
    
     /* Ward auto suggestion */
      /*  var w = <?php //echo json_encode($w); ?>
  
    var w = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: w
    });
   
    $('#txtWard').typeahead({
        hint: true,
        highlight: true, 
        minLength: 1,
    },
    {
        name: 'w',
        source: w,
    });*/
    
    
    /* Village auto suggestion */
      /*  var v = <?php// echo json_encode($v); ?>
   
    var v = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: v
    });
 
    $('#txtVillage').typeahead({
        hint: true,
        highlight: true, 
        minLength: 1, 
    },
    {
        name: 'v',
        source: v,
    });*/
});  
</script>

 


</head>
<body onload="sumitfunc();zone()"  style="font-size:14px" >

<?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){    
  include('admin_menu.php');

}
else{
    include('agent_menu.php');

    
}
  
  ?>
 
 
     <!-- Latest compiled and minified CSS -->
  <hr style="margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 4px solid rgba(0,0,0,.1);"/>

    
   <?php //include 'menu.php';
    ?>
        <div class="" align="center" >
            <div class="row" id="Levelwise" style="margin-top:1%;">
                <div class="col-md-4">
                <h3 style="margin-right:57%;font-family: 'Playfair Display', serif;">Search</h3>
          <div class=" box-heights" ><b>Country:</b>
            <div class="bs-example">
                <input type="text" name="txtCountry" id="txtCountry" onblur="searchCountry()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdCountry" value="" id="hdCountry">
                <input type="hidden" name="hdLevel" value="" id="hdLevel"><!-- for last selected dropdown level -->
                <input type="hidden" name="hdLoc" value="" id="hdLoc">
            </div>
           
          <select class="rounded" name="country" id="country"  onchange="zone()">
              <option value="">Select Country:</option>
          <?php 
          $country_con=mysqli_query($conn,$country_query);
          while($fetchs=mysqli_fetch_array($country_con)){ ?>
          <option value="<?php echo $fetchs[0];?>" <?php if($fetchs[0]==1){ ?>Selected <? }?> ><?php echo $fetchs[1]?></option>
         <?php } ?>
          </select>
        </div>
          <div class="box-heights" ><b>Zone:</b>
              <div class="bs-example">
                <input type="text" name="txtZone" id="txtZone" onblur="searchZone()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdZone" value="" id="hdZone">
            </div>
          <select class="rounded" name="Zone" id="Zone" onchange="state()">
              <option value="">Select Zone</option>
              <?php /*
              $zone_con=mysqli_query($conn,$zone_query);
              while($fetchs=mysqli_fetch_array($zone_con)){?>
              <option value="<?php echo $fetchs[0];?>"><?php echo $fetchs[1]?></option>
             <?php } */?>
          </select>
        </div>
    <div class="box-heights" ><b>State:</b>
        <div class="bs-example">
            <input type="text" name="txtState" id="txtState" onblur="searchState()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
            <input type="hidden" name="hdState" value="" id="hdState">
        </div>
        <select class="rounded" name="State" id="State" onchange="modelnos()">
        <option value="">Select State</option>
          <?php /*
          $state_con=mysqli_query($conn,$state_query);
          while($fetchs=mysqli_fetch_array($state_con)){?>
          <option value="<?php echo $fetchs[0];?>"><?php echo $fetchs[1]?></option>
         <?php } */?>
       </select>
    </div>
    <div class="box-heights" ><b>City:</b>
        <div class="bs-example">
            <input type="text" name="txtCity" id="txtCity" onblur="searchCity()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
            <input type="hidden" name="hdCity" value="" id="hdCity">
        </div>
    <select class="rounded" name="City" id="City" onchange="cities()">
        <option value="">Select City</option>
          <?php /*
          $city_con=mysqli_query($conn,$city_query);
          while($fetchc=mysqli_fetch_array($city_con)){?>
          <option value="<?php echo $fetchc[0];?>"><?php echo $fetchc[1]?></option>
         <?php } */?>
          </select></div>
          <div class="box-heights" ><b>District:</b>
            <div class="bs-example">
                <input type="text" name="txtDistrict" id="txtDistrict" onblur="searchDistrict()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdDistrict" value="" id="hdDistrict">
            </div>
            <select class="rounded" name="District" id="District" onchange="taluka()">
                <option value="">Select District</option>
            </select>
            </div>
        <div class="box-heights" ><b>Taluka:</b>
            <div class="bs-example">
                <input type="text" name="txtTaluka" id="txtTaluka" onblur="searchTaluka()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdTaluka" value="" id="hdTaluka">
            </div>
            <select class="rounded" name="talukaa" id="talukaa" onchange="pincode()">
                <option value="" >Select Taluka</option>
            </select>
         </div>
         
              <div class="box-heights" ><b>Pincode:</b>
            <div class="bs-example">
                <input type="text" name="txtPincode" id="txtPincode" onblur="searchPincode()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdtxtPincode" value="" id="hdtxtPincode">
            </div>
            <select class="rounded" name="Pincode" id="Pincode" onchange="village()">
                <option value="" >Select Pincode</option>
            </select>
         </div>
         
         
        <!-- <div class="box-heights"  ><b>Ward:</b>
            <div class="bs-example">
                <input type="text" name="txtWard" id="txtWard" onblur="searchWard()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdWard" value="" id="hdWard">
            </div>
            <select class="rounded" name="ward" id="ward" onchange="village()">
                <option value="" >Select Ward</option>
            </select>
         </div>-->
         
         <div class="box-heights" ><b>Village:</b>
           <select class="rounded" name="village" id="village" onchange="villages()"  style="margin-top:10px">
                <option value="" >Select Village</option>
            </select>
            <div class="bs-example">
                <input type="hidden" name="txtVillage" id="txtVillage" onblur="searchVillage()" class="typeahead tt-query" placeholder="search here">
                <input type="hidden" name="hdVillage" value="" id="hdVillage">
            </div>
            
         </div>
         
         
       </div>
        <div class="col-md-4">
          <!-- Ruchi -->
        <div class="row" style="margin:13px !important;">
            
            <!--  <div id="zones" style="display:none;margin-top: -20px;" class="col-md-12" style="width:25%;position:fixed;"> -->
              <div  class="col-md-12" style="margin-top:-18px"> 
              <div id="zones" style="display:none;" style="width:25%;position:fixed;">
              <h3 id="ZoneHeading_respons"  style=" font-family: 'Playfair Display', serif;"> Zone/State</h3>
                  <div id="zone_respons" class="table-responsive " style="height: 650px;width: 273px;overflow-y: inherit;">
                    <table  class="table table-bordered table-striped" id="zonedetail">
                        <tr>
                            <th class="th-prop">Zone</th>
                            <th class="th-prop">State</th>
                        </tr>
                    </table>
                  </div>
                  </div>
               <!-- </div>-->
                
                
                
               <!-- <div id="cities" class="col-md-12" style="display:none;margin-top: -20px;"  style=" width:25%;position:fixed;">-->
                    
                     <!-- <div  class="col-md-6" style="margin-top: -20px;"> -->
                      <div id="cities"  style="display:none;"  style=" width:25%;position:fixed;">
                  <!--<div class="col-md-6" style="margin-top: 23px;display:block;">-->
                  <h3 style="margin-left: -174%;font-family: 'Playfair Display', serif; ">City/District</h3>
                  <div class="table-responsive" style="height: 650px;width: 273px;margin-left: -173%;">
                        <table align="center" class="table table-bordered table-striped" id="citidetails" >
                            <tr>
                                <th class="th-prop">City</th>
                                <th class="th-prop">District</th>
                            </tr>
                        </table>
                    </div>    
                  </div><br/><br/>
                
                
              <!--  <div id="show" style="margin-left: 87%;margin-top:-149%">-->
          </div>
        </div>  
    </div>
     <div class="col-md-4"><div id="show" style=" margin-left: -85px;"></div>
    
    </div>
    </form>
    </div>
    </div>
            </div>
            </div>
            
        <!--<div id="show">-->
        
             <?php include('Footer_Hindi.php');?>
    </body>
</html>
<script>
    function clearAllFeild(feild){
        //var f=['country','Zone','State','City','District','talukaa','Ward'];
         for(var i=0;i<feild.length;i++){
             $('#'+feild[i]).empty();
         }
    }
    
    function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function modelnos() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                $('#cities').hide(); 
                $('#zones').hide();
            }
            //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['talukaa','Pincode','village'];  
          clearAllFeild(f);
            DisableArrowKeys();
            if($('#zones').css('display')!='none'){ 
               $('#zones').hide();
            }
            var state=document.getElementById("State").value;
           // alert(state)
             $('#hdLevel').val(3);
            $('#hdLoc').val(state);
            sumitfunc();
            $.ajax({
                    type:'POST',
                    url:'city1.php',
                     data:'state='+state,
                     datatype:'json',
                    success:function(msg){
                    //   alert(msg)
                       var jsr=JSON.parse(msg);  
                        var newoption='<option value="">Select</option>' ;
                        var citydata='';
                       $('#City').empty();
                      
                        for(var i=0;i<jsr[0].length;i++)
                        {
		                   newoption+= '<option id="'+ jsr[0][i]["ids"]+'" value="'+ jsr[0][i]["ids"]+'">'+jsr[0][i]["modelno"]+'</option> ';
                        }
                        if(jsr[1]){
                        for(var i=0;i<jsr[1].length;i++)
                        {
                           citydata+= '<tr><td class="th-prop" style="padding: 3px !important;">'+jsr[1][i]["city"]+'</td><td>'+jsr[1][i]["district"]+'</td></tr>';
                        }
                        }
                       // alert("anand"+newoption)
                          $("#cities").show();
 	                      $('#citidetails').append(citydata);  
                     	$('#City').append(newoption);
                    }
                })
            }
    
        function cities() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                $('#cities').hide(); 
                $('#zones').hide();
            }
            DisableArrowKeys();
           //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['District','talukaa','Pincode','village'];  
          clearAllFeild(f);
            var city=document.getElementById("City").value;
            var State=document.getElementById("State").value;
             $('#hdLevel').val(4);
            $('#hdLoc').val(city);
            sumitfunc();
            $.ajax({
                type:'POST',
                url:'district.php',
                data:'city='+city,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                    var newoption=' <option value="">Select</option>';
                    $('#District').empty();
                    for(var i=0;i<jsr.length;i++)
                    {
	                   newoption+= '<option id="'+jsr[i]["ids"]+'" value="'+jsr[i]["ids"]+'">'+jsr[i]["modelno"]+'</option> ';
                    }
                 	$('#District').append(newoption);
                }
            })
        }
        
        
        

        

        function taluka() {
            //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['Pincode','village'];  
          clearAllFeild(f);
          DisableArrowKeys();
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
               $('#cities').hide(); 
               $('#zones').hide();
            }
              var Taluka=document.getElementById("District").value;
               $('#hdLevel').val(5);
               $('#hdLoc').val(Taluka);
              sumitfunc();
                $.ajax({
                    type:'POST',
                    url:'taluka.php',
                     data:'Taluka='+Taluka,
                     datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                        var newoption=' <option value="">Select</option>' ;
                        $('#talukaa').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+jsr[i]["ids"]+'">'+jsr[i]["modelno"]+'</option> ';
		                }                       
                     	$('#talukaa').append(newoption);
                    }
                })
            }
            
            function login_modal(id){
                var id=id;
                
            document.getElementById("modal1"+id).click();
            document.getElementById("modal2"+id).click();
            // alert("running fine");
            }
            
            function testing(id){
                var id = id;
                // var id = document.getElementById('member_id').value;
                console.log("'=======",id)
            }
            
            function regi_modal(id){
                var id = id;
                document.getElementById("modal1"+id).click();
                document.getElementById("modal3"+id).click();
                var x = document.getElementById("otp_inputs"+id);
                        x.style.display = "block";
                var y = document.getElementById("password_inputs"+id);
                                    y.style.display = "none";
                 var z = document.getElementById("get_otp"+id); 
                                    z.style.display = "none";
                

            }
            
            function member_login(id){
                var id = id;
                console.log("========here is workin")
                                //   var otp = Math.floor(1000 + Math.random() * 9000);
                                   var mobile_no = document.getElementById('login_mobile_no'+id).value;
                                   var password = document.getElementById('login_password'+id).value;
                                //   var session_id ="";
                                   
                                   if(mobile_no == ""  || password == ""){
                                       swal("All fields are mandotary");
                                   }else{
  
                                $.ajax({
                                 type:'POST',
                            url:'member_login.php',
                             data:'mobile_no='+mobile_no+'&password=' +password,
                             success:function(msg){
                                // alert();
                                if(msg==1){
                                    window.location = "http://shyambabadham.com/account?";
                                    //  window.location = "https://shyambabadham.com/demo/sapna/account.php?mobile="<?php $_SESSION['member_id']?>
                                    //  booldata= false;
                                } else {
                                     swal("login Error");
                                    //document.getElementById("myForm").submit();
                                    // booldata= true;
                                }
                             }
                                })
                                   }
            }
              
       
                    //  Send Otp ===================================================================================
                       function send_otp(id){
                                var id = id;
                           
                                  var otp = Math.floor(1000 + Math.random() * 9000);    //  Generate 4 Digit Random OTP
                                   var mobile_no = document.getElementById('mobile_no'+id).value;
                                //   var member_id = document.getElementById('member_id').value;
                                    var x = document.getElementById("otp_inputs"+id);
                                    var y = document.getElementById("password_inputs"+id);
                                    var z = document.getElementById("get_otp"+id);
                                    
                                 if(mobile_no == "" ){
                                     swal("Please enter a mobile no.");
                                 }if(mobile_no.length <10 || mobile_no.length > 10 ){
                                        swal("Please enter a valid mobile no."); 
                                     }
                                 else{
                                    //  x.style.display = "none";
                                    //  z.style.display = "block";
                                $.ajax({
                                 type:'POST',
                            url:'sms_copy.php',
                             data:'mobile_no='+mobile_no+'&otp='+otp,
                             success:function(msg){
                                // alert(msg);
                                if(msg==0){
                                    swal("Member does not exists");
                                } else {
                                    //document.getElementById("myForm").submit();
                                    x.style.display = "none";
                                    z.style.display = "block";
                                  swal("OTP has been sent to your mobile no.");
                                }
                             }
                                })
                                 }
                            }
         //=========== Match OTP function============================================================================================== 
                            function otp_match(id){
                                var id =id;
                             console.log("========here is workin")
                                   var mobile_no = document.getElementById('mobile_no'+id).value;
                                   var get_otp = document.getElementById('get_otp_user'+id).value;
                                   var x = document.getElementById("otp_inputs"+id);
                                    var y = document.getElementById("password_inputs"+id);
                                    var z = document.getElementById("get_otp"+id);
  
                                console.log('======otp',get_otp,'=======mobile',mobile_no)
                                if(get_otp == ""){
                                    swal("Please enter OTP");
                                }else{
                                $.ajax({
                                 type:'POST',
                            url:'otp_match.php',
                             data:'mobile_no='+mobile_no+'&get_otp='+get_otp,
                             success:function(msg){
                                // alert(msg);
                                if(msg==1){
                                    // z.style.display = "none";
                                    // y.style.display = "block";
                             window.location = "http://shyambabadham.com/account?";
                                } else {
                                     swal("OTP Mismatch");
                                }
                             }
                                })
                                }
                       }
         //  Submit All data for New registration              
                       function submit_regi(id){
                           var member_id = id;
                                //   var otp = Math.floor(1000 + Math.random() * 9000);
                                   var mobile_no = document.getElementById('mobile_no'+id).value;
                                //   var member_id = document.getElementById('member_id').value;
                                
                                   var password = document.getElementById('password'+id).value;
                                   var conf_password = document.getElementById('conf_password'+id).value;
                                   
                                   if(password =="" || conf_password == ""){
                                       swal("All fields are mandotary");
                                   }else{
                                     if(password == conf_password){
                                          $.ajax({
                                 type:'POST',
                            url:'member_regi.php',
                             data:'mobile_no='+mobile_no+'&password=' +password+'&member_id='+member_id,
                             success:function(msg){
                                // alert(msg);
                                if(msg==1){
                                    // swal("login Successful");
                                    window.location = "http://shyambabadham.com/account?";
                                    //  booldata= false;
                                } else {
                                     swal("login Error");
                                }
                             }
                                })
                                     }else{
                                        swal("Confirm password Mismatch"); 
                                     }
                                   }
                       }
       
        function sumitfunc(){
            var State= document.getElementById("State").value; 
            var City= document.getElementById("City").value;
            var District= document.getElementById("District").value;
            var talukaa= document.getElementById("talukaa").value;
            var Pincode= document.getElementById("Pincode").value;
             var village= document.getElementById("village").value;
            var Zone= document.getElementById("Zone").value;
            var country= document.getElementById("country").value;
            var hdLevel= document.getElementById("hdLevel").value;
            var hdLoc= document.getElementById("hdLoc").value;
            $.ajax({
               type: 'POST',    
               url:'member3_process_test.php',
                data:'State='+State+'&City='+City+'&District='+District+'&talukaa='+talukaa+'&Zone='+Zone+'&country='+country+'&Pincode='+Pincode+'&village='+village+'&hdLevel='+hdLevel+'&hdLoc='+hdLoc,
               success: function(msg){
                   //alert(msg);
                 document.getElementById('show').innerHTML=msg;
                } 
            })
        }
        booldata=false;
        function checkmail(){
            var mail=document.getElementById('Gmail').value;
            $.ajax({
                type:'POST',
                url:'check_mailip.php',
                
                 data:'mail='+mail, 
                 success:function(msg){
                    //alert(msg);
                    if(msg==1){
                        alert("Email Id already exist");
                         booldata= false;
                    }else{
                        //document.getElementById("myForm").submit();
                        booldata= true;
                    }
                 }
            })
            return booldata;
        }
  
        function finalval(){
            if( validation() && checkmail())
            {
                document.getElementById("myForm").submit();
                return true; 
            }
            else
            {
                return false; 
            }
        }

        function zone() {
          //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['State','City','District','talukaa','Pincode','village'];  
          clearAllFeild(f);
          DisableArrowKeys();
          //clearAllFeild('Zone');
            //clear feilds if selecetd
            $('#txtState').val(null);
            $('#txtCity').val(null);
            $('#txtDistrict').val(null);
            $('#txtTaluka').val(null);
          //  $('#txtWard').val(null);
            $('#txtVillage').val(null);
            var country=document.getElementById("country").value;
            $('#hdLevel').val(1);
            $('#hdLoc').val(country);
            sumitfunc();
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
                  var country=document.getElementById("country").value;
                    $.ajax({
                            type:'POST',
                            url:'zone.php',
                             data:'country='+country,
                             datatype:'json',
                            success:function(msg){
                               var jsr=JSON.parse(msg);
                                var newoption=' <option value="">Select</option>' ;
                                var zonedata='';
                                $('#Zone').empty();
                                for(var i=0;i<jsr[0].length;i++)
                                {
                                   newoption+= '<option id="'+ jsr[0][i]["ids"]+'" value="'+ jsr[0][i]["ids"]+ '" >'+jsr[0][i]["modelno"]+'</option> ';
        		                }  
        		                for(var i=0;i<jsr[1].length;i++)
                                {
                                   zonedata+= '<tr ><td >'+jsr[1][i]["zone"]+'</td><td>'+jsr[1][i]["state"]+'</td></tr>';
        		                } 
                             	$('#Zone').append(newoption);
                                  $("#zones").show();
                             	$('#zonedetail').append(zonedata);
                            }
                        })
                    }

        function state() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
          //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['City','District','talukaa','Pincode','village'];  
          clearAllFeild(f);
            DisableArrowKeys();
            var state=document.getElementById("State").value;
            var zone=document.getElementById("Zone").value;
            $('#hdLevel').val(2);
            $('#hdLoc').val(zone);
                sumitfunc();
                $.ajax({
                    type:'POST',
                    url:'state1.php',
                    data:'zone='+zone,
                    datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                        var newoption=' <option value="">Select</option>' ;
                        $('#State').empty();
                        for(var i=0;i<jsr[0].length;i++)
                        {
                           newoption+= '<option id="'+ jsr[0][i]["ids"]+'" value="'+ jsr[0][i]["ids"]+ '" >'+jsr[0][i]["modelno"]+'</option> ';
		                }
                     	$('#State').append(newoption);
                     	$("#zones").hide();
                    }
                })
            }
        function ward() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
          //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['village'];  
          clearAllFeild(f);
            DisableArrowKeys();
        var taluka=document.getElementById("talukaa").value;
        $('#hdLevel').val(6);
        $('#hdLoc').val(taluka);
            sumitfunc();
            $.ajax({
                type:'POST',
                url:'ward.php',
                data:'taluka='+taluka,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                    var newoption=' <option value="">Select</option>' ;
                    $('#ward').empty();
                    for(var i=0;i<jsr.length;i++)
                    {
                       newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+ jsr[i]["ids"]+ '" >'+jsr[i]["modelno"]+'</option> ';
	                }
                 	$('#ward').append(newoption);
                }
            })
        }
        
        function pincode() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
          //var f=['country','Zone','State','City','District','talukaa','Ward','village'];
          var f=['village'];  
          clearAllFeild(f);
            DisableArrowKeys();
        var pincode=document.getElementById("talukaa").value;
        $('#hdLevel').val(6);
        $('#hdLoc').val(pincode);
        
            sumitfunc();
            $.ajax({
                type:'POST',
                url:'pincode.php',
                data:'taluka='+pincode,
                datatype:'json',
                success:function(msg){
                   
                   var jsr=JSON.parse(msg);
                    var newoption=' <option value="">Select</option>' ;
                    $('#Pincode').empty();
                    for(var i=0;i<jsr.length;i++)
                    {
                       newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+ jsr[i]["ids"]+ '" >'+jsr[i]["modelno"]+'</option> ';
	                }
                 	$('#Pincode').append(newoption);
                 
                }
            })
        }
        
        
        function village() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
            
            DisableArrowKeys();
            var village=document.getElementById("Pincode").value;
          var pincode= $("#Pincode option:selected").text();
           // alert(pincode);
            $('#hdLevel').val(7);
            $('#hdLoc').val(village);
            
        
            sumitfunc();
            $.ajax({
                type:'POST',
                url:'village.php',
                data:'pincode='+pincode,
                datatype:'json',
                success:function(msg){
                //    alert(msg)
                   var jsr=JSON.parse(msg);
                    var newoption=' <option value="">Select</option>' ;
                    $('#village').empty();
                    for(var i=0;i<jsr.length;i++)
                    {
                       newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+ jsr[i]["ids"]+ '" >'+jsr[i]["modelno"]+'</option> ';
	                }
                 	$('#village').append(newoption);
                }
            })
        }
        
      /*  function villages() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
            DisableArrowKeys();
            var village=document.getElementById("village").value;
            $('#hdLevel').val(8);
            $('#hdLoc').val(village);
            sumitfunc();
        }*/
        
         function villages() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
            DisableArrowKeys();
            var village=document.getElementById("village").value;
          //  alert(village);
            $('#hdLevel').val(8);
            $('#hdLoc').val(village);
            sumitfunc();
        }
        
        function Previus(ptable,ctable,feild_id,col_name,column_value,col) {
           
            sumitfunc();
                $.ajax({
                    type:'POST',
                    url:'fillDropdown.php',
                    data: "id=" +feild_id  + "&col=" + col_name+"&ptable="+ptable+"&ctable="+ctable+"&column_value="+column_value,
                    datatype:'json',
                    success:function(msg){
                   //    alert(msg);
                        var jsr=JSON.parse(msg);
                     //  alert(jsr);
                        $('#'+feild_id).empty();
                        var newoption=' <option value="">Select</option>' ;
                        //$("'#"+feild_id+"'").val('');
                     
                      // document.getElementById("'#"+feild_id+"'").innerHTML ="";
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id="'+ jsr[i]["id"]+'" value="'+ jsr[i]["id"]+ '" >'+jsr[i]["value"]+'</option> ';
		                }
                     	$('#'+feild_id).append(newoption);
                     	//alert('#'+feild_id);
                     	$('#'+feild_id).val(col);
                    }
                })
            }
            
            function current(table,column_value,feild_id,col) {
               // alert('col'+column_value);
                sumitfunc();
                $.ajax({
                    type:'POST',
                    url:'fillCurrent.php',
                    data: "&table="+table+"&column_value="+column_value,
                    datatype:'json',
                    success:function(msg){
                      //  alert(msg);
                       var jsr=JSON.parse(msg);
                     //  alert(jsr);
                       $('#'+feild_id).empty();
                        var newoption=' <option value="">Select</option>' ;
                        //$("'#"+feild_id+"'").val('');
                      
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id="'+ jsr[i]["id"]+'" value="'+ jsr[i]["id"]+ '" >'+jsr[i]["value"]+'</option> ';
		                }
                     	$('#'+feild_id).append(newoption);
                     	//alert('#'+feild_id);
                     	$('#'+feild_id).val(column_value);
                     	//state();
                     	if(feild_id=='Zone'){
                     	     state();
                     	} else if(feild_id=='State'){
                     	    modelnos();
                     	} else if(feild_id=='City'){
                     	    cities();
                     	} else if(feild_id=='District'){
                     	    taluka();
                     	} else if(feild_id=='talukaa'){
                     	    pincode();
                     	}
                     	else if(feild_id=='Pincode'){
                     	    village();
                     	}
                       else if(feild_id=='village'){
                     	    villages();
                     	}
                    }
                });
            }

    function searchCountry(){
        //$("#Zone").prop("disabled", false);
        //$("#Zone").removeAttr("disabled");
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        //country1 = $(this).val();
        country=document.getElementById('txtCountry').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'country='+country,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                  // alert(jsr.length)
                   if(jsr.length>0){
                   //alert(jsr[0].country);
                   $('#hdCountry').val(jsr[0].country); 
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   zone();
                   }
                    }
                })
    }

    function searchZone(){
        $('#txtCountry').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        //$('#txtWard').val(null);
          var zone= document.getElementById('txtZone').value;
        //$("#State").removeAttr("disabled");
       // $("#Zone").removeAttr("disabled");
        var c='';
            $.ajax({
                    type:'POST',
                    url:'search.php',
                    data:'zone='+zone,
                    datatype:'json',
                    success:function(msg){
                       var jsr=JSON.parse(msg);
                       //alert(jsr[0].country);
                       if(jsr.length>0){
                           //$('#Zone').empty();
                           //current(table,column_value,feild_id,col)
                           current('zone',jsr[0].zone,'Zone',jsr[0].zone);
                           Previus('country','zone','country','country_id',jsr[0].zone,jsr[0].country);
                           // state();
                          
                       }
                        }
                    });
           
    }
    function searchState(){
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
       // $('#txtWard').val(null);
        
        //state = $(this).val();
        var state= document.getElementById('txtState').value;
       /*$("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");
       $("#City").removeAttr("disabled");*/
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'state='+state,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   if(jsr.length>0){
                //Previus(ptable,ctable,feild_id,col_name,column_value,col)
                //current(table,column_value,feild_id,col)
                current('state',jsr[0].state,'State',jsr[0].state);
                Previus('zone','state','Zone','zone_id',jsr[0].state,jsr[0].zone);
                Previus('country','zone','country','country_id',jsr[0].zone,jsr[0].country);
                   //alert(jsr[0].state);
                   $('#State').val(jsr[0].state);
                   //$('#country').val(jsr[0].country);
                   //$('#Zone').val(jsr[0].zone);
                   //modelnos();
                   }
                    }
                })

    }
    function searchCity(){
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        
        var city=document.getElementById('txtCity').value;
        /*$("#State").removeAttr("disabled");
       $("#Zone").removeAttr("disabled");*/
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'city='+city,
                datatype:'json',
                success:function(msg){
                   //alert(msg)
                     $('#State').val('');
                   var jsr=JSON.parse(msg);
                if(jsr.length>0){
                  // $('#City').val(jsr[0].city);
                //current(table,column_value,feild_id,col)
                current('city',jsr[0].city,'City',jsr[0].city);
                //Previus(ptable,ctable,feild_id,col_name,column_value,col)
                Previus('zone','state','Zone','zone_id',jsr[0].state,jsr[0].zone);
                Previus('country','zone','country','country_id',jsr[0].zone,jsr[0].country);
                Previus('state','city','State','state_id',jsr[0].city,jsr[0].state);
                //cities();
                }
                    }
                })
        
    }
    function searchDistrict(){
       //clear feilds if selecetd
       /* $('#txtCountry').val();
        $('#txtZone').val();
        $('#txtState').val();
        $('#txtCity').val();
        $('#txtTaluka').val();
        $('#txtWard').val(null);
        */
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtTaluka').val(null);
      //  $('#txtWard').val(null);
        $('#txtPincode').val(null);
        
        district=document.getElementById('txtDistrict').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'district='+district,
                datatype:'json',
                success:function(msg){
                //   alert(msg)
                   var jsr=JSON.parse(msg);
                   //$('#hdState').val(jsr[0].state);
                   /*if(jsr.length>0){
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].state);
                   $('#City').val(jsr[0].city);
                   $('#District').val(jsr[0].district);
                   taluka();
                   }*/
                    if(jsr.length>0){
                //current(table,column_value,feild_id,col)
                current('district',jsr[0].district,'District',jsr[0].district);
                //Previus(ptable,ctable,feild_id,col_name,column_value,col)
                Previus('zone','state','Zone','zone_id',jsr[0].state,jsr[0].zone);
                Previus('country','zone','country','country_id',jsr[0].zone,jsr[0].country);
                Previus('state','city','State','state_id',jsr[0].city,jsr[0].state);
                Previus('city','district','District','city_id',jsr[0].state,jsr[0].zone);
                //cities();
                }
                    }
                }) 
    }
    function searchTaluka(){
       
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        //$('#txtTaluka').val();
        $('#txtPincode').val(null);
       // $('#txtWard').val(null);
        //taluka = $(this).val();
        
        var taluka=document.getElementById('txtTaluka').value;
       //alert('Hi !!');
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'taluka='+taluka,
                datatype:'json',
                success:function(msg){
                //   alert(msg)
                   var jsr=JSON.parse(msg);
                  /* if(jsr.length>0){
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].country);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                    }
                    */
                    
                     if(jsr.length>0){
                //current(table,column_value,feild_id,col)
                current('taluka',jsr[0].taluka,'talukaa',jsr[0].taluka);
                //Previus(ptable,ctable,feild_id,col_name,column_value,col)
                Previus('country','zone','country','country_id',jsr[0].zone,jsr[0].country);
                Previus('zone','state','Zone','zone_id',jsr[0].state,jsr[0].zone);
                Previus('state','city','State','state_id',jsr[0].city,jsr[0].state);
                Previus('city','district','City','city_id',jsr[0].district,jsr[0].city);
                Previus('district','taluka','District','district_id',jsr[0].taluka,jsr[0].district);
              /*  Previus('taluka','pincode','Taluka','taluka_id',jsr[0].pincode,jsr[0].taluka);*/
                //cities();
                }
                    
                    
                }
                })
    }
    
    //Search Pincode
      function searchPincode(){
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
      //  $('#txtPincode').val(null);
       // $('#txtVillage').val(null);
        
        //taluka = $(this).val();
        var pincode=document.getElementById('txtPincode').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'pincode='+pincode,
                datatype:'json',
                success:function(msg){
                 //  alert(msg)
                   var jsr=JSON.parse(msg);
                if(jsr.length>0){ 
                //current(table,column_value,feild_id,col)
                current('pincode',jsr[0].pincode,'Pincode',jsr[0].pincode);
                //Previus(ptable,ctable,feild_id,col_name,column_value,col)
                Previus('country','zone','country','country_id',jsr[0].zone,jsr[0].country);
                Previus('zone','state','Zone','zone_id',jsr[0].state,jsr[0].zone);
                Previus('state','city','State','state_id',jsr[0].city,jsr[0].state);
                Previus('city','district','City','city_id',jsr[0].district,jsr[0].city);
                Previus('district','taluka','District','district_id',jsr[0].taluka,jsr[0].district);
                Previus('taluka','pincode','talukaa','taluka_id',jsr[0].pincode,jsr[0].taluka);
              /*  Previus('village','village','village','pincode_id',jsr[0].pincode,jsr[0].village);*/
                //cities();
                }
                    
                    
                }
                })
    }
    
  /*  
    //searchWard
    function searchWard(){
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val();
        $('#txtVillage').val(null);
        
        var ward=document.getElementById('txtWard').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'ward='+ward,
                datatype:'json',
                success:function(msg){
                //    alert(msg)
                   var jsr=JSON.parse(msg);
                   if(jsr.length>0){
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].country);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                    }}
                })
    }*/
    //searchVillage
    function searchVillage(){
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
      //  $('#txtWard').val(null);
        var village=document.getElementById('txtVillage').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'village='+village,
                datatype:'json',
                success:function(msg){
                   // alert(msg);
                   var jsr=JSON.parse(msg);
                   if(jsr.length>0){ //Ada B.O
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].state);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                    $('#talukaa').val(jsr[0].taluka);
                   $('#Pincode').val(jsr[0].pincode);
                   $('#village').val(jsr[0].village);
                    }}
                })
    }
    
    
    function DisableArrowKeys() {
        var ar = new Array(37, 38, 39, 40);
        $(document).keydown(function(e) {
            var key = e.which;
            if ($.inArray(key, ar) > -1) {
                e.preventDefault();
                return false; 
           }
            return true;
        });
    }
    $('#country').change(function(){
        //$("#Zone").removeAttr("disabled");
        //clear feilds if selecetd
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
       // $('#txtWard').val(null);
        sumitfunc();
        DisableArrowKeys();
    });
    function deleteCommittee(id){
        //alert(id);
    		 $.ajax({
                 type: "POST",
                 url: "confirmDelete.php",
                 data: 'id='+id+'&remove='+1,			
                 success: function(msg){              
                  //alert(msg);
                  swal('Committee deleted successfully!');
                  sumitfunc();
                 },
             });
    
    }
    
    function shiftCommittee(id){
        //alert('shift');
    		 $.ajax({
                 type: "POST",
                 url: "confirmDelete.php",
                 data: 'id='+id+'&shift='+1,			
                 success: function(msg){              
                  //alert(msg);
                  swal('Committee shifted to waiting list successfully!');
                  sumitfunc();
                 },
             });
    }
    
   function editCommittee(id,w=''){
       var win_path = '';
       var name='';
       var pic='';
       if(w=='waiting'){
            name=$('#wname'+id).val();
            win_path = $('#wprofile_pic'+id).val();
            pic=win_path.split(/[\\\/]/).pop();
           // pic=$('#wprofile_pic'+id).val();
       } else {
        name=$('#name'+id).val();
        win_path = $('#profile_pic'+id).val();
        pic=win_path.split(/[\\\/]/).pop();
        //pic=$('#profile_pic'+id).val();
       }
    		 $.ajax({
                 type: "POST",
                 url: "update_member.php",
                 data: 'id='+id+'&name='+name+'&pic='+pic,			
                 success: function(msg){              
                  //alert(msg);
                  swal('Committee updated successfully!');
                  sumitfunc();
                 },
             });
    
    }
</script>
<script type="text/javascript">
    
    function viewProfile(mid){
        var mid = mid;
        console.log(mid);
        $.ajax({
                 type: "GET",
                 url: "getMobile.php",
                 data: 'id='+mid,			
                 success: function(msg){              
                  //alert(msg);
                  //alert(msg);
                  if(msg=='1'){
                      window.location = 'https://shyambabadham.com/account/member_account/account.php';
                  }
                 },
             });
        
    }
    $(document).ready(function(){
        <?php
            if(isset($_REQUEST["mobile"])){
                if($_REQUEST["mobile"]!='' && $_REQUEST["mobile"]!=null){
                    echo "mobileSearch('".$_REQUEST["mobile"]."');";
                }
            }
        ?>
    });
    function mobileSearch(mobile){
        //var mid = mid;
        console.log(mobile);
        $.ajax({
                 type: "GET",
                 url: "mobile_search.php",
                 datatype:'json',
                 data: 'mobile='+mobile,			
                 success: function(response){              
                  console.log(response);
                  if(response=='0'){
                      alert('Mobile no. does not exist');
                  }else{
                      
                      var json = JSON.parse(response);
                      console.log(json);
                      
                      var state = json.State;
                      var city = json.City;
                      var district = json.District;
                      var Taluka = json.talukaa;
                      var pincode = json.Pincode;
                      var Village = json.village;
                      var zone = json.Zone;
                      var Country = json.country;
                      var hdlevel = json.hdLevel;
                      var hdloc = json.hdLoc;
                      
                       sumitfunc1(state,city,district,Taluka,pincode,Village,zone,Country,hdlevel,hdloc);
                        //sumitfunc1(1,,,,,,,,,);
                      /*$.ajax({
                        type: 'GET',    
                        url:'member-3-test.php',
                        data: response,
                        success: function(msg){
                        //alert(msg);
                            document.getElementById('show').innerHTML=msg;
                        } 
                      });*/
                   }
                    
                 },
             });
    }
    
    function sumitfunc1(s,city,d,t,p,v,z,Country,hdlevel,hdloc){
            var State= s; 
            var City= city;
            var District= d;
            var talukaa= t;
            var Pincode= p;
             var village= v;
            var Zone= z;
            var country= Country;
            var hdLevel= hdlevel;
            var hdLoc= hdloc;
            
            var jk = 'State='+State+'&City='+City+'&District='+District+'&talukaa='+talukaa+'&Zone='+Zone+'&country='+country+'&Pincode='+Pincode+'&village='+village+'&hdLevel='+hdLevel+'&hdLoc='+hdLoc;
            $.ajax({
               type: 'POST',    
               url:'member-3-test.php',
                data:'State='+State+'&City='+City+'&District='+District+'&talukaa='+talukaa+'&Zone='+Zone+'&country='+country+'&Pincode='+Pincode+'&village='+village+'&hdLevel='+hdLevel+'&hdLoc='+hdLoc,
               success: function(msg){
                   //alert(msg);
                   console.log(jk);
                 document.getElementById('show').innerHTML=msg;
                } 
            })
        }
    
</script>

