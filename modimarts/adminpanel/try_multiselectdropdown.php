<?php 
session_start();
include('header.php');
include('config.php');
include('access.php');

             				  
?>



<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Merabazaar</title>
        <link rel="stylesheet" href="css/stylesheet.css">
       
      

       
              <script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
              <script type="text/javascript" src="../requiredfunctions.js"></script>
    	     <link href="../catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
               
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                <script type="text/javascript" src="../catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                
                <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
    <!-- FONT -->

        <!-- FONT -->

<style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}

</style>
 <style>
button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
     border-radius: 8px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>




      </head>
 
  <body class="common-home page-common-home layout-fullwidth" >
    
          <font color="black" >Company Category</font>
     <label class="col-sm-3 control-label" for="input-firstname" id="id-cat" style="display:none"><font color="black" >Category</font></label>
   <input type="hidden" id="cat" name="cat">
   <input type="hidden" id="catn" name="catn">
   
<div class="compny">

   
    <span class="input">
      <select   id="compny" name="compny"     >
        
			 <optgroup label="Swedish Cars">	
      	<option   value="ram" /> tam </option>
        <option   value="san" /> ram </option>
         </optgroup>
          <optgroup label=" Cars">
     	<option   value="cc" /> ka </option>
        <option   value="ccv" /> rr </option>
   	</optgroup>
        </select>
    </span>
</div>

</div>
</body>

</html>
 
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>
<script>
$(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.compny select option');
  var selected = $('.compny').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.compny').find('select').empty().append( my_options );
  $('.compny').find('select').val(selected);
  
  // set it to multiple
  $('.compny').find('select').attr('multiple', true);
  
  // remove all option
  $('.compny').find('select option[value=""]').remove();
  // add multiple select checkbox feature.
  $('.compny').find('select').multiselect();
})

</script>

 <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
