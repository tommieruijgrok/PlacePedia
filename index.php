<?php
session_start();

include "include/head.php";
?>
    <html>

    <head>
        <title>Zoeken | PlacePedia</title>
        <link rel="stylesheet" href="stylesheet/login.css">
    </head>

    <body>
    <div id="container">
        <div id="login">
            <h2>Zoeken op PlacePedia!</h2>
            <div id="searchBarParent">
                <input type="text" id="searchBar" placeholder="Zoek een plek op!">
                <div id="dropdown" style="max-height: 200px; overflow: scroll">

                </div>
            </div>
            <div style="display: block; margin: 0px auto; text-align: center; margin-top: 16px">
                <a style="font-size: 12px; font-weight: bold; color: unset; text-decoration: none" href="singup.php">Inloggen op PlacePedia!</a>
            </div>
        </div>
        <div id="map" class="mapFullScreen"></div>
    </div>

    </body>

    </html>

    <script src="script/searchBar.js"></script>
<?php
include "script/map.php";
