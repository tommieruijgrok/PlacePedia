<h1 style="font-size: 80px">Pijnacker</h1>
<?php

include 'include/config.php';
include 'include/head.php';

$sql = "SELECT name FROM PlacesPedia_Cities WHERE countryCode = 'ZW'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "name: " . $row['name']. "<br>";
    }
} else {
    echo "0 results";
}