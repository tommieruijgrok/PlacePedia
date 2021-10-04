<?php

include "../include/config.php";


$sql = "SELECT gemeenteNaam FROM NederlandseGemeenten WHERE gemeenteNaam LIKE '" . $_GET['query'] . "%' LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $x = [];
    while ($row = $result->fetch_assoc()) {
        array_push($x, $row['gemeenteNaam']);
    }
    echo json_encode($x);
}
























