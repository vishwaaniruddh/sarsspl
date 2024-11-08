<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Slider - Range slider</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
       padding: 3px;
}
.column1 {
    float: center;
      padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>
  <script>
  $( document ).ready(function() {
     $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 150000,
      values: [ 0, 150000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rs: " + ui.values[ 0 ] + " - Rs: " + ui.values[ 1 ] );
        
       
      },
      change: function() {  funcs('',''); }
    });
    $( "#amount" ).val( "Rs: " + $( "#slider-range" ).slider( "values", 0 ) +
      " - Rs: " + $( "#slider-range" ).slider( "values", 1 ) );

funcs('','');
updatecart();
  } );
  </script>
</head>
<body>
    <div class="row">
        <div class="column" style="margin-left: -119px;height: 34px;padding-top: 10px;"><p style="width: 256px;">
            <label for="amount">Price range:</label>
            <input type="text" id="amount" readonly style="border:0;color: #f30606;font-weight:bold;background-color: whitesmoke;">
            </p>
        </div>
        <div class="column1"  > <div id="slider-range" style="left: 110px;width: 499px;top: 5px;z-index: 0;"> </div></div>
    </div>
<!--
<p style="width: 256px;">
  <label for="amount">Price range:</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>
 <div id="slider-range"> </div>
-->
</body>
</html>