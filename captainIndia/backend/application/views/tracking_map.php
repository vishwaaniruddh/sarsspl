<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MapmyIndia Maps API: Animated Markers on Polyline Example</title>
        <link rel="icon" href="https://www.mapmyindia.com/images/favicon.ico" type="image/x-icon" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
        html,
        body,
        #map {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
        }
    </style>
         <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <!--<script src="https://apis.mapmyindia.com/advancedmaps/api/0ac6a71fbf6eaa03f0e65283367e555c/map_sdk?layer=vector&v=2.0&callback=loadMap" defer async></script>-->
        <script src="https://apis.mapmyindia.com/advancedmaps/api/7bda66f1f343f0d30ebccf4ed95dc2d3/map_sdk?layer=vector&v=2.0&callback=loadMap" defer async></script>
    </head>
    <body>
        <div id="map"></div>
        <script>
            var map;
            function loadMap() {
                //map = new MapmyIndia.Map('map', { center: [28.544, 77.5454] });
                map = new MapmyIndia.Map('map', { center: [ <?php echo $map_center_point_lat; ?>, <?php echo $map_center_point_long; ?>] });
                map.addListener('load', function () {
                    //var pts = [{ lat: 28.55108, lng: 77.26913 }, { lat: 28.55106, lng: 77.26906 }, { lat: 28.55105, lng: 77.26897 }, { lat: 28.55101, lng: 77.26872 }, { lat: 28.55099, lng: 77.26849 }, { lat: 28.55097, lng: 77.26831 }, { lat: 28.55093, lng: 77.26794 }, { lat: 28.55089, lng: 77.2676 }, { lat: 28.55123, lng: 77.26756 }, { lat: 28.55145, lng: 77.26758 }, { lat: 28.55168, lng: 77.26758 }, { lat: 28.55175, lng: 77.26759 }, { lat: 28.55177, lng: 77.26755 }, { lat: 28.55179, lng: 77.26753 }];
                    var pts = <?php echo $map_point1; ?>;
                    var geoData = <?php echo $geo_point; ?>;
                    var polyline = new MapmyIndia.Polyline({
                        map: map,
                        paths: pts,
                        strokeColor: '#333',
                        strokeOpacity: 1.0,
                        strokeWeight: 5,
                        fitbounds: true
                    });
                    var marker = new MapmyIndia.Marker({
                        map: map,
                        position:geoData,
                        icon_url:'https://apis.mapmyindia.com/map_v3/1.png',
                    });
                });
            }
        </script>
    </body>
</html>