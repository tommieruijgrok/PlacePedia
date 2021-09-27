<?php
require_once 'inlog.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (strlen($username)> 0 && strlen($password) > 0){
    $password = md5($password);

    $query = "SELECT * FROM inlogleden
                WHERE  username = '$username'"
}