<?php

include 'include/config.php';

if(isset($_POST['input'])){
    $sqlCity = "INSERT INTO NederlandseGemeentenGeo (gemeenteCode, gemeenteNaam, geoJson) VALUES (" . $_POST['gemeenteCode'] . ", '" . $_POST['gemeenteNaam'] ."', '" . $_POST['input'] ."')";

    if(mysqli_query($conn, $sqlCity)){
       header('location: output.php');
    } else{
        die("Connection failed: " . $sqlCity);
    }
}
