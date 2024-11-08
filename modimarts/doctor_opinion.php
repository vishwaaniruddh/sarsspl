<?php 
include 'head.php';
 ?>

 <style>
 	.modal-body {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
}

.modal-body iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
 </style>
 <nav aria-label="breadcrumbs" class="breadcrumb">
    <div class="container-bg">
        <h1>
           doctor opinion
        </h1>
        <a href="index.php" title="Back to the frontpage">
            Home
        </a>
        <span aria-hidden="true" class="breadcrumb__sep">
            /
        </span>
        <span>
             doctor opinion
        </span>
    </div>
</nav>
<main class="main-content">
    <div class="dt-sc-hr-invisible-small">
    </div>
    <div class="wrapper">
        <div class="grid-uniform">
            <?php 
            $getdoctorrec=mysqli_query($con1,"SELECT * FROM `PressReleases` WHERE press_type='4'");
            while ($rec=mysqli_fetch_assoc($getdoctorrec)) {
               
             ?>
            <div class="wide--one-quarter grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--grid__item" style="padding: 10px;cursor: pointer;">
            	<?php 
            		$youtubeID = getYouTubeVideoId($rec['url']);
                    $thumbURL = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
            		 ?>
            	<div class="span4 proj-div" onclick="seturl('<?=$youtubeID?>')" data-toggle="modal" data-target="#GSCCModal">
            		
            	<img src="<?=$thumbURL?>" alt="" style="width: 100%;">
              <?=$rec['heading']?>
                
            </div>
            </div>
        <?php } ?>
            
        </div>
    </div>

    <div id="GSCCModal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 10px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 100%;
    min-width: 400px">
 <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" style="padding:20px;">
        <a class="close" style="float:right;color: red;" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle fa-2x"></i></a>
        <h4>Doctor Opinion</h4>
      </div>
      <div class="modal-body" >
        <iframe  id="youtubelink" src="" width="560" height="349" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="modal-footer" style="padding: 20px;">
        <button type="button" style="float:right;" class="btn btn-default close" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="dt-sc-hr-invisible-large">
    </div>
</main>

<script language="javascript" type="text/javascript">
$(function(){
    $(".close").click(function(){      
        $("#youtubelink").attr("src", '');
    });
});
</script>

<?php

function getYouTubeVideoId($pageVideUrl) {
    $link = $pageVideUrl;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}
?>
<script>
	function seturl(val)
	{
		var url = 'https://www.youtube.com/embed/'+val+'?autoplay=1';
		$("#youtubelink").attr("src", url);

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
 include 'footer.php'; ?>