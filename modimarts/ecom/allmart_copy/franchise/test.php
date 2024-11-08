<?php
session_start();
//var_dump($_SESSION['user_name']);

//error_reporting(0);
include ('config.php');
//include('query.php');

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

$ward_query="SELECT * FROM ward"; 
$ward_con=mysqli_query($conn,$ward_query);
$w=array();
  while($fetchs=mysqli_fetch_array($ward_con)){
      $w[]=$fetchs[1];
  }
$village_query="SELECT * FROM village"; 
$village_con=mysqli_query($conn,$village_query);
$v=array();
  while($fetchs=mysqli_fetch_array($village_con)){
      $v[]=$fetchs[1];
  }

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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!--	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>-->
	<!-- Typahead -->
	<link rel="stylesheet" href="css/custom.css">
	<script  type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
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
     /* Ward auto suggestion */
        var w = <?php echo json_encode($w); ?>
    // Constructing the suggestion engine
    var w = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: w
    });
    // Initializing the typeahead
    $('#txtWard').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'w',
        source: w,
    });
    /* Village auto suggestion */
        var v = <?php echo json_encode($v); ?>
    // Constructing the suggestion engine
    var v = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: v
    });
    // Initializing the typeahead
    $('#txtVillage').typeahead({
        hint: true,
        highlight: true, /* Enable substring highlighting */
        minLength: 1, /* Specify minimum characters required for showing result */
    },
    {
        name: 'v',
        source: v,
    });
});  
</script>
</head>
<body onload="sumitfunc();zone()"  >
    <?php include 'menu.php'?>
        <div class="" align="center" >
            <div class="row" style="margin-top:1%;">
                <div class="col-md-4">
                <h3 style="margin-top: -10px;margin-right:57%;">Search</h3>
          <div class=" box-heights" ><b>Country:</b>
            <div class="bs-example">
                <input type="text" name="txtCountry" id="txtCountry" onblur="searchCountry()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdCountry" value="" id="hdCountry">
                <input type="hidden" name="hdLevel" value="1" id="hdLevel"><!-- for last selected dropdown level -->
                <input type="hidden" name="hdLoc" value="1" id="hdLoc">
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
            <select class="rounded" name="talukaa" id="talukaa" onchange="ward()">
                <option value="" >Select Taluka</option>
            </select>
         </div>
         <div class="box-heights"  ><b>Ward:</b>
            <div class="bs-example">
                <input type="text" name="txtWard" id="txtWard" onblur="searchWard()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdWard" value="" id="hdWard">
            </div>
            <select class="rounded" name="ward" id="ward" onchange="village()">
                <option value="" >Select Ward</option>
            </select>
         </div>
         
         <div class="box-heights" ><b>Village:</b>
            <div class="bs-example">
                <input type="text" name="txtVillage" id="txtVillage" onblur="searchVillage()" class="typeahead tt-query" autocomplete="on" spellcheck="false" placeholder="search here">
                <input type="hidden" name="hdVillage" value="" id="hdVillage">
            </div>
            <select class="rounded" name="village" id="village" onchange="villages()">
                <option value="" >Select Village</option>
            </select>
         </div>
       </div>
        <div class="col-md-4">
          <!-- Ruchi -->
        <div class="row" style="margin:13px !important;">
              <div id="zones" style="display:none;" class="col-md-12" style=" width:25%;position:fixed;"> 
              <h3 style="margin-top: -20px;margin-left: -173%;"> Zone/State</h3>
                  <div class="table-responsive " style="height: 650px;width: 273px;margin-left: -173%;">
                    <table  class="table table-bordered table-striped" id="zonedetail">
                        <tr>
                            <th class="th-prop">Zone</th>
                            <th class="th-prop">State</th>
                        </tr>
                    </table>
                  </div>
                </div>
                <div id="cities" style="display:none;" class="col-md-12" style=" width:25%;position:fixed;">  
                  <!--<div class="col-md-6" style="margin-top: 23px;display:block;">-->
                  <h3 style="margin-top: -20px;margin-left: -145%;">City/District</h3>
                  <div class="table-responsive" style="height: 650px;width: 273px;margin-left: -173%;">
                        <table align="center" class="table table-bordered table-striped" id="citidetails" >
                            <tr>
                                <th class="th-prop">City</th>
                                <th class="th-prop">District</th>
                            </tr>
                        </table>
                    </div>    
                  </div>
                <div id="show" style="margin-left: 112%;">
          </div>
        </div>  
    </div>
    </div>
    </form>
    </div>
    </div>
            </div>
            </div>
        <!--<div id="show">-->
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
          var f=['District','talukaa','Ward','village'];  
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
          var f=['talukaa','Ward','village'];  
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
                    var newoption=' <option value="">Select</option>' ;
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
          var f=['talukaa','Ward','village'];  
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
       
        function sumitfunc(){
            var State= document.getElementById("State").value; 
            var City= document.getElementById("City").value;
            var District= document.getElementById("District").value;
            var talukaa= document.getElementById("talukaa").value;
            var Zone= document.getElementById("Zone").value;
            var country= document.getElementById("country").value;
            var hdLevel= document.getElementById("hdLevel").value;
            var hdLoc= document.getElementById("hdLoc").value;
            $.ajax({
               type: 'POST',    
               url:'test_process.php',
                data:'State='+State+'&City='+City+'&District='+District+'&talukaa='+talukaa+'&Zone='+Zone+'&country='+country+'&hdLevel='+hdLevel+'&hdLoc='+hdLoc,
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
          var f=['State','City','District','talukaa','Ward','village'];  
          clearAllFeild(f);
          DisableArrowKeys();
          //clearAllFeild('Zone');
            //clear feilds if selecetd
            $('#txtState').val(null);
            $('#txtCity').val(null);
            $('#txtDistrict').val(null);
            $('#txtTaluka').val(null);
            $('#txtWard').val(null);
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
          var f=['City','District','talukaa','Ward','village'];  
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
        function village() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
            DisableArrowKeys();
            var ward=document.getElementById("ward").value;
            $('#hdLevel').val(7);
            $('#hdLoc').val(ward);
            sumitfunc();
            $.ajax({
                type:'POST',
                url:'village.php',
                data:'ward='+ward,
                datatype:'json',
                success:function(msg){
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
        
        function villages() {
            if($('#cities').css('display') != 'none' || $('#zones').css('display')!='none'){ 
                 $('#cities').hide(); 
                 $('#zones').hide();
            }
            DisableArrowKeys();
            var village=document.getElementById("village").value;
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
                        //alert(msg);
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
                        //alert(msg);
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
                     	    ward();
                     	} else if(feild_id=='ward'){
                     	    village();
                     	} else if(feild_id=='village'){
                     	    villages();
                     	}
                    }
                })
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
        //$('#txtWard').val(null);
        
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
        $('#txtCountry').val();
        $('#txtZone').val();
        $('#txtState').val();
        $('#txtCity').val();
        $('#txtTaluka').val();
        $('#txtWard').val(null);
        
        district=document.getElementById('txtDistrict').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'district='+district,
                datatype:'json',
                success:function(msg){
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
        $('#txtTaluka').val();
        $('#txtWard').val(null);
        
        //taluka = $(this).val();
        var taluka=document.getElementById('txtTaluka').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'taluka='+taluka,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   if(jsr.length>0){
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].country);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                    }}
                })
    }
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
                    alert(msg)
                   var jsr=JSON.parse(msg);
                   if(jsr.length>0){
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].country);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                    }}
                })
    }
    //searchVillage
    function searchVillage(){
        //clear feilds if selecetd
        $('#txtCountry').val(null);
        $('#txtZone').val(null);
        $('#txtState').val(null);
        $('#txtCity').val(null);
        $('#txtDistrict').val(null);
        $('#txtTaluka').val(null);
        $('#txtWard').val(null);
        var village=document.getElementById('txtVillage').value;
        $.ajax({
                type:'POST',
                url:'search.php',
                data:'village='+village,
                datatype:'json',
                success:function(msg){
                   var jsr=JSON.parse(msg);
                   if(jsr.length>0){
                   $('#country').val(jsr[0].country);
                   $('#Zone').val(jsr[0].zone);
                   $('#State').val(jsr[0].country);
                   $('#City').val(jsr[0].zone);
                   $('#District').val(jsr[0].district);
                   $('#District').val(jsr[0].ward);
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

