<?php
session_start();
$id=$_SESSION['userid'];
//echo $id;
?>

<html>
<head>
  <title>Your Website Title</title>
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
  <meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Your Website Title" />
  <meta property="og:description"   content="Your description" />
   <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

 </head>
<body>

  <!-- Load Facebook SDK for JavaScript -->
 <div id="fb-root"></div>
 
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

 


<!--<div class="" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse&amp;rg=http://sarmicrosystems.in/quiztest/register.php" class="fb-xfbml-parse-ignore">Share</a></div>
http%3A%2F%2Fsarmicrosystems.in%2Fquiztest%2F
<div class="" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u="http%3A%2F%2Fsarmicrosystems.in%2Fquiztest%2Fregister.php"" class="fb-xfbml-parse-ignore">Share</a></div>


<div class="" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsarmicrosystems.in%2Fquiztest%2Fregister.php?rg=<?php echo $id;?>" class="fb-xfbml-parse-ignore">Share</a></div>
-->
<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsarmicrosystems.in%2Fquiztest%2Fregister.php?rg=<?php echo $id;?>">Share</a>

</body>
</html>