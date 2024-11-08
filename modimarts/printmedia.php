<?php
include 'head.php';
?>

<style>


.center-screen {
  /*position: absolute;*/
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 100%;
  min-width: 95%;
}

#youtubelink
    {
        height:72vh;
        width:29vw;
        display:none;
        margin-right:auto;
        margin-left: auto;
    }

    #showimg
    {
        height:inherit;
        width: 60%; 
        display:none;
        margin-right: auto;
        margin-left: auto;
    }

@media screen and (max-width: 480px) {
  .center-screen {
    width: 100%;
  }

  #youtubelink
    {
        height:72vh;
        width:80vw;
        display:none;
        margin-right:auto;
        margin-left: auto;
    }

    #showimg
    {
        height:inherit;
        width: 100%; 
        display:none;
        margin-right: auto;
        margin-left: auto;
    }
  }
</style>
 <nav aria-label="breadcrumbs" class="breadcrumb">
    <div class="container-bg">
        <h1>
           Print Media
        </h1>
        <a href="index.php" title="Back to the frontpage">
            Home
        </a>
        <span aria-hidden="true" class="breadcrumb__sep">
            /
        </span>
        <span>
               Print Media
        </span>
    </div>
</nav>
<main class="main-content">
    <div class="dt-sc-hr-invisible-small">
    </div>
    <div class="wrapper">
        <div class="grid-uniform">
            <?php
$getdoctorrec = mysqli_query($con1, "SELECT * FROM `PressReleases` WHERE press_type='3'");
while ($rec = mysqli_fetch_assoc($getdoctorrec)) {

    ?>
            <div class="wide--one-quarter grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--grid__item" style="padding: 10px;cursor: pointer;">
              <?php 
              if($rec['document']!='')
                {
                $url=$rec['document'];
                $type="PDF";
              }else
              {
                 $url=$rec['image'];
                 $type="Image";
              }
             
              
               ?>

                <div class="span4 proj-div" onclick="seturl('<?=$url?>','<?=$type?>')" data-toggle="modal" data-target="#GSCCModal">

                <img src="/<?=$rec['image']?>" alt="" style="width: 100%;height: 225px;">(<?=$type?>)
              <?=$rec['heading']?>

            </div>
            </div>
        <?php }?>

        </div>
    </div>

    <div id="GSCCModal" class="modal fade center-screen" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
 <div class="modal-dialog" >
    <div class="modal-content "  >
      <div class="modal-header" style="padding:20px;">
        <a class="close" style="float:right;color: red;" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle fa-2x"></i></a>
        <h4>Print Media</h4>
      </div>
      <div class="modal-body" >
        <div class="container"> 
        <iframe  id="youtubelink" src="" class="responsive-iframe"     title="Pdf Viewar"  ></iframe>
        <img id="showimg" src="" scrolling="auto" alt="">
      </div>
      </div>
      <div class="modal-footer" style="padding: 20px;">
        <button type="button" style="float:right;margin: 5px;" class="btn btn-default close" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="dt-sc-hr-invisible-large">
    </div>
</main>

<script>
    function seturl(val,type)
    {
      if(type=='PDF'){
         $("#showimg").hide();
        var url = '/'+val+'#toolbar=0&navpanes=0&scrollbar=0';
        $("#youtubelink").attr("src", url);
         $("#youtubelink").show();
         $("#youtubelink").css("display", "block");
      }
      else
      {
        $("#youtubelink").hide();
            var url = '/'+val;
        $("#showimg").attr("src", url);
        $("#showimg").show();
        $("#showimg").css("display", "block");

      }

    }
</script>

<script>
   $("body").click(function() {
   // if ($("#GSCCModal").is(":visible")) {

   // }

   if($('#GSCCModal').css('display') == 'block')
{
         $("#GSCCModal").modal('hide');
        $("#youtubelink").attr("src", '');
}

});
</script>

 <?php
include 'footer.php';?>