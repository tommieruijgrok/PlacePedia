<?php

include 'include/config.php';

$shipments = json_decode(file_get_contents('https://placepedia.tommieruijgrok.nl/json/townships.geojson'));

/*
for ($i=0; $i < 400; $i++){

    //var_dump(get_object_vars($shipments)["features"]);

    $name = get_object_vars(get_object_vars(get_object_vars($shipments)["features"][$i])["properties"])["name"];

    $z = get_object_vars(get_object_vars(get_object_vars($shipments)["features"][$i])["geometry"])["coordinates"];
    $geo = json_encode($z);

    echo
    $sql = "SELECT * FROM NederlandseGemeenten WHERE gemeenteNaam = '" . $name . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $code = $row['gemeenteCode'];
        }
    } else {
        $code = 0;
    }

    $sqlCity = "INSERT INTO NederlandseGemeentenGeo (gemeenteCode, gemeenteNaam, geoJson) VALUES (" . $code . ", '" . $name ."', '" . $geo ."')";

    if(mysqli_query($conn, $sqlCity)){
        echo "YEAH";
    } else{
        die("Connection failed: " . $conn->connect_error);
    }

}*/


/*
$json = json_decode(file_get_contents('https://placepedia.tommieruijgrok.nl/gemeenteInfo.json'));
echo count($json);
for ($i=0; $i < count($json); $i++){

    $y = '"' . get_object_vars($json[$i])["Gemeentenaam"] . '"';

    $sqlCity = "INSERT INTO NederlandseGemeenten (gemeenteCode, gemeenteNaam, provincieCode) VALUES (" . get_object_vars($json[$i])["Gemeentecode"] .", " . $y .", " . get_object_vars($json[$i])["Provinciecode"] .")";

    if(mysqli_query($conn, $sqlCity)){
        echo "YEAH";
    } else{
        die("Connection failed: " . $conn->connect_error);
    }
    //usleep(200000);

}*/

/*
$json = json_decode(file_get_contents('https://metatopos.dijkewijk.nl/metatopos-places.json'));
$z = count(get_object_vars($json)["places"]);
for ($i=0; $i < 5; $i++){

    $y = '"' . get_object_vars(get_object_vars($json)["places"][$i])["place"] . '"';

    $sql = "SELECT * FROM NederlandseGemeenten WHERE gemeenteNaam = " . $y;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $code = $row['gemeenteCode'];
            }
        } else {
            $code = 0;
        }

    if (count(get_object_vars(get_object_vars($json)["places"][$i])["placecode"]) > 0){
        $sqlCity = "INSERT INTO NederlandseWoonplaatsen (woonplaatsId, woonplaatsNaam, gemeenteId) VALUES (" . filter_var((get_object_vars(get_object_vars($json)["places"][$i])), FILTER_SANITIZE_SPECIAL_CHARS) . ", " . $y .", " . $code .")";
    } else {
        $sqlCity = "INSERT INTO NederlandseWoonplaatsen (woonplaatsNaam, gemeenteId) VALUES (" . $y .", " . $code .")";
    }

    if(mysqli_query($conn, $sqlCity)){
        echo "YEAH";
    } else{
        die("Connection failed: " . var_dump(get_object_vars(get_object_vars($json)["places"][$i])));
    }
    //usleep(200000);

}*/