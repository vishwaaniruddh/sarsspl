<?php
            $allStories = scandir("./stories");
            foreach($allStories as $story){
                $dir = "'/stories/$story'";
                $element =  ("<span class='listElement' onclick='displayStory($dir)'>$story</span>");
                echo $element;
            }
      ?>