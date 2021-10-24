<?php
include "../include/config.php";

$x = [];

$result = $conn->query("SELECT * FROM NederlandseWoonplaatsen");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $z = new stdClass;
        $z->id = $row['id'];
        $z->name = $row['type'];

        array_push($x, $z);

    }
}

echo json_encode($x);
