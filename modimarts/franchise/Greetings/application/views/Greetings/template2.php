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
      font-family: inherit !important;
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
        
        
        $img=$user_Data->image;
        $logo=$user_Data->logo;
        $maincol=10;
        $mr=3;
        
        if($img=='')
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
                        <?php
                        if($logo!=='')
                           {
                        ?>
                        <div class="col-sm-2 col-xs-2 col-md-2 text-left " style="margin-top: auto;margin-bottom: auto;">
                            <img id="greetimg" alt="" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$user_Data->logo?>" style="width: 100%;"/>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-md-<?=$maincol?> col-sm-<?=$maincol?> col-xs-<?=$maincol?> content p-<?=$mr?>">
                           <?php if($user_Data->content!=''){ ?>  <h2 style="text-align: center;"><?=$user_Data->content?></h2><?php } ?>
                             <?php if($user_Data->content1!=''){ ?><h2 style="text-align: center;"><?=$user_Data->content1?></h2><?php } ?>
                            <?php if($user_Data->content2!=''){ ?> <h2 style="text-align: center;"><?=$user_Data->content2?></h2><?php } ?>
                            <?php if($user_Data->content3!=''){ ?> <h2 style="text-align: center;"><?=$user_Data->content3?></h2><?php } ?>
                            <p style="text-align:center" class="m-0" >
                                <?=$user_Data->customer_name?> -<?=$user_Data->mobile_number?>
                            </p>
                            <h2 style="text-align:center" class="m-0" >
                               <?php if($user_Data->email!=''){ ?> <?=$user_Data->email?> <?php } if($user_Data->website!=''){ ?>&nbsp;&nbsp;  <?=$user_Data->website?> <?php }?>
                            </h2>
                           
                        </div>
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
                // var footer_image=$("#footer_image").val();
                // if(footer_image!=''){
                    
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
                            const start = Date.now();
                            var newData = imgageData.replace(/^data:image\/jpeg/, "data:application/octet-stream");
                            $("#btn-Preview-Image").attr(
                                    "download", start+".png").attr(
                                    "href", newData);
                                    const a = document.createElement('a');
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
                // }
                // else
                // {
                //     alert("You Dont have sufficient Content, Please Goto edit Profile And Update !");
                //      window.close();
                    
                // }

            });
        </script>
    </body>
</html>