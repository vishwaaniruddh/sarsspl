<?php
if($pid!="" & $pid>0)
{
if($Maincate==1)
{
    $sqlimg23="SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc";
}
else if($Maincate==190)
{
    $sqlimg23="SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc";
}
else if($Maincate==218)
{
    $sqlimg23="SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc";
}
else if($Maincate==482)
{
    $sqlimg23="SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='$pid' order by id asc";
}
else 
{
    $sqlimg23="SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc";
}

}

    $rowimgqr=mysqli_query($con1,$sqlimg23);
    $cont=mysqli_num_rows($rowimgqr);
 
   $ct==1;
while($rowimg23=mysqli_fetch_array($rowimgqr))
{
    if($ct<=3){
       
    
?>

<div class="row sliderct" >
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 9px;">
                          <!--  <img data-u="image" style="height:85px;width:90px;" src="userfiles/398/img/2018/04/15233679692.jpg">-->
                           <a href="javascript:void(0)" onclick="shfunc('<?php echo $rowimg23[2];?>','<?php echo $rowimg23[3];?>');"><img data-u="image"  src="<?php echo $rowimg23[2];?>" style="height:80px;width:80px;"/></a>
          
                        </div>
                    </div>
        
            
            
           
           


            
<?php } $ct++; }?> 



              