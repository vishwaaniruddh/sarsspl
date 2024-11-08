<html>
    <head>
        <title>My Title</title>
        <!--<meta property="og:url"         content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
        <meta property="og:type"        content="article" />
        <meta property="og:description"       content="When Great Minds Don’t Think Alike" /> -->
        <meta property="og:title" content="Hey,

I found this really cool app to check my learning in Math and Science in a fun way. 

Quiz2shine app Logo 

1) Play topic level quizzes mapped to school syllabus %0A
2) For classes 6 to 10th <br>
3) Play with friends, unknown players and 4 levels of VP (i.e. Virtual Player) <br>

I am registered as a player in class yyth with quiz2shine app and really love it. <br>

Download Quiz2shine app from this link: xxxyyyy or from playstore (for android) and register. Let the Fun begin! <br>" />
        <meta property="og:image"       content="http://sarmicrosystems.in/quiztest/img/Quiz2shine.png" />
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <script>
            $(document).ready(function() {
                var myId = <?php echo $_GET["rg"]; ?>;
                window.location.href = "my-account/my-account.php?rg="+myId;
            });
        </script>
    </body>
</html>