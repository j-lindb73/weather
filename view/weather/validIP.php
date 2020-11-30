<?php

/**
 * Render content within an article.
 */

namespace Anax\View;

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


// var_dump($geoLocation);
// echo $geoLocation;

// if (!$resultset) {
//     return;
// }
// ?>
<h2>Plats</h2>
<div class="flex-container">
    <div>
        <h3><?= $ip . $isValidMessage; ?>
<?php
if ($isValidIPv4) {
      echo " (IPv4)";
} elseif ($isValidIPv6) {
    echo " (IPv6)";
}
?>
        </h3>
        <p>
        Hostname: <?= $hostname ?>
        <p>
        <p>
        City: <?= $city ?>
        <p>
    </div>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<!-- <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet"/> -->

    <div id="map">
        
    <script>
        // Where you want to render the map.
        // var element = document.getElementById('osm-map');
        var element = document.getElementById('map');
        
        // Height has to be set. You can do this in CSS too.
        // element.style = 'height:300px;';
        
        // Transfer geoLocation from php to js

        var lat = <?php echo $latitude ?>;
        var lon = <?php echo $longitude ?>;
        // alert(JSON.parse(geoLoc));
        // alert(geoLoc['city']);
        
    // Create Leaflet map on map element.
    var map = L.map(element);

    // Add OSM tile leayer to the Leaflet map.
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Target's GPS coordinates.
    var target = L.latLng('47.50737', '19.04611');
    // var target = L.latLng("'" + geoLoc.latitude + "'","'" + geoLoc.longitude + "'");
    // var target = L.latLng(geoLoc.latitude, geoLoc.longitude);
    var target = L.latLng(lat, lon);


    // Set map's center to target with zoom 14.
    map.setView(target, 12);

    // Place a marker on the same location.
    L.marker(target).addTo(map);


    </script>
        <noscript>
                <h2>Javascript not found</h2>
                <p>This application requires Javascript. Please enable it to view the map.</p>
        </noscript>
    </div>
</div>


