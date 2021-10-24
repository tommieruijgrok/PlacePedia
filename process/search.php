<?php

include "../include/config.php";

if ($_GET['query'] != ''){

    $x = [];

    /*$sql = "SELECT * FROM NederlandseGemeenten WHERE gemeenteNaam LIKE '" . $_GET['query'] . "%' LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $z = new stdClass();
            $z->type = $row['type'];
            $z->code = str_pad($row['gemeenteCode'], 4, '0', STR_PAD_LEFT);
            $z->gemeenteNaam = "Gemeente " . $row['gemeenteNaam'];

            $sqlA = "SELECT * FROM NederlandseProvincies WHERE provincieCode = " . $row['provincieCode'];
            $resultA = $conn->query($sqlA);

            if ($resultA->num_rows > 0) {
                while ($rowA = $resultA->fetch_assoc()) {
                    $z->provincie = "Provincie " . $rowA['provincieNaam'];
                }
            }


            array_push($x, $z);
        }
    }*/

    $sql = "SELECT * FROM NederlandseProvincies WHERE provincieNaam LIKE '" . $_GET['query'] . "%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $z = new stdClass();
            $z->type = $row['type'];
            $z->code = str_pad($row['provincieCode'], 4, '0', STR_PAD_LEFT);
            $z->provincieNaam = "Provincie " . $row['provincieNaam'];
            array_push($x, $z);
        }
    }

    $sql = "SELECT * FROM NederlandseWoonplaatsen WHERE woonplaatsNaam LIKE '" . $_GET['query'] . "%' LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $z = new stdClass();
            $z->type = $row['type'];
            $z->code = str_pad($row['id'], 4, '0', STR_PAD_LEFT);
            $z->woonplaatsNaam = $row['woonplaatsNaam'];

            $sqlA = "SELECT * FROM NederlandseGemeenten WHERE gemeenteCode = " . $row['gemeenteId'];
            $resultA = $conn->query($sqlA);

            if ($resultA->num_rows > 0) {
                while ($rowA = $resultA->fetch_assoc()) {
                    $z->gemeente = "Gemeente " . $rowA['gemeenteNaam'];
                }
            }


            array_push($x, $z);
        }
    }

    $sql = "SELECT * FROM users WHERE name LIKE '" . $_GET['query'] . "%' LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $z = new stdClass();
            $z->type = "PF";
            $z->id = $row['id'];
            $z->name = $row['name'];


            array_push($x, $z);
        }
    }



    echo json_encode($x);

} else {
   echo json_encode([]);
}