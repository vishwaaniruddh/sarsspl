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
              font-family: Arial !important; 
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
        
        
        $img=$user_Data->image;
        $logo=$user_Data->logo;
        $maincol=8;
        $mr=2;
        
        if($img=='')
        {
            $maincol+=2;
            $mr+=1;
        }
       
        
          if($logo=='')
        {
            $maincol+=2;
            $mr+=1;
        }
        
        
        
        ?>
         <input type="Hidden" value="<?=$user_Data->content1?>" id="footer_image">
        <div style="margin-top: 10px;">
        </div>
        <div id="html-content-holder" style="background-color: #ffffff; color: black width: 500px;">
            <img alt="" src="<?=$newstr?>" style="width: 100%;">
                <div>
                    <div class="row">
                       
                        <div class="col-sm-2 col-xs-2 col-md-2 text-left " style="margin-top: auto;margin-bottom: auto;">
                            <img id="greetimg" alt="" src="<?=base_url()?>/assets/images/logo/logo.png" style="width: 100%;"/>
                        </div>
                       
                        <div class="col-md-<?=$maincol?> col-sm-<?=$maincol?> col-xs-<?=$maincol?> content p-<?=$mr?>" style="border: 1px solid black;">
                           <?php if($user_Data->content!=''){ ?>  <h2 style="text-align: center;"><?=$user_Data->content?></h2><?php } ?>
                            <h2 style="text-align: justify;"><b>Appointing Areawise Sole Franchisee</b> for zone, state, division, District, Tahsil,Pincode, Village,Area at All india Level</h2>
                            <h2 style="text-align:center" class="m-0" >
                             <b> <?=$user_Data->customer_name?> - <?=$user_Data->mobile_number?> www.Allmart.World </b>
                            </h2>
                           
                        </div>
                        <?php
                         if($img!=='')
                            {
                        ?>
                        <div class="col-md-2 col-sm-2 col-xs-2 text-right " style="margin-top: auto;margin-bottom: auto;">
                            <img alt="" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$user_Data->image?>" style="width: 100%;"/>
                        </div>
                        <?php
                          }
                        ?>
                    </div>
                </div>
            </img>
        </div>
        <input id="btn-Preview-Image" type="button" value="Preview"/>
        <br/>
        <div id="previewImage" style="width:100%">
        </div>
       <script>
            async function downloadImage(imageSrc) {
              const image = await fetch(imageSrc)
              const imageBlog = await image.blob()
              const imageURL = URL.createObjectURL(imageBlog)
            
              const link = document.createElement('a')
              link.href = imageURL
              link.download = 'image file name here'
              document.body.appendChild(link)
              link.click()
              document.body.removeChild(link)
            }
            $(document).ready(function(){
                var element = $("#html-content-holder");
                var getCanvas;
                 window.scrollTo(0,0);
                     html2canvas(element, {
                        scale: 2,
                      useCORS: true,
                       allowTaint: true,
                     onrendered: function (canvas) {
                            $("#previewImage").append(canvas);
                            getCanvas = canvas;
                            var imgageData = getCanvas.toDataURL("image/png");
                            const start = Date.now();
                            var newData = imgageData.replace(/^data:image\/jpeg/, "data:application/octet-stream");
                            $("#btn-Preview-Image").attr(
                                    "download", start+".png").attr(
                                    "href", newData);
                             downloadImage(newData);       
                    
                      }
                     });
                
                

            });
        </script>
    </body>
</html>