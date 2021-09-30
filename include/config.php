<?php

$db_hostname = 'rdbms.strato.de';
$db_username = 'dbu1672129';
$db_password = 'X9bHxZMD4gzyyW2bBraCUxycnbNMvkhhXeyT6MMEYsDGTCU9rh7tFHXwgnm2LsKv2ReLk3';
$db_database = 'dbs4191664';

/*$db_hostname = 'localhost';
$db_username = 'Tommie';
$db_password = 'T1904RekGLR!';
$db_database = '85746_tommieruijgrok';*/

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected!";
}
