<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js">
        </script>
        <script crossorigin="anonymous" integrity="sha512-NWNl2ZLgVBoi6lTcMsHgCQyrZVFnSmcaa3zRv0L3aoGXshwoxkGs3esa9zwQHsChGRL4aLDnJjJJeP6MjPX46Q==" referrerpolicy="no-referrer" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js">
        </script>
        <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-F7WyTLiiiPqvu2pGumDR15med0MDkUIo5VTVyyfECR5DZmCnDhti9q5VID02ItWjq6fvDfMaBaDl2J3WdL1uxA==" referrerpolicy="no-referrer" rel="stylesheet"/>
        <style>
        * { 
            font-family: Arial , sans-serif !important;
  
             
         }
            .content
            {
                    font-size: 262%;
                    font-weight: 700;
                    margin-top: auto;
                    margin-bottom: auto;
                            }
            h2
            {
                font-size: calc(2% + 2.4vw);
            }
            
        </style>
    </head>
    <body>
        <?php

//var_dump($user_Data);

$search  = 'https://www.allmart.world';
$replace = 'https://allmart.world';

$newstr = str_replace($search, $replace, $proimgdata->
        image);
        
        
        $footer_image=$user_Data->footer_image;
        
        
        
        ?>
        <input type="Hidden" value="<?=$footer_image?>" id="footer_image">
        <div style="margin-top: 10px;">
            
        </div>
        <div id="html-content-holder" style="background-color: #ffffff; color: black width: 500px;">
            <img alt="" src="<?=$newstr?>" style="width: 100%;">
            <div class="row" >
                <div class="col-md-10">
                      <img alt="" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$footer_image?>" style="width: 100%;"/>
                </div>
                 <div class="col-md-2 col-sm-2 col-xs-2 text-right " style="margin-top: auto;margin-bottom: auto;">
                            <img alt="" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$user_Data->image?>" style="width: 80%;"/>
                            <h5 style="width: 80%;" class="text-center"><b><?=$user_Data->customer_name?> </b></h5><h5 style="width: 80%;" class="text-center"><b><?=$user_Data->mobile_number?> </b> </h5>
                       </div>
                        
                 </div>
           </img>
        </div>
        <input id="btn-Preview-Image" type="button" value="Preview"/>
        <br/>
        <div id="previewImage" style="width:100%">
        </div>
       <script>
            $(document).ready(function(){
                var footer_image=$("#footer_image").val();
                if(footer_image!=''){
                    
            var element = $("#html-content-holder");
            var getCanvas;
                $(document).ready( function () {

                    window.scrollTo(0,0);
                     html2canvas(element, {
                        scale: 2,
                      useCORS: true,
                       allowTaint: true,
                     onrendered: function (canvas) {
                            $("#previewImage").append(canvas);
                            getCanvas = canvas;
                            var imgageData = getCanvas.toDataURL("image/png");
                            var newData = imgageData.replace(/^data:image\/jpeg/, "data:application/octet-stream");
                            $("#btn-Preview-Image").attr(
                                    "download", "myimage.png").attr(
                                    "href", newData);
                                    const a = document.createElement('a');
                                    const start = Date.now();
                                      a.href = newData;
                                      a.download = start+".jpeg";
                                      document.body.appendChild(a);
                                      a.click();
                                      document.body.removeChild(a);
                                        event.preventDefault();
                                        // history.back(1);

                      setTimeout(function() {
                          window.close();
                        }, 2000);
                      }
                     });
                });
                }
                else
                {
                    alert("You Dont have sufficient Content, Please Goto edit Profile And Update ! ");
                     window.close();
                    
                }

            });
        </script>
    </body>
</html>