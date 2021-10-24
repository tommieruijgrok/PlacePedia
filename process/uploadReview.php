<?php
session_start();
include '../include/config.php';


if ($_SESSION['status'] == 'true' && count($_POST['content']) > 0){

    $sql = "INSERT INTO userReviews (userId, locationType, location, content) VALUES (" . $_SESSION['userId'] . ", '" . $_POST['locationType'] . "', " . $_POST['location'] . ", '" . $_POST['content'] . "')";

    if ($conn->query($sql) === TRUE) {
        header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewDeleteSuccess=Uw review is geplaatst!");
    } else {
        header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewError=Er ging iets mis met het plaatsen van uw review. Probeer het opnieuw!");
    }

} else {
    header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewError=Er ging iets mis met het plaatsen van uw review. Probeer het opnieuw!");
}
