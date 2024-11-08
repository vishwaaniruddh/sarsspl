<?php
include('../header2.php');
?>


    <div class="container mainbody">
      <div class="page-header">
        <h1>Ajax infinite scroll down pagination with php and mysql</h1>
      </div>
      <div class="clearfix"></div>
      
      <div class="margin10"></div>
      <div class="col-lg-9 col-lg-offset-3">
        <div class="row">
          <div class="col-lg-9">
            <h3>Just scroll and it will load data.</h3>
          </div>
        </div>

        <div class="col-lg-12" id="results"></div>
        <div id="loader_image"><img src="loader.gif" alt="" width="24" height="24"> Loading...please wait</div>
        <div class="margin10"></div>
        <div id="loader_message"></div>

      </div>



      <!-- blog promotion starts -->
      <!--<div class="clearfix padding20"></div>
      <div class="clearfix padding20"></div>  
-->
      <!--<div class="row">
            <div class="col-lg-4">
              <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FThesoftwareguy7&amp;width&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=198210627014732" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:290px;" allowTransparency="true"></iframe>
              <div class="padding10 clearfix"></div>
            </div>
            <div class="col-lg-4">
              <div class="g-page" data-width="299" data-href="//plus.google.com/115374397759986535215" data-layout="landscape" data-rel="publisher"></div>
              <script type="text/javascript">
                (function() {
                  var po = document.createElement('script');
                  po.type = 'text/javascript';
                  po.async = true;
                  po.src = 'https://apis.google.com/js/platform.js';
                  var s = document.getElementsByTagName('script')[0];
                  s.parentNode.insertBefore(po, s);
                })();
              </script>
            </div>
            <div class="col-lg-4">
                <a href="https://twitter.com/thesoftwareguy7" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @thesoftwareguy7</a>
                <script>!function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                      js = d.createElement(s);
                      js.id = id;
                      js.src = "//platform.twitter.com/widgets.js";
                      fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>
            </div>
        </div>-->
      <!-- blog promotion ends -->
    </div>
    <script type="text/javascript">
      var busy = false;
      var limit = 15
      var offset = 0;

      function displayRecords(lim, off) {
        $.ajax({
          type: "GET",
          async: false,
          url: "getrecords.php",
          data: "limit=" + lim + "&offset=" + off,
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(html){
            $("#results").append(html);
            $('#loader_image').hide();
            if (html == "") {
              $("#loader_message").html('<button class="btn btn-default" type="button">No more records.</button>').show()
            } else {
              $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
            }
            window.busy = false;
          }
        });
      }

        $(document).ready(function() {
            // start to load the first set of data
            if (busy == false) {
              busy = true;
              // start to load the first set of data
              displayRecords(limit, offset);
            }


            $(window).scroll(function() {
                // make sure u give the container id of the data to be loaded in.
              if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
                busy = true;
                offset = limit + offset;
    
                // this is optional just to delay the loading of data
                setTimeout(function() { displayRecords(limit, offset); }, 500);
    
                // you can remove the above code and can use directly this function
                // displayRecords(limit, offset);
                
              }
            });

      });

    </script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

  </body>
</html>
