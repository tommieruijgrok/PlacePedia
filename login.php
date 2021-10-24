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
                <?php
                    if (isset($_GET['error'])){
                        ?>
                            <div id="reviewSuccess" class="reviewResponse" style="background-color: #db4f43"><p><span style="margin-right: 5px"><i class="fas fa-exclamation-triangle"></i></span><?php echo $_GET['error'] ?></p></div>
                        <?php
                    }
                ?>
                <form action="process/loginProcess.php" method="POST" style="margin-top: 10px">
                    <input type="email" name="formEmail">
                    <input type="password" name="formPassword">
                    <input type="submit" value="Inloggen">
                </form>
                <div style="display: block; margin: 0px auto; text-align: center">
                    <a style="font-size: 12px; font-weight: bold; color: unset; text-decoration: none" href="singup.php">Account aanmaken op PlacePedia!</a>
                </div>
            </div>
            <div id="map" class="mapFullScreen"></div>
        </div>

    </body>

</html>


<?php
include "script/map.php";
