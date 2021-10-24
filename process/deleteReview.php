<?php
session_start();

include '../include/config.php';

if ($_SESSION['status'] == 'true'){

    $sql = "SELECT * FROM userReviews WHERE userId = " . $_SESSION['userId'] . " AND id = " . $_POST['reviewId'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sqlA = "DELETE FROM userReviews WHERE userId = " . $_SESSION['userId'] . " AND id = " . $_POST['reviewId'];
        if ($conn->query($sqlA) === TRUE) {
            header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewDeleteSuccess=Uw review is verwijderd!");
        }
    } else {
        header("location: ../place.php?code=" . $_POST['location'] . "&type=" . $_POST['locationType'] . "&reviewError=Er ging iets mis met het verwijderen van uw review. Probeer het opnieuw!");
    }
}
