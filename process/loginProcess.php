<?php
session_start();

include "../include/config.php";

if (isset($_POST['formEmail']) && isset($_POST['formPassword'])){


    $sql = "SELECT * FROM users WHERE email = '" . $_POST['formEmail'] . "' AND password = '" . sha1($_POST['formPassword']) . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $_SESSION['status'] = 'true';
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['name'];
            $_SESSION['userEmail'] = $row['email'];
            $_SESSION['userHometown'] = $row['hometown'];

            header('location: ../profile.php');
        }
    } else {
        header('location: ../login.php?error=De gevens waren onjuist!');
    }

} else {
    header('location: ../login.php');
}