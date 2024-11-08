<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="padding:0px; margin:0px; background-color:#fff;font-family:'Open Sans',sans-serif,arial,helvetica,verdana">

    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: http://www.jssor.com -->
    <!-- This code works without jquery library. -->
    <script src="js/jssor.slider-22.0.15.min.js" type="text/javascript" data-library="jssor.slider" data-version="22.0.15"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: true,
              $Idle: 0,
              $AutoPlaySteps: 4,
              $SlideDuration: 2500,
              $SlideEasing: $Jease$.$Linear,
              $PauseOnHover: 4,
              $SlideWidth: 110,
              $Cols: 4
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don t want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 309);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 10);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style></style>
    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 13px; left: -12px; width: 480px; height: 110px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('http://webapp77.nl/genie/bestanden/loading.png') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 480px; height: 110px; overflow: hidden;">

<?php
//$sqlimg="SELECT * FROM `product_images_new` WHERE `product_id`='$prid' limit 1,3";

//$prid=112;









if($pid!="" & $pid>0)
{
if($Maincate==1)
{
    $sqlimg23="SELECT img FROM `fashion_img` WHERE `product_id`='$pid' order by id asc";
}
else if($Maincate==190)
{
    $sqlimg23="SELECT img FROM `electronics_img` WHERE `product_id`='$pid' order by id asc";
}
else if($Maincate==218)
{
    $sqlimg23="SELECT img FROM `grocery_img` WHERE `product_id`='$pid' order by id asc";
}
else 
{
    $sqlimg23="SELECT img FROM `product_img` WHERE `product_id`='$pid' order by id asc";
}




//$sqlimg23="SELECT img FROM `product_img` WHERE `product_id`='$pid' ";

}


 

$rowimgqr=mysqli_query($con1,$sqlimg23);
while($rowimg23=mysqli_fetch_array($rowimgqr))
{
//$path2="../uploads".$rowimg23[0];


?>
</div>
    </div>

            <div>
                <a href="javascript:void(0)" onclick="shfunc('<?php echo $rowimg23[0];?>');"><img data-u="image" style="object-fit: cover;height:120px;width:120px;" src="<?php echo $rowimg23[0];?>" /></a>
            </div>
            
            
            </div>
                
        
     
<?php  }?> 

        
   
   
    
    <script type="text/javascript">jssor_1_slider_init();</script>
    <!-- #endregion Jssor Slider End -->
</body>
</html>
