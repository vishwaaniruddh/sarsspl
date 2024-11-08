<?php
session_start();


include ('config.php');
$state=$_GET['st'];
$city=$_GET['ci'];
$District=$_GET['Di'];
$pincode=$_GET['ta'];
$village=$_GET['p'];
$taluka=$_GET['v'];
$Zone=$_GET['Zo'];
$country=$_GET['con'];
$position=$_GET['pos'];
$hdLevel=$_GET['Lev'];
$hdLoc=$_GET['Loc'];
$id=0;
if(isset($_GET['id']))
{
    $id=$_GET['id'];
}

?>
 <!DOCTYPE html>
<html> 
  <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>member</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    <!-- Latest compiled and minified CSS -->
   <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">-->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
   
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
 
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

      <style>.mandir_plan h5:before{left: 40px;}</style>

 
 
 
                  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                  <link rel="stylesheet" href="/resources/demos/style.css">
                  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
 
 
 <style>
.rounded {
  border-radius: 20px;
  height: 40px;
}
</style>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 
</script>

<script>
    function validation()
    {
         var Name= document.getElementById("Name").value;
      //   var Address= document.getElementById("Address").value;
        var datepicker= document.getElementById("datepicker").value;
         var Email= document.getElementById("Gmail").value; 
         var Mobile= document.getElementById("Mobile").value;
        var hdpic= document.getElementById("hdpic").value;
          var up= document.getElementById("up").value;
          
         var countlength= Mobile.length;
         
    	var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
    	
          if(Name=="")
         {
         swal("please enter Name");
         return false;
         }
         /*else if(Address=="")
         {
         swal("please enter Address");
         return false;
         }
         else if (Email == "")
    	{
    		swal(" please fill email id ");
    		return false;
    		
    	}
         else if (!emailFilter.test(Email))
    	{
    		
    		swal("invalid email ")
    		return false;
    	}*/
         else if(Mobile=="")
         {
         swal("please enter Mobile Number");
         return false;
         }
         else if(countlength<10)
         {
         swal("please enter valid Mobile Number");
         return false;
         }
        else if(up=="" && hdpic=="")
         {
         swal("please choose your profile");
         return false;
         }
         else{
            return true;
        }
    }
</script>
<script>
    //See preview image 
    function readImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.profile_img')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
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
                        swal("Email Id already exist");
                         booldata= false;
                    } else {
                        //document.getElementById("myForm").submit();
                        booldata= true;
                    }
                 }
  })
    return booldata;
  }
  function finalval()
{
    if( validation())
    {
        document.getElementById("myForm").submit();
       return true; 
    }
    else
    {
        return false; 
    }
}

</script>
    </head>
    <body onload="AutoLoad()">
<?php include 'admin_menu.php'?>

<?php 
    
if(isset($_POST['click'])){
    echo 'click';exit;
}
?>
        <form  action="member_process.php" method="post" enctype="multipart/form-data" id="myForm">
            <div class="row" >
                <input type="hidden" id="state" name="state" value="<?php echo $state?>">
                <input type="hidden" id="city" name="city"  value="<?php echo $city?>">
                <input type="hidden" id="District" name="District" value="<?php echo $District?>">
                <input type="hidden" id="talukaa" name="talukaa" value="<?php echo $taluka?>">
                <input type="hidden" id="Pincode" name="Pincode" value="<?php echo $pincode?>">
                <input type="hidden" id="Village" name="Village" value="<?php echo $village?>">
                <input type="hidden" id="Zone" name="Zone" value="<?php echo $Zone;?>">
                <input type="hidden" id="country" name="country" value="<?php echo $country;?>">
                <input type="hidden" id="position" name="position" value="<?php echo $position;?>">
                <input type="hidden" id="hdLevel" name="hdLevel" value="<?php echo $hdLevel;?>">
                <input type="hidden" id="hdLoc" name="hdLoc" value="<?php echo $hdLoc;?>">
                <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                <h3 style="margin: 5% 41%;">Member</h3>
                <!--<fieldset>-->
                <?php 
                if(isset($_GET['id'])){
                    $query="select * from member where id=".$_GET['id'];
                    $data=mysqli_query($conn,$query);
                    $result=mysqli_fetch_assoc($data);
                    //var_dump($result['id']);
                }
                ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mail" ><b>Name:</b>&nbsp;<b style="color:red">*</b></label>
                        <input type="text" id="Name" name="Name" placeholder="Name" value="<?php if($id>0){echo $result['name'] ;}?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <p><b>Date of Birth:</b><input type="text" id="datepicker" name="datepicker" value="<?php if($id>0){echo $result['DOB'] ;}?>"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mail"><b>Mobile:</b>&nbsp;<b style="color:red">*</b></label>
                        <input type="text" id="Mobile" name="Mobile" value="<?php if($id>0){echo $result['mobile'] ;}?>" placeholder="Mobile Number"  maxlength="10" onkeypress="return isNumber(event)" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mail"><b>Email:</b></label>
                        <input type="text" id="Gmail" name="Gmail" placeholder="Email ID" value="<?php if($id>0){echo $result['email'] ;}?>">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="mail"><b>Upload Picture:</b>&nbsp;<b style="color:red">*</b>
                    <input type="file" id="up" name="up" value="<?php if($id>0){echo $result['file'] ;}?>" placeholder="Upload Picture" style="padding-top: 15px;" onchange="readImg(this);"  /></label>
                    <input type="hidden" id="hdpic" name="hdpic" value="<?php echo $result['file'];?>">
                    <?php  if(isset($result['file']) && $result['file']!=''){ ?>
                        <label for="up"> <img src="<?php echo $result['file']?>" width="40px" height="40px" class='profile_img'/></label>
                    <?php  } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mail"><b>Reference Mobile No:</b></label>
                        <input type="text" id="RefMobile" name="RefMobile"  class="form-control" onchange="getRefNameLevel();"  placeholder="Enter Reff. Mobile " maxlength="10" onkeypress="return isNumber(event)">
                    </div>
                    <div class="form-group col-md-6">
                        <label  ><b id="refName">Reference Name: </b> </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label ><b id="refLevel">Committee Level: </b> </label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <input type="button" name="click" id="clk" class="btn btn-primary" onclick="finalval()" style="width: 25% !important;" value="Submit">
                    <a href="member3.php"><button type="button" class="btn btn-danger"  style="width: 25% !important;">Cancel</button></a>
                </div>
            </div>
        </form>
        <?php include('Footer_Hindi.php');?>
    </body>
</html>
 <script>
  $( function() {
      
      var utc = new Date().toJSON().slice(0,10).replace(/-/g,'/');
      
      
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
       dateFormat: "dd/mm/yy",
 //   yearRange: "-90:+30"
 yearRange: "1800:"+utc
    });
  } );
  </script>
  
  
  
  
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />

        
       
        <script>
        
         var mobile=[];
    function AutoLoad(){
         $.ajax({
           type:'POST',
          url:'get_Auto_Suggetion.php',
          data:"",
          success:function(msg){
             // alert(msg);
               var jsr=JSON.parse(msg);
                for(var i=0;i<jsr.length;i++){
                           mobile.push(jsr[i]['mobile']);
                }
                         
                   test();    
             
          }
      })
    }
        
         
       function test(){
  $("#RefMobile").autocomplete({
    source:mobile,
    minLength: 1
  });
}

function getRefNameLevel(){
   var RefMobile= document.getElementById('RefMobile').value;
   var countlength= RefMobile.length;
   
    if(countlength==10)
     {
    alert(RefMobile);
    
    
      $.ajax({
           type:'POST',
          url:'get_Auto_Suggetion_NameLevel.php',
          data:"RefMobile="+RefMobile,
          success:function(msg){
              alert(msg);
             
               var jsr=JSON.parse(msg);
                
                
                
                         
                         $("#refName").text("Reference Name: ( " + jsr[0]['name'] +" )" );
                 //        $("#refLevel").text("Reference Level: ( " + jsr[0]['level_id'] +" )   /   Reference Position: ( " + jsr[0]['loc_id'] +" )   /    ( " + jsr[0]['position_id'] +" ) " );
                           $("#refLevel").text("Committee Level: (" + jsr[0]['level_id'] +"  - " + jsr[0]['loc_id'] +"  -  " + jsr[0]['position_id'] +" ) " );
                         
             
          }
      })
    
    
    
    
    
    
     }
    
   
    
    
}

</script>
