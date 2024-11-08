<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        width: 600px;
       }
    </style>
  </head>
  <body>
    <!--The div elements for the map and message -->
    <div id="map"></div>
    <div id="msg"></div>
    <script>
// Initialize and add the map
var map;

function haversine_distance(mk1, mk2) {
      var R = 6371.0710; // Radius of the Earth in km
      var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
      var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
      var difflat = rlat2-rlat1; // Radian difference (latitudes)
      var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
      return d;
    }


function initMap() {
  // The map, centered on Central Park
  const center = {lat: 12.12164175237888, lng: 78.15442442736514};
  const options = {zoom: 15, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map'), options);
  // Locations of landmarks
  const dakota = {lat: 12.12164175237888, lng: 78.15442442736514};
  const frick = {lat: 12.528185602218134, lng: 78.21373599084527};
  // The markers for The Dakota and The Frick Collection
  var mk1 = new google.maps.Marker({position: dakota, map: map});
  var mk2 = new google.maps.Marker({position: frick, map: map});
  
  // Draw a line showing the straight distance between the markers
  var line = new google.maps.Polyline({path: [dakota, frick], map: map});
  
  // Calculate and display the distance between markers
  var distance = haversine_distance(mk1, mk2);
  document.getElementById('msg').innerHTML = "Distance between markers: " + distance.toFixed(2) + " km.";
  
  
  let directionsService = new google.maps.DirectionsService();
  let directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setMap(map); // Existing map object displays directions
  // Create route from existing points used for markers
  const route = {
      origin: dakota,
      destination: frick,
      travelMode: 'DRIVING'
  }

  directionsService.route(route,
    function(response, status) { // anonymous function to capture directions
      if (status !== 'OK') {
        window.alert('Directions request failed due to ' + status);
        return;
      } else {
        directionsRenderer.setDirections(response); // Add route to the map
        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
        alert(directionsData);
        if (!directionsData) {
          window.alert('Directions request failed');
          return;
        }
        else {
          document.getElementById('msg').innerHTML += " Driving distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ").";
        }
      }
    });
}

    </script>
    <!--Load the API from the specified URL -- remember to replace YOUR_API_KEY-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiPMuQuqUyoDb2r2aap8PcrZ6Ht3Dvhqk&callback=initMap">
    </script>
  </body>
</html>