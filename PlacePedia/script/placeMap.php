<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoidG9tbWllcnVpamdyb2siLCJhIjoiY2tlbHRieThtMGRoYTJ3bzhuZWpxaGhkaCJ9.qO-h706kQ-RHeEe6REe2eg';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/light-v10', // style URL
        center:  <?php
        $sql = "SELECT * FROM NederlandseGemeentenGeo WHERE gemeenteCode = " . $gemeenteCode;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $x = json_decode($row['geoJson']);
                $x = json_encode($x[0][0][0]);
                echo $x;
                //echo json_encode($row['geoJson'], JSON_PRETTY_PRINT);

            }
        }
        ?>, // starting position
        zoom: 8 // starting zoom
    });

    map.on('load', () => {
// Add a data source containing GeoJSON data.
        map.addSource('maine', {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'geometry': {
                    'type': 'MultiPolygon',
// These coordinates outline Maine.
                    'coordinates': <?php
                    $sql = "SELECT * FROM NederlandseGemeentenGeo WHERE gemeenteCode = " . $gemeenteCode;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo trim($row['geoJson']);
                            //echo json_encode($row['geoJson'], JSON_PRETTY_PRINT);

                        }
                    }
                    ?>
                }
            }
        });

// Add a new layer to visualize the polygon.
        map.addLayer({
            'id': 'maine',
            'type': 'fill',
            'source': 'maine', // reference the data source
            'layout': {},
            'paint': {
                'fill-color': '#0080ff', // blue color fill
                'fill-opacity': 0.5
            }
        });
// Add a black outline around the polygon.
        map.addLayer({
            'id': 'outline',
            'type': 'line',
            'source': 'maine',
            'layout': {},
            'paint': {
                'line-color': '#000',
                'line-width': 3
            }
        });
    });
</script>