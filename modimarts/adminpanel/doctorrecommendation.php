<?php 
include 'head.php';
 ?>
 <nav aria-label="breadcrumbs" class="breadcrumb">
    <div class="container-bg">
        <h1>
           doctor recommendation
        </h1>
        <a href="index.php" title="Back to the frontpage">
            Home
        </a>
        <span aria-hidden="true" class="breadcrumb__sep">
            /
        </span>
        <span>
            doctor recommendation
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
            <div class="wide--one-quarter grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--grid__item" style="">
              <?=$rec['heading']?>
                
            </div>
        <?php } ?>
            
        </div>
    </div>
    <div class="dt-sc-hr-invisible-large">
    </div>
</main>

<?php
$youtubeID = getYouTubeVideoId('youtube video url');
$thumbURL = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
print_r($thumbURL);

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
 <?php 
 include 'footer.php'; ?>