<?php
session_start();

include '../include/config.php';

if ($_SESSION['status'] == 'true'){

    $sql = "SELECT * FROM userReviews WHERE userId = " . $_SESSION['userId'] . " AND id = " . $_POST['reviewId'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sqlA = "UPDATE userReviews SET content = '" . $_POST['textarea'] . "' WHERE userId = " . $_SESSION['userId'] . " AND id = " . $_POST['reviewId'];
        if ($conn->query($sqlA) === TRUE) {
            header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewSuccess=Uw review is aangepast!");
        }
    } else {
        header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewError=Er ging iets mis met het aanpassen van uw review. Probeer het opnieuw!");
    }
    /*
    $sql = "DELETE FROM userReviews WHERE userId = " . $_SESSION['userId'] . " AND id = " . $_POST['reviewId'];
    if ($conn->query($sql) === TRUE) {
        header("location: ../place.php?id=" . $_POST['location'] . "&reviewDeleteSuccess=true");
    } else {
        header("location: ../place.php?id=" . $_POST['location'] . "&reviewError=Er ging iets mis met het verwijderen van uw review. Probeer het opnieuw!");
    }*/
}
