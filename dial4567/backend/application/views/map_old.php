<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>MapmyIndia Maps API: Animated Markers on Polyline Example</title>
        <link rel="icon" href="http://mapmyindia.com/images/favicon.ico" type="image/x-icon" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            html { 
                height: 100%; 
            }
            body { 
                height: 100%;
                font-family:Verdana,sans-serif,Arial;
                color:#000;
                margin: 0; 
                font-size:14px;
                padding: 0; 
            }
            #map{
                position: absolute;
                left: 312px; top: 46px; 
                right: 2px; bottom: 2px; 
                border: 1px solid #cccccc; }
            #result {
                position: absolute;
                left: 2px; top: 46px;
                width: 306px;
                bottom: 2px; 
                border: 1px solid #cccccc;
                background-color: #FAFAFA;
                overflow: auto;
            }
            button{
                width: 220px;
                font-family:Verdana,sans-serif,Arial;
                font-size:12px;
                padding:2px 0;
                color:#333
            }
            .top-div{
                border-bottom: 1px solid #e9e9e9;
                padding:10px 12px;
                background:#fff;
            }
            .top-div-span1{
                font-size: 20px;
            }
            .top-div-span2{
                font-size:16px;color:#777
            }
            .btn-div{
                padding: 16px 12px 6px 38px;
            }
        </style>
        <!--put your map api javascript url with key here-->
        <script src="https://apis.mapmyindia.com/advancedmaps/v1/0ac6a71fbf6eaa03f0e65283367e555c/map_load?v=1.5&plugin=polylinedecorator,path.drag"></script>
        <!--<script src="js/leaflet.polylineDecorator.js"></script>--->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class= "top-div">
            <span class=top-div-span1">MapmyIndia Maps API:</span>
            <span class=top-div-span2">Marker Animation on Polyline</span>
        </div>
        <div id="result">            
            <div class="btn-div" ><button onclick="drawCarMarkerOnPolyline()" id="visible" >Redraw Polyline</button></div>
            <div class="btn-div" ><button onclick="drawArrowOnPolyline()" id="visible" >Draw Arrow on Polyline</button></div>
            <div class="btn-div" ><button onclick="drawRepeatedPatternOnPolyline()" id="visible" >Draw Repeated Pattern</button></div>

            <div class="btn-div" ><button onclick="removePolyline()" id="visible" >Remove Polyline</button></div>
        </div>
        <div id="map"></div>
        <input type="hidden" value="" id="input_hidden_field_arr" />
        <script>
            var map = null;
            var poly = [];
            var decorator;
            var line;
//            var center = new L.LatLng(19.1454695, 72.8553074); map_center_point_lat
            var center = new L.LatLng(<?php echo $map_center_point_lat; ?>, <?php echo $map_center_point_long; ?>);
            var interval = 0;
            // var pp =[[26.4699325,82.2500615],[26.4699325,82.2500615],[26.4699326,82.2500615],[26.4699313,82.2500612],[26.4699855,82.2500745],[26.4699858,82.2500746],[26.4700974,82.2498903],[26.4698755,82.2498024],[26.4699946,82.2498135],[26.4700704,82.2497134],[26.4700704,82.2497134],[26.4700799,82.2495876],[26.4700796,82.2495894],[26.4701733,82.2498827],[26.4702575,82.2494066],[26.4702575,82.2494066],[26.4702575,82.2494066],[26.4702575,82.2494066],[26.4702575,82.2494066],[26.4702577,82.2494066],[26.4701586,82.2493776],[26.4701587,82.2493772],[26.4702788,82.2496489],[26.4700319,82.2496813],[26.470027,82.2496842],[26.4701128,82.2496332],[26.4701115,82.2496335],[26.4698011,82.2625734],[26.4703096,82.2502048],[26.4703096,82.2502048],[26.4703096,82.2502048],[26.469922,82.2502069],[26.469936,82.2502313],[26.4699719,82.2503071],[26.4702897,82.2501457],[26.4702798,82.249763],[26.4700962,82.2499047],[26.4700962,82.2499047],[26.4700962,82.2499047],[26.4700965,82.2499048],[26.4700701,82.2498934],[26.4700701,82.2498934],[26.4700811,82.2498833],[26.4699831,82.2500151],[26.4699831,82.2500151],[26.4699831,82.2500151],[26.4699834,82.2500151],[26.4701841,82.2500555],[26.4699202,82.2499393],[26.4699202,82.2499393],[26.4699202,82.2499393],[26.4699202,82.2499393],[26.470149,82.2501975]];
            var pp = <?php echo $map_point; ?>;

            window.onload = function () {
                map = new MapmyIndia.Map('map', {
                    center: center,
                    editable: true,
                    zoomControl: true,
                    hybrid: true
                });
                //draw polyline
//                getLatLong();
                drawCarMarkerOnPolyline();

            }


            function getLatLong() {
                //alert("getLatLong");
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost/ziman-b2c/backend/index.php/user/getPreTriggerNotificationsByUser',
                    dataType: "json",
                    cache: false,
                    async: false,
                    success: function (data) {
                        alert(data);
//                        $('#input_hidden_field_arr').val(JSON.stringify(data)); //store array
                        $('#input_hidden_field_arr').val(data); //store array
                    }
                });
            }

            function drawCarMarkerOnPolyline() {
                removePolyline();
                var offset = 0; //intial offset value
                var w = 14, h = 33;
                //Polyline css
                var linecss = {
                    color: '#234FB6',
                    weight: 3,
                    opacity: 1
                };
                line = L.polyline(pp, linecss).addTo(map); //add polyline on map
                decorator = L.polylineDecorator(line).addTo(map); //create a polyline decorator instance.

                //offset and repeat can be each defined as a number,in pixels,or in percentage of the line's length,as a string 
                interval = window.setInterval(function () {
                    decorator.setPatterns([{
                            offset: offset + '%', //Offset value for first pattern symbol,from the start point of the line. Default is 0.
                            repeat: 0, //repeat pattern at every x offset. 0 means no repeat.
                            //Symbol type.
                            symbol: L.Symbol.marker({
                                rotate: true, //move marker along the line. false value may cause the custom marker to shift away from a curved polyline. Default is false. 
                                markerOptions: {
                                    icon: L.icon({
                                        iconUrl: "<?php echo base_url('images/car.png'); ?>",
                                        iconAnchor: [w / 2, h / 2], //Handles the marker anchor point. For a correct anchor point [ImageWidth/2,ImageHeight/2]
                                        iconSize: [14, 33]
                                    })
                                }
                            })
                        }
                    ]);
                    if ((offset += 0.03) > 100) //Sets offset. Smaller the value smoother the movement.
                        offset = 0;
                }, 10); //Time in ms. Increases/decreases the speed of the marker movement on decrement/increment of 1 respectively. values should not be less than 1.
                poly.push(line);
                poly.push(decorator);
                map.fitBounds(line.getBounds());
            }
            function drawArrowOnPolyline() {
                removePolyline();
                var offset = 0; //intial offset value

                //Polyline css
                var linecss = {
                    color: '#fd4000',
                    weight: 3,
                    opacity: 1
                };

                line = L.polyline(pp, linecss).addTo(map); //add polyline on map
                decorator = L.polylineDecorator(line).addTo(map); //create a polyline decorator instance.
                //offset and repeat can be each defined as a number,in pixels,or in percentage of the line's length,as a string 
                interval = window.setInterval(function () {
                    decorator.setPatterns([{
                            offset: offset + "%", //Start first marker from x offset.
                            repeat: 0, //repeat market at every x offset. 0 means no repeat.
                            symbol: L.Symbol.arrowHead({
                                pixelSize: 20, //Size of arrow image
                                headAngle: 60, //Increases/decreases arrow angel. Default is 60.
                                polygon: true, //if set to false an arrow is added else a triangle shape arrow is added. Default is true.
                                pathOptions: {
                                    color: '#303030', //arrow color
                                    fillOpacity: 0, //0 for no fill
                                    weight: 4 // arrow line width
                                }
                            })
                        }
                    ]);
                    if ((offset += 0.03) > 100) //Sets offset. Smaller the value smoother the movement.
                        offset = 0;
                }, 10); //Time in ms. Increases/decreases the speed of the marker movement on decrement/increment of 1 respectively. values should not be less than 1.
                poly.push(line);
                poly.push(decorator);
                map.fitBounds(line.getBounds());
            }
            function drawRepeatedPatternOnPolyline() {
                removePolyline();
                var offset = 0; //intial offset value

                //Polyline css
                var linecss = {
                    color: '#fd4000',
                    weight: 3,
                    opacity: 1
                };

                line = L.polyline(pp, linecss).addTo(map); //add polyline on map
                decorator = L.polylineDecorator(line).addTo(map); //create a polyline decorator instance.
                //offset and repeat can be each defined as a number,in pixels,or in percentage of the line's length,as a string 
                interval = window.setInterval(function () {
                    decorator.setPatterns([{
                            offset: offset + "%", //Start first marker from x offset.
                            repeat: 100, //repeat market at every 100 offset.
                            symbol: L.Symbol.arrowHead({
                                pixelSize: 20, //Size of arrow image
                                headAngle: 60, //Increases/decreases arrow angel. Default is 60.
                                polygon: true, //if set to false an arrow is added else a triangle shape arrow is added. Default is true.
                                pathOptions: {
                                    color: '#303030', //arrow color
                                    fillOpacity: 0, //0 for no fill
                                    weight: 4 // arrow line width
                                }
                            })
                        }
                    ]);
                    if ((offset += 0.03) > 100) //Sets offset. Smaller the value smoother the movement.
                        offset = 0;
                }, 10); //Time in ms. Increases/decreases the speed of the marker movement on decrement/increment of 1 respectively. values should not be less than 1.
                poly.push(line);
                poly.push(decorator);
                map.fitBounds(line.getBounds());
            }

            var removePolyline = function () {
                var polylength = poly.length;
                if (polylength > 0) {
                    for (var i = 0; i < polylength; i++) {
                        if (poly[i] !== undefined) {
                            map.removeLayer(poly[i]);
                        }
                    }
                    poly = new Array();
                    window.clearInterval(interval);
                }
            }
//            });
        </script>
    </body>
</html>