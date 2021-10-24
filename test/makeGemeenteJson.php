<?php
include '../include/config.php';


$sql = "SELECT * FROM NederlandseGemeenten WHERE gemeenteNaam = '" . $_GET['name'] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row['gemeenteCode'];
    }
}