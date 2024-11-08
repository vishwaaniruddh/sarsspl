<?php session_start();
ini_set('memory_limit','2048M');
//error_reporting(0);
include ('config.php');
//include('query.php');


/*if(!empty($_POST['ok'])){
    var_dump($_POST);
}*/


//include('header.php');
?>

 <!DOCTYPE html>
<html> 
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Sham Baba Dham">
      <meta name="keywords" content="">
      <meta name="google-site-verification" content="2Fq6NtH8i4jxT7m2fz29qveBpJsQ1sDLI_c_OEji5yM">
      
  <title>Offline Form</title>
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" crossorigin="anonymous">-->
  <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">
      
      <link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">
      <link href="https://fonts.googleapis.com/css?family=Raleway+Dots|Raleway:400,500,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://shyambabadham.com/css/css_new/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
      <!--<script src="https://shyambabadham.com/js/jquery.min.js"></script>-->
      <script src="https://shyambabadham.com/js/popper.min.js"></script>
      <!--<script src="https://shyambabadham.com/js/bootstrap.min.js"></script>-->
      <link rel="stylesheet" href="https://shyambabadham.com/css/css_new/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="https://shyambabadham.com/css/css_new/slick.min.css">
      <script src="https://shyambabadham.com/js/slick.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://shyambabadham.com/css/css_new/style.css">
      <meta property="og:image" content="https://shyambabadham.com/images/eng-logo.png">
      
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      
         <!--Aniruddh-->
          <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
  
  <style type="text/css">
         .mainslider .slide-text:after{left: 449px;
         width: 20%;}
         .mainslider .dham:after {
         left: 495px;
         width: 11%;
         }
         img{
          height: 100%;
          width: 100%;
         }
         .form-check-input {
    position: absolute;
    margin-top: .3rem;
     margin-left: auto; 
    right: 10%;
}   
.form-control{
    display: flex;
}
.left-title{width:30%;}
.seperate .left-title{width:30%;}
.seperate .right-value{margin-left:10px;}
.seperate .right-value{font-weight:700;}
.form-check-input {
    position: absolute;
    margin-top: -1.7rem;
    margin-left: auto;
    right: 10%;
    height: 31px;
    width: 16px;
}
	.table{
	 border-collapse: collapse;
  width: 100%;
}
input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-calendar-picker-indicator {
    display: none;
    -webkit-appearance: none;
}

 th {
  border: 2px solid #000;

  text-align: center;
  padding:6px 4px;
}
.newHide{
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
td{
    border: 1px solid #000;
  
    text-align: center;
  padding:6px 4px;
    
}
.checked {
  color: orange;
}
/*.detail2{padding:1em 1em 2em;}*/
.detail2 strong{font-size:18px;}
.customer-title{width:45%;}
.customer-detail{margin-left:10px;}
.customer-detail{font-weight:700;}
</style>
<style>
body {font-family: Arial;}
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

/* Style the close button */
.topright {
  float: right;
  cursor: pointer;
  font-size: 28px;
}

.topright:hover {color: red;}

.inner-div{
	width: 50%;
	margin: 10px;
}
.form-group{
	display: flex;
}
.custom-upload{
	width: 100%;
	/*margin: auto;*/
}
.div-content{
    width: 80%;
}
.div-image{
    width: 20%;
    padding: 10px;
    height: 75%;
}

.btn-circle {
  width: 45px;
  height: 45px;
  line-height: 45px;
  text-align: center;
  padding: 0;
  border-radius: 50%;
}

.btn-circle i {
  position: relative;
  top: -1px;
}
</style>
   </head>
<body style="font-size:14px" class="container" >
   
 <?php //include('admin_menu.php');?>
     <!-- Latest compiled and minified CSS -->
  <hr style="margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 4px solid rgba(0,0,0,.1);"/> 
    
   <?php //include 'menu.php';
    ?>
    <header id="header" style="background-color:#ea5b2c;">
        <img src="https://shyambabadham.com/images/vishwa_header.png">
    </header>
    
    <div>
        <h3 class="text-center"><u>1 रात प्रति वर्ष की सदस्यता के लिए आवेदन</u></h3></div><br>
   <div class = " p-1" id="offline_form" class="tabcontent">
    <div class="row">
        
        <div class="col-md-12" id="off_form">    
            <form action="offline_form_process.php" method="POST" enctype="multipart/form-data" id="form" class="form">
            <!--<form method="POST">-->
              <div id="inner">
              
              <div class="form-group row" name="mem" id="mem">
                <div class="col-lg-10 col-sm-12 col-md-9">
              <div class="form-row" style="margin-bottom: 1%;">
                <label class="col-sm-2 font-weight-bold">मुख्य सदस्य का नाम :</label>
                <input type="text" class="form-control col-sm-10" name="name[]" id="memM" onkeyup="my(this.id)">
                </div>
                <div class="form-group row" >
                <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1%;">
                    <label class="font-weight-bold">जन्म तिथि : </label>
                    <input type="date" class="form-control" name="dob[]" id="dobM" onkeyup="my(this.id)">
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1%;">
                    <label class="font-weight-bold">लिंग : </label>
                    <select  class="form-control" name="gender[]" id="genderM" onchange="my2(this,this.id)">
                        <option value='' >Select</option>
                        <option value="Female">महिला</option>
                        <option value="Male">पुरुष</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1%;">
                    <label class="font-weight-bold">मोबाइल :</label>
                    <input type="number" class="form-control" name="mobile[]" id="mobileM" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" minlength="10"  size="10"
                        onchange="javascript: if (this.value.length < this.minLength){ swal('Mobile no. should be of 10 digits'); document.getElementById('mobileM').focus(); }"
                        placeholder="Enter mobile number" onkeypress="javascript:return isNumber(event)" onkeyup="my(this.id)">
                </div>
                
              </div>
              <div class="form-group row">
                <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1%;">
                    <label class="font-weight-bold">पैन कार्ड नं. :</label>
                    <input type="text" class="form-control" name="pan[]" id="panM" style="text-transform: uppercase;" onkeyup="my(this.id)">
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1%;">
                    <label class="font-weight-bold">आधार कार्ड नं. :</label>
                    <input type="text" class="form-control" name="aadhar[]" id="aadharM"oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "12" minlength="12"  size="12"
                    onchange="javascript: if (this.value.length < this.minLength){ swal('आधार संख्या 12 अंकों की होनी चाहिए'); document.getElementById('aadharM').focus(); }"
                    placeholder="Enter your 12 digit Aadhar number" onkeypress="javascript:return isNumber(event)" onkeyup="my(this.id)">
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 1%;">
                    <label class="font-weight-bold">फ़ोटो :</label>
                      <div class="input-group">
                      <!--<div class="input-group-prepend">
                        <span class="input-group-text" name="upload" id="uploadImage0" onclick='upload(this.id)'>अपलोड</span>
                      </div>-->
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/gif, image/jpeg, image/png"
                          aria-describedby="uploadImage0"  id="sortpicture0" name="sortpicture[]" onchange="upload(this.id)" multiple>
                        <label class="custom-file-label" for="sortpicture0" >अपनी तस्वीर चुनें         </label>
                      </div>
                  </div>
                  
                    <input type="text" name="image[]" id="image0" value="" hidden>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-3 col-lg-2" style="height:80%">
                  <img src="offline_doc/placeholder/placeholder.png" id="img0" class="img-thumbnail img-fluid" alt="Responsive image" >
              </div>
              
               
              </div>
              </div>
              <div class="form-group" >
                  <div class='col-sm-4' ></div>
                  <div class='col-sm-4 text-center'>
                    <div  name="add_member" id="add" class="btn  btn-primary text-center " onclick="myFunction()"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add member&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                  </div>
                  <div class='col-sm-4' ></div>
              </div>
                
                
                <div class="form-group" name="address">
                    <div class="col-12">
                    <div class="form-group row" style="margin-bottom: 1%;">
                    <label class="col-sm-1 font-weight-bold">पता :</label>
                    <input type="text" class="form-control col-sm-11" name="addr" id="addr" onkeyup="my(this.id)">
                    </div>
                    <div class="form-group row" style="margin-bottom: 1%;">
                        <label class="col-sm-1 font-weight-bold">अस्थायी पता :</label>
                        <input type="text" class="form-control col-sm-11" name="tempaddr" id="tempaddr" onkeyup="my(this.id)">
                    </div>
                </div>
                </div>
                
                <div class="form-group " name="date-place" >
                        <div class="col-sm-12 col-md-8 col-lg-6">
                        <div class="form-group row" style="margin-bottom: 1%;">
                            <label class="col-sm-2 font-weight-bold">दिनांक :</label>
                            <input type="date" class="form-control col-sm-6" name="date" id="date" onkeyup="my(this.id)">
                        </div>
                        
                        <div class="form-group row" style="margin-bottom: 1%;">
                            <label class="col-sm-2 font-weight-bold">स्थान :</label>
                            <input type="text" class="form-control col-sm-6" name="place" id="place" onkeyup="my(this.id)">
                        </div>
                    
                    </div>
                </div>
                
                <div class="form-group row" name="buttons" >
                    <div class="col-lg-4  text-center" ></div>
                    <div class="col-lg-4 col-sm-12  text-center" >
                        <button class="btn btn-success text-center col-sm-12" id="submit" name="ok" hidden>Submit</button>
                    </div>
                    <div class="col-lg-4  text-center" ></div>   
                </div>
              
              <!--<Button type="button" name="submit" onclick="checkN();" class="btn btn-primary text-center">Submit</Button>-->
            </form>
            
            <div class='p-1 row'>
            <div class="col-xl-2"></div>
            <div id="preview"  class=" col-xl-8" >
                <div id='preview1'>
                    <div class="form-group row">
                    <div  class='col-lg-10 col-md-10 col-sm-12'>
                <div class="form-inline row text-left">
                    <p class="col-4 col-sm-3 col-md-3 font-weight-bold" >मुख्य सदस्य का नाम :</p>
                    <lable class="col-8 col-sm-9 col-md-9" style=" border-bottom: 1px dotted;" id='memMp'></lable>
                </div>
                <div class='form-inline row'>
                    <div class='form-inline col-sm-5 col-8'>
                        <p style='width:40%' class="font-weight-bold">जन्म तिथि : </p>
                    <lable style="width:60%;  border-bottom: 1px dotted;" id='dobMp' class=''></lable>
                    </div>
                    <div class='form-inline col-sm-3 col-4'>
                        <p style='width:40%' class="font-weight-bold"> लिंग : </p>
                    <lable style="width:60%; border-bottom: 1px dotted;" id='genderMp' class=''></lable>
                    </div>
                    <div class='form-inline col-sm-4 col-6'>
                        <p style='width:40%' class="font-weight-bold">मोबाइल : </p>
                    <lable style="width:60%; border-bottom: 1px dotted;" id='mobileMp' class=''></lable>
                    </div>
                    
                    <div class='form-inline col-sm-4 col-6'>
                        <p style="width:50%;" class="font-weight-bold">पैन कार्ड नं. :</p>
                        <lable style="width:50%; border-bottom: 1px dotted;" id='panMp' class=''></lable>
                    </div>
                    <div class='form-inline col-sm-5 col-8'>
                        <p style="width:50%;" class='font-weight-bold' >आधार कार्ड नं. :</p>
                        <lable style="width:50%; border-bottom: 1px dotted;" id='aadharMp' class=''></lable>
                    </div>
                    
                </div>
                
                </div>
                <div  class='col-sm-12 col-md-2 col-lg-2'>
                    <img src="offline_doc/placeholder/placeholder.png" id="imgp0" style="width:120px;height:120px;">
                </div>
                </div>
                </div>
                <div>
                    
                    <div class='form-inline row '>
                        <p class="col-sm-1 col-md-1 col-2 font-weight-bold"  >पता :</p>
                        <lable style=" border-bottom: 1px dotted;" id='addrp' class='col-sm-11 col-md-11 col-10'></lable>
                    </div>
                    <div class='form-inline row '>
                        <p class="col-sm-2 col-md-2 col-4 font-weight-bold" >अस्थायी पता :</p>
                        <lable style=" border-bottom: 1px dotted;" id='tempaddrp' class='col-sm-10 col-md-10 col-8'></lable>
                    </div>
                    
                    <div class="form-inline row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-inline row">
                            <p class="col-md-2 col-lg-3 col-4 font-weight-bold" >दिनांक :</p>
                            <lable style=" border-bottom: 1px dotted;" id='datep' class='col-md-6 col-lg-6 col-6'></lable>
                        </div>
                        <div class="form-inline row">
                            <p class="col-md-2 col-lg-3 col-4 font-weight-bold" >स्थान :</p>
                            <lable style="border-bottom: 1px dotted;" id='placep' class='col-md-6 col-lg-6 col-6'></lable>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-1" style=""></div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-5" style="">
                        <div class="text-center">
                            <!--<p style=" border-bottom: 1px dotted;" class="form-row" id='signp' class=''></p>-->
                            <hr align="center" style="border-bottom: 1px solid black; padding-top: 20px;border-top:transparent;">
                            <p class="font-weight-bold">आवेदक के हस्ताक्षर :</p>

                        </div>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                <div class="inner-div  text-center" ></div>
                <div class="inner-div  text-center" >
                    <button class="btn btn-success text-center" id="sub" type="button"  name="ok1" style="width:100%" onclick='prnt()'>Submit</button>
                    <!--'document.getElementById("submit").click();
                    prnt();-->
                </div>
                <div class="inner-div  text-center" ></div>
            </div>
            </div>
            
            <div class="col-xl-2"></div>
            </div>
        </div>
            
            
        </div>
    </div>
    <div class="form-group row">
                <div class="col-lg-4  text-center" ></div>
                <div class="col-lg-4 col-sm-12 text-center" >
                    <button class="btn btn-outline-warning text-center" type="button"  id="demo1" name="ok1" style="width:100%" onclick='preview(this.id)'>Preview</button>
                </div>
                <div class="col-lg-4  text-center" ></div>
            </div>

</div>   
<script type="text/javascript"> 
document.getElementById('date').valueAsDate = new Date();
document.getElementById('datep').innerHTML = document.getElementById('date').value;
var o = 1;
function prnt(){
    var header = document.getElementById('header');
    var sub = document.getElementById('sub');
    var prv = document.getElementById('demo1');
    var form_data = $("form").serializeArray();
    console.log(form_data);
    
    if(o == 1){
        
        $.ajax({
            url: 'offline_form_process.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if     anything
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                console.log(php_script_response);
                if(php_script_response != 'null'){
                    header.style.display = 'block';
                    sub.style.display = 'none';
                    prv.style.display = 'none';
                    
                    window.print();
                    
                    sub.style.display = 'block';
                    prv.style.display = 'block';
                } // display response from the PHP script, if any
                else { 
                    swal("Data insertion Failed !");
                }
            }
        });
        
        o++;
        console.log(o);
    }
    else{
        o++;
        header.style.display = 'block';
        sub.style.display = 'none';
        prv.style.display = 'none';
        
        window.print();
        
        sub.style.display = 'block';
        prv.style.display = 'block';
        
    }
    
}
    function PrintDiv() {    
       var divToPrint = document.getElementById('preview');
       //window.print();
      var popupWin = window.open('', '_blank', 'width=800,height=600');
      popupWin.document.open();
      popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>
<script type="text/javascript">

var pre= document.getElementById("preview");
pre.style.display="none";
var rid = document.getElementById("form");
        rid.style.display = 'block';
        
//var ids[100];
var i = 0;

function deletediv(id){
    if(i>0){
    var delid = id;
    delid=delid.split('del');
    var divdel = 'mem_'+delid[1];
    var divdelpre = divdel+'p';
    console.log(divdel);
    
    var element = document.getElementById(divdel);
    var elementpre = document.getElementById(divdelpre);
    //element.style.display = "none";
    //elementpre.style.display = "none";
    
    element.parentNode.removeChild(element);
    elementpre.parentNode.removeChild(elementpre);
    i--;
    }
}
function myFunction() {
  var btn = document.createElement("span");
  j=++i;
btn.innerHTML = "<div class='form-group row' id='mem_"+j+"' name='mem_"+j+"'><div class='col-lg-10 col-sm-12 col-md-9 '><div class='form-row' style='margin-bottom: 1%;'><label class='col-sm-2 font-weight-bold'>परिवार के सदस्य "+j+" :</label><input type='text' class='form-control col-sm-10' name='name[]'id='mem"+j+"' onkeyup='my(this.id)'></div><div class='form-group row' ><div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 1%;'><label class='font-weight-bold'>जन्म तिथि :</label><input type='date' class='form-control' id='dob"+j+"' name='dob[]' onkeyup='my(this.id)'></div><div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 1%;'><label class='font-weight-bold'>लिंग : </label><select  class='form-control' name='gender[]' id='gender"+j+"' onchange='my2(this,this.id)'><option value=''>Select</option><option value='Female'>महिला</option><option value='Male'>पुरुष</option></select></div><div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 1%;'><label class='font-weight-bold'>मोबाइल :</label><input type='text' class='form-control' name='mobile[]' id='mobile"+j+"' onkeyup='my(this.id)' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxlength = '10' minlength='10'  size='10' onchange='javascript: if (this.value.length < this.minLength){ swal('Mobile no. should be of "+j+"0 digits'); document.getElementById('mobile"+j+"').focus(); }' placeholder='Enter mobile number' onkeypress='javascript:return isNumber(event)' ></div></div><div class='form-group row'><div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 1%;'><label class='font-weight-bold'>पैन कार्ड नं. :</label><input type='text' class='form-control' name='pan[]' id='pan"+j+"' onkeyup='my(this.id)' style='text-transform: uppercase;'></div><div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 1%;'><label class='font-weight-bold'>आधार कार्ड नं. :</label><input type='text' class='form-control' name='aadhar[]' onkeyup='my(this.id)' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxlength = '12' minlength='12'  size='12' id='aadhar"+j+"' onkeyup='my(this.id)' onchange='javascript: if (this.value.length < this.minLength){ swal('आधार संख्या 12 अंकों की होनी चाहिए');document.getElementById('aadhar"+j+"').focus(); }'  placeholder='Enter your 12 digit Aadhar number' onkeypress='javascript:return isNumber(event)' ></div><div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 1%;'><label class='font-weight-bold'>फ़ोटो :</label><div class='input-group custom-upload' ><div class='custom-file'><input type='file' name='sortpicture[]' accept='image/gif, image/jpeg, image/png' class='custom-file-input' id='sortpicture"+j+"' aria-describedby='uploadImage"+j+"' style='cursor: pointer;' type='file' onchange='upload(this.id)' multiple><label class='custom-file-label'>अपनी तस्वीर चुने    </label></div></div></div></div><input type='text' name='image[]' id='image"+j+"' value='' hidden></div><div class='col-sm-12 col-md-3 col-lg-2' style='height:80%'><img src='offline_doc/placeholder/placeholder.png' class='img-thumbnail img-fluid' id='img"+j+"' alt='Responsive image' ></div><div class='col-lg-12 col-sm-12 col-md-12 text-center'><div class='btn btn-danger ' id='del"+j+"' onclick='deletediv(this.id)' style='margin-top: 1%;'><i class='fa fa-minus' aria-hidden='true'></i> &nbsp;Remove member</div></div></div>";
//document.getElementById('inner').appendChild(btn);
  
  var inner = document.createElement("div");
  inner.innerHTML='<div class="form-group row" id="mem_'+j+'p"><div  class="col-lg-10 col-md-9 col-sm-12"><div class="form-inline row text-left"><p class="col-4 col-sm-3 col-md-3 font-weight-bold" >परिवार के सदस्य '+ j+':</p><lable class="col-8 col-sm-9 col-md-9" style=" border-bottom: 1px dotted;" id="mem'+j+'p"></lable></div><div class="form-inline row"><div class="form-inline col-sm-5 col-8"><p style="width:40%" class="font-weight-bold">जन्म तिथि : </p><lable style="width:60%;  border-bottom: 1px dotted;" id="dob'+j+'p" class=""></lable></div><div class="form-inline col-sm-3 col-4"><p style="width:40%" class="font-weight-bold"> लिंग : </p><lable style="width:60%; border-bottom: 1px dotted;" id="gender'+j+'p" class=""></lable></div><div class="form-inline col-sm-4 col-6"><p style="width:40%" class="font-weight-bold">मोबाइल : </p><lable style="width:60%; border-bottom: 1px dotted;" id="mobile'+j+'p" class=""></lable></div><div class="form-inline col-sm-4 col-6"><p style="width:50%;" class="font-weight-bold">पैन कार्ड नं. :</p><lable style="width:50%; border-bottom: 1px dotted;" id="pan'+j+'p" class=""></lable></div><div class="form-inline col-sm-5 col-8"><p style="width:50%;" class="font-weight-bold">आधार कार्ड नं. :</p><lable style="width:50%; border-bottom: 1px dotted;" id="aadhar'+j+'" class=""></lable></div></div></div><div  class="col-sm-12 col-md-3 col-lg-2"><img src="offline_doc/placeholder/placeholder.png" id="imgp'+j+'" style="width:120px;height:120px;"></div></div>';
  
  if(j<=4){
      document.getElementById('inner').appendChild(btn);

      document.getElementById('preview1').appendChild(inner);
  }else{
      swal("Can't add more member...");
  }
      
} 
    
function uploadAgSign(){
    //alert("running")
    var file_data = $('#sortpictureSignAgent').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    // alert(form_data);                             
    $.ajax({
        url: 'offline_pan_uploader.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            if(php_script_response == '0'){
                swal("File Error");
            } // display response from the PHP script, if any
            else { 
                var pan_file = php_script_response;
                console.log('agent image : '+php_script_response);
                swal("File Uploaded");
                $("#agentSign").val(pan_file);
            }
        }
     });
}

function uploadAppSign(){
    var file_data = $('#sortpictureSignApplicant').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    // alert(form_data);                             
    $.ajax({
        url: 'offline_pan_uploader.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            if(php_script_response == '0'){
                swal("File Error");
            } // display response from the PHP script, if any
            else { 
                var pan_file = php_script_response;
                console.log('applicant image : '+php_script_response);
                swal("File Uploaded");
                $("#applicantSign").val(pan_file);
            }
        }
     });
}

function insertData(){
    //alert("running")
    var form_data = $('#form').serializeArray();   
    // alert(form_data);  
    console.log(form_data);
    $.ajax({
        url: 'offline_form_preview.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            /*if(php_script_response == '0'){
                swal("File Error");
            } // display response from the PHP script, if any
            else { 
                var pan_file = php_script_response;
                console.log('agent image : '+php_script_response);
                swal("File Uploaded");
                $("#agentSign").val(pan_file);
            }*/
            
            console.log(php_script_response);
            prnt();
        }
     });
}
var k=1;   
function preview(id){
    if(k%2==1){
        var rid = document.getElementById("form");
        rid.style.display = 'none';
        //$("#form").hide();
        var prv = document.getElementById("preview");
        prv.style.display = "block";
        //$("#preview1").show();
        k++;
        document.getElementById(id).innerHTML = "Edit";
    }else{
         var rid = document.getElementById("form");
        rid.style.display = 'block';
        //$("#form").hide();
        var prv = document.getElementById("preview");
        prv.style.display = "none";
        //$("#preview1").show();
        k--;
        //console.log(k);
        document.getElementById(id).innerHTML = "Preview";
    }
    
    
}   
   
function my(id){
    var rid = id;
    
    //console.log(rid);
    pid = rid+'p';
        //console.log(pid);

    //console.log(rid.value);
        document.getElementById(pid).innerHTML = document.getElementById(rid).value.toUpperCase();
        

}

//my('date');

function my2(element,id){
    var rid = id;
    
    //console.log(rid);
    pid = rid+'p';
        //console.log(pid);

    //console.log(element.options[element.selectedIndex].text);
        document.getElementById(pid).innerHTML = element.options[element.selectedIndex].text;
        

}


function check(){
    var name = document.getElementById('name');
    var age = document.getElementById('age');
    var gender = document.getElementById('gender');
    var mobile = document.getElementById('mobile');
    var pan = document.getElementById('pan');
    var aadhar = document.getElementById('aadhar');
    
    var formdata = document.getElementById('mem').serializeArray();  
    console.log(formdata);
}



function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        



</script>
<script type="text/javascript">

function upload(id) {
    var fid = id;
    fid = fid.split("sortpicture");
    //alert("running");
    console.log(fid);
    var file_data = $('#sortpicture'+fid[1]).prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    // alert(form_data);                             
    $.ajax({
        url: 'offline_pan_uploader.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            if(php_script_response == '0'){
                swal("File Error");
            } // display response from the PHP script, if any
            else { 
                var pan_file = php_script_response;
                swal("File Uploaded");
                console.log(pan_file);
                $("#image"+fid[1]).val(pan_file);
                 $("#img"+fid[1]).attr("src", "offline_doc/"+php_script_response);
                 $("#imgp"+fid[1]).attr("src", "offline_doc/"+php_script_response);
                //console.log(document.getElementById("image"+fid[1]).value);
            }
        }
     });
}
  			
	</script>
<script>
    
</script>
        <!--<div id="show">-->
        
             <?php// include('Footer_Hindi.php');?>
    </body>
</html>


