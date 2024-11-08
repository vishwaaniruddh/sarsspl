<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); 

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
$userid=$_SESSION['userid'];
?>
<style>
    .module{
        background: 
        linear-gradient(
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.6)
        ),
        url(http://sarmicrosystems.i/quiztest/web/asset/woman_sitting.jpg);
        background-size: cover;
        width: 100%;
        height: 700px;
        /*margin: 10px 0 0 10px;*/
        position: relative;
        float: left;
    }
.heading h2 {
  font-family: 'Roboto', sans-serif;
  font-weight: 900;
  color: white;
  text-transform: uppercase;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 2rem;
  transform: translate(-50%, -50%);
}
    
</style>   



<!--banner-->
<div class="banner">
    <div class="module">
    <h2 class="heading">Friends</h2>
    </div>
</div>
<!--end Banner-->






<div class="custom_margin">
        
        
        <? if($userid){ ?>
            
        
        
        
        
        
        <div class="container">
            <h1 class="h1_friend">Invite Your friends</h1>
        <div class="row">
          <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsarmicrosystems.in%2Fquiztest%2Ffront%2Fregister.php?rg=_uId" class="col-md-4 invite">

            <div class="facebook_invite">
              <p>Facebook</p>
            </div>
          </a>
          
          
          <a class="col-md-4 invite" href="#" onclick=" event.preventDefault() ; emailinvite()">
            <div class="email_invite">
                    
             <p id="g">Email</p> 
            </div>
          </a>
          
 

             <?php

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{ ?>

         <a href="whatsapp://send?abid=phonenumber&text=https://sarmicrosystems.in/quiztest/front/register.php?rg= _uId" data-action="share/whatsapp/share" class="col-md-4 invite">
            <div class="whatsapp_invite">
              <p>Whatsapp</p>
            </div>
          </a>
<?php }
else{ ?>
  <a href="https://web.whatsapp.com/send?abid=phonenumber&text=http://sarmicrosystems.in/quiztest/web/my-account/my-account.php?rg=<? echo $userid; ?>" target="_blank" data-action="share/whatsapp/share" class="col-md-4 invite">
            <div class="whatsapp_invite">
              <p>Web Whatsapp</p>
            </div>
          </a>
          

<?php }
?>
        
              </div>     
        
        
        
        
    
        
        

<div class="custom_margin"></div>
        
        
          
<? 





$url = 'http://sarmicrosystems.in/quiztest_general/api/group/group_get_all_friend.php';
$data = array('userid' => $userid);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { 
    
    echo '0';
    
}
else{

$result=json_decode($result);


?>

    


       <div class="row">
    
   
 


<? for($i=0;$i<sizeof($result);$i++){ 
    
  $status=get_status($result[$i]->data->friend_id);
  ?>
    <div class="col-md-12">
        <div class="row friends_row">
            
             <div class="col-md-1 friends_img">
                <img src=<? echo $result[$i]->data->avatar;?> >
            </div>
            
            <div class="col-md-3">
                <?echo ucfirst($result[$i]->data->name); ?>
            </div>
            
            <div class="col-md-1">
                <? echo $result[$i]->data->class; ?>
            </div>
            
            <div class="col-md-4">
                <? echo $result[$i]->data->school; ?>
            </div>
            
          <div class="col-md-2">
                <a class="btn btn-danger" href="friends/unfriend.php?id=<? echo  $result[$i]->data->friend_id;?>">Unfriend</a>
            </div>
            
            <div class="col-md-1">
                <label>
                    
                    <? if($status==1){ ?>
                       <span class="dot online"></span> 
                    <? }
                    else{ ?>
                           <span class="dot offline"></span> 
                <? } ?>

                </label>
            </div>
            
            
                    
           
    
        </div>
    </div>
    <? } ?>
    </div>



<? } ?> 
</div>





<? } else{ ?>
    
    
     <div class="container">
       <h4 class="login_link">
           Please <span><a href="http://sarmicrosystems.in/quiztest/web/my-account/my-account.php/">Login</a></span> to continue
       </h4>
   </div> 
    
<? }?>













</div>





<style>
   .friends_row{
       margin:2% auto;
       border-bottom:1px solid #c5c2c2;
   }
.dot{
    height: 15px;
    width: 15px;
   
    border-radius: 50%;
    display: inline-block;
}
.online{
     background-color: green;
}
.offline{
     background-color: red;
}
</style>


<script>


function emailinvite(){
  
swal("Write something here:", {
  content: "input",
})
.then((value) => {
    
        var value=$('.swal-content__input').val();  
        var jsonString = JSON.stringify(value);
     
        jQuery.ajax({
                type: "POST",
                url: 'friends/email.php',
               data: {data : jsonString}, 
                    success:function(data) {
                         swal(data);  
                        //   alert(jsonString);
                        if(data==1 || data=='1' || data=="1"){
                             swal(`Email Sent successfully !`);                      
                        }
                        else{
                          swal(`Problem Occured ! !`); 
                        }
                    }
            });


});
     


}

	</script>
	


<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>