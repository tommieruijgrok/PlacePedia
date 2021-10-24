<?php
header('Access-Control-Allow-Origin: *');
include "../include/config.php";
include "../include/functions.php";




if (isset($_GET['key'])){

    $result = $conn->query("SELECT * FROM API_keys WHERE api_key = '" . $_GET['key'] ."'");
    if ($result->num_rows > 0) {
        
        $conn->query("INSERT INTO API_requests (api_key ) VALUES ('" . $_GET['key'] . "')");


        $metaClass = new stdClass();
        $metaClass->auteur = "Tommie Ruijgrok";
        $metaClass->wijziging = "Laatste wijziging op 9/10/2021 16:37";
        $metaClass->info = "https://github.com/tommieruijgrok/NederlandsePlaatsenAPI";
        $metaClass->contact = "hello@tommieruijgrok.nl";

        $result = $conn->query("SELECT COUNT(*) AS totaal FROM API_requests WHERE api_key = '" . $_GET['key'] . "'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $metaClass->API_KEY_requests =  $row['totaal'];
            }
        }

        array_push($metaArray, $metaClass);

        $contentArray = [];


            $resultA = $conn->query("SELECT * FROM `NederlandseWoonplaatsen` WHERE woonplaatsNaam LIKE '" . $_GET['query'] .  "%' LIMIT 5");
            if ($resultA->num_rows > 0) {
                // output data of each row
                while($rowA = $resultA->fetch_assoc()) {
                    //$contentArrayChild = [];

                    $provincieInfo = new stdClass;
                    //$provincieInfo->type = $rowA['type'];
                    $provincieInfo->code = $rowA['id'];
                    $provincieInfo->naam = utf8_encode($rowA['woonplaatsNaam']);
                    //$provincieInfo->id = $rowA['type'] . $rowA['id'];
                    //$provincieInfo->land = "NL";
                    //$provincieInfo->vlag = "https://tommieruijgrok.nl/NederlandsePlaatsenAPI/data/" . $rowA['type'] . $rowA['provincieCode'] . ".svg";

                    //echo json_encode($provincieInfo);
                    array_push($contentArray, $provincieInfo);

                }
            }
            $masterClass = new stdClass;
            $masterClass->meta = $metaClass;
            array_push($masterArray, $masterClass);
            if ($_GET['query'] == ''){
                //echo "YEAH";
                $masterClass->content = [];

            } else {
                $masterClass->content = $contentArray;
            }
            echo json_encode($masterClass);




    } else {
        $error = new stdClass();
        $error->error = "Geen geldige API-key";
        $error->info = "https://github.com/tommieruijgrok/NederlandsePlaatsenAPI";
        echo json_encode($error);
    }

} else {
    $error = new stdClass();
    $error->error = "Geen geldige API-key";
    $error->info = "https://github.com/tommieruijgrok/NederlandsePlaatsenAPI";
    echo json_encode($error);
}

