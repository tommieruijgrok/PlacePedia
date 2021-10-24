<?php

include 'include/config.php';

if(isset($_POST['input'])){
    $sqlCity = "INSERT INTO GeoInfo (type, code, naam, geoJson) VALUES ('GM', " . $_POST['gemeenteCode'] . ", '" . $_POST['gemeenteNaam'] ."', '" . $_POST['input'] ."')";

    if(mysqli_query($conn, $sqlCity)){
       header('location: output.php');
    } else{
        die("Connection failed: " . $sqlCity);
    }
}
