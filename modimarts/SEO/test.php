<?php
session_start();
// include('config.php');
include 'head.php';
?>
<div id="img-container" style="width: 500px; height:300px; border: 5px solid red;">
        <img src="https://unsplash.it/300/300?image=659" />
    <div>
<script>
var options1 = {
    width: 400,
    zoomWidth: 500,
    offset: {vertical: 0, horizontal: 10}
};

// If the width and height of the image are not known or to adjust the image to the container of it
var options2 = {
    fillContainer: true,
    offset: {vertical: 0, horizontal: 10}
};
new ImageZoom(document.getElementById("img-container"), options2);

</script>
     
      <?php include 'footer.php';?>