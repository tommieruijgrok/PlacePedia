<?php
session_start();
if ($_SESSION['status'] == true){
    session_destroy();

}
header('location: ../login.php');