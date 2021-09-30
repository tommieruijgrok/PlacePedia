<?php
    session_start();

    if (isset($_SESSION['status']) && $_SESSION['status'] == 'true'){
        header('location: profile.php');
    } else {
        //header("location: profile.php");
    }
    include "include/head.php";
?>
<html>

    <head>
        <title>Inloggen | PlacePedia</title>
        <link rel="stylesheet" href="stylesheet/login.css">
    </head>

    <body>
        <div id="container">
            <div id="login">
                <h2>Inloggen op PlacePedia</h2>
                <form action="process/loginProcess.php" method="POST">
                    <input type="email" name="formEmail">
                    <input type="password" name="formPassword">
                    <input type="submit">
                </form>
            </div>
            <div id="map" class="mapFullScreen"></div>
        </div>

    </body>

</html>


<?php
include "script/loginMap.php";
