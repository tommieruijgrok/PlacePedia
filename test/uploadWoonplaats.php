<?php
//echo "YEAH";
include "../include/config.php";

//$sql = "INSERT INTO NederlandseWoonplaatsen (woonplaatsId, woonplaatsNaam, gemeenteId) VALUES (" . $_GET['woonplaatsId'] . ", `" . $_GET['woonplaatsNaam'] ."`, `" . $_GET['gemeenteId'] ."`)";
$sql = 'INSERT INTO NederlandseWoonplaatsen (woonplaatsId, woonplaatsNaam, gemeenteId) VALUES (' . $_GET['woonplaatsId'] . ', "' . $_GET['woonplaatsNaam'] .'", "' . $_GET['gemeenteId'] .'")';

if ($conn->query($sql) === TRUE) {
    echo "Uploaded";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}