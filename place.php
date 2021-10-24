<?php
session_start();

include 'include/config.php';

if (isset($_GET['code']) && isset($_GET['type'])){
    if ($_GET['type'] == "PV"){
        $sql = "SELECT * FROM NederlandseProvincies WHERE provincieCode = " . $_GET['code'];
    } else if ($_GET['type'] == "GM"){
        $sql = "SELECT * FROM NederlandseGemeenten WHERE gemeenteCode = " . $_GET['code'];
    } else if ($_GET['type'] == "WP"){
        $sql = "SELECT * FROM NederlandseWoonplaatsen WHERE id = " . $_GET['code'];
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $placeType = $row['type'];

            if ($_GET['type'] == "PV"){
                $placeName = $row['provincieNaam'];
                $placeNameType = "Provincie " . $row['provincieNaam'];
                $placeCode = $row['provincieCode'];
            }else if ($_GET['type'] == "GM"){
                $placeName = utf8_encode($row['gemeenteNaam']);
                $placeNameType = "Gemeente " . utf8_encode($row['gemeenteNaam']);
                $placeCode = $row['gemeenteCode'];

                $sqlA = "SELECT * FROM NederlandseProvincies WHERE provincieCode = '" . $row['provincieCode'] . "'";
                $resultA = $conn->query($sqlA);

                if ($resultA->num_rows > 0) {
                    while ($rowA = $resultA->fetch_assoc()) {
                        $placeProvincieNaam = $rowA['provincieNaam'];
                        $placeProvincieCode = $row['provincieCode'];
                    }
                }
            } else if ($_GET['type'] == "WP"){
                $placeName = $row['woonplaatsNaam'];
                $placeNameType = $row['woonplaatsNaam'];
                $placeCode = $row['id'];

                $sqlA = "SELECT * FROM NederlandseGemeenten WHERE gemeenteCode = '" . $row['gemeenteId'] . "'";
                $resultA = $conn->query($sqlA);

                if ($resultA->num_rows > 0) {
                    while ($rowA = $resultA->fetch_assoc()) {
                        $placeGemeenteNaam = $rowA['gemeenteNaam'];
                        $placeGemeenteCode = $rowA['gemeenteCode'];

                        $sqlB = "SELECT * FROM NederlandseProvincies WHERE provincieCode = '" . $rowA['provincieCode'] . "'";
                        $resultB = $conn->query($sqlB);

                        if ($resultB->num_rows > 0) {
                            while ($rowB = $resultB->fetch_assoc()) {
                                $placeProvincieNaam = $rowB['provincieNaam'];
                                $placeProvincieCode = $rowB['provincieCode'];
                            }
                        }



                    }
                }
            }
        }
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}

include 'include/head.php';
include 'include/header.php';
?>

<html>
    <head>
        <title><?php echo $placeNameType ?> | PlacePedia</title>
        <link rel="stylesheet" href="stylesheet/place.css">
    </head>
    <body>
        <div id="map"></div>
        <div id="container">

                <div>
                    <div id="headerParent">
                        <div style="margin-bottom: 10px">
                            <h1 style="margin-bottom: 0px">
                                <?php echo $placeNameType ?>
                            </h1>
                            <?php
                            if ($placeType == "WP"){
                                ?>
                                <p><a href="?type=GM&code=<?php echo $placeGemeenteCode ?>" style="font-weight: bold; color: #707070; text-decoration: none">Gemeente <?php echo $placeGemeenteNaam ?></a></p>
                                <?php
                            }
                            if ($placeType == 'GM' || $placeType == "WP"){
                                ?>
                                <p><a href="?type=PV&code=<?php echo $placeProvincieCode ?>" style="font-weight: bold; color: #707070; text-decoration: none">Provincie <?php echo $placeProvincieNaam ?></a></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="starRating">
                            <?php
                            $sql = "SELECT AVG(rating) 'gemiddelde' FROM userRatings WHERE location = " . $placeCode . " AND locationType = " . $placeType;
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $rating = round($row['gemiddelde']);
                                    for ($i = 0; $i < $rating; $i++) {
                                        ?>
                                        <i class="fas fa-star"></i>
                                        <?php
                                    }
                                    for ($i = 0; $i < (5 - $rating); $i++) {
                                        ?>
                                        <i class="far fa-star"></i>
                                        <?php
                                    }

                                }
                            } else {
                                for ($i = 0; $i < (0); $i++) {
                                    ?>
                                    <i class="far fa-star"></i>
                                    <?php
                                }
                            }

                            ?>
                        </div>
                    </div>
                    <div id="reviews">
                        <h2>Reviews</h2>

                        <?php
                        if (isset($_GET['reviewError'])){
                            ?>
                            <div id="reviewError" class="reviewResponse"><p><span style="margin-right: 5px"><i class="fas fa-exclamation-triangle"></i></span><?php echo $_GET['reviewError']; ?></p></div>
                            <?php
                        }
                        if (isset($_GET['reviewSuccess'])){
                            ?>
                            <div id="reviewSuccess" class="reviewResponse"><p><span style="margin-right: 5px"><i class="far fa-thumbs-up"></i></span><?php echo $_GET['reviewSuccess'] ?></p></div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['status'] == 'true'){
                            ?>
                            <div id="uploadReview">
                                <form action="process/uploadReview.php" method="POST">
                                    <textarea placeholder="Schrijf een review over <?php echo $placeName ?>!" name="content"></textarea>
                                    <input type="hidden" value="<?php echo $placeType  ?>" name="locationType">
                                    <input type="hidden" value="<?php echo $placeCode  ?>" name="location">
                                    <input type="submit" value="Review plaatsen onder de naam <?php echo $_SESSION['userName'] ?>">
                                </form>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div id="reviewNotLoggedIn" class="reviewResponse">

                                <p><span style="margin-right: 5px"><i class="fas fa-lightbulb"></i></span>Om een review te schijven moet je eerst <span><a href="login.php" style="text-decoration: underline; color: unset">Inloggen!</a></span></p>
                            </div>
                            <?php
                        }
                        ?>


                        <div id="reviewsGrid">
                            <?php

                            $sql = "SELECT * FROM userReviews WHERE locationType = '" . $placeType . "' AND location = " . $placeCode;
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="review">
                                        <div class="flex flexAlign flexSpaceBetween">
                                            <div style="width: 100%">
                                                <div class="flex flexAlign flexSpaceBetween" style="width: 100%">
                                                    <?php

                                                    $sqlA = "SELECT * FROM users WHERE id = " . $row['userId'];
                                                    $resultA = $conn->query($sqlA);

                                                    if ($resultA->num_rows > 0) {
                                                        // output data of each row
                                                        while ($rowA = $resultA->fetch_assoc()) {
                                                            ?>
                                                            <a href="profile.php?u=<?php echo $rowA['id'] ?>" style="color: unset; text-decoration: none">
                                                                <b>
                                                                    <?php
                                                                    echo $rowA['name'];
                                                                    ?>
                                                                </b>
                                                            </a>
                                                            <?php

                                                        }
                                                    }

                                                    ?>
                                                    <?php

                                                    if ($row['userId'] == $_SESSION['userId']){
                                                        ?>

                                                        <div class="flex flexSpaceBetween flexAlign" style="gap: 7px">
                                                            <form method="POST" action="process/deleteReview.php" style="margin: 0px">
                                                                <input type="hidden" value="<?php echo $row['id']  ?>" name="reviewId">
                                                                <input type="hidden" value="<?php echo $placeType  ?>" name="locationType">
                                                                <input type="hidden" value="<?php echo $placeCode  ?>" name="location">
                                                                <i class="far fa-trash-alt" onclick="this.parentElement.submit()"></i>
                                                            </form>
                                                            <div onclick="edit(this)">
                                                                <i class="far fa-edit"></i>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <p class="reviewContent"><?php echo $row['content'] ?></p>
                                                <?php

                                                if ($row['userId'] == $_SESSION['userId']){
                                                    ?>
                                                    <div class="reviewEditor hidden">
                                                        <form action="process/editReview.php" method="POST">
                                                            <input type="hidden" value="<?php echo $placeCode  ?>" name="location">
                                                            <input type="hidden" value="<?php echo $placeType  ?>" name="locationType">
                                                            <input type="hidden" value="<?php echo $row['id'] ?>" name="reviewId">
                                                            <textarea name="textarea"><?php echo $row['content'] ?></textarea>
                                                            <div class="saveButtonEditReview" onclick="this.parentElement.submit()">
                                                                <p>Wijziging opslaann</p>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if ($row['userId'] == $_SESSION['userId']) {
                                                ?>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <?php
                                }
                            } else {
                                ?>
                                <p style="font-style: italic; margin: 0px">Geen reviews gevonden...</p>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div id="MensenDieHierWonen">
                    <h3>Mensen die hier wonen:</h3>
                <?php
                    if ($placeType == 'WP'){
                        ?>

                            <?php

                            $result = $conn->query("SELECT * FROM users WHERE hometown = " . $placeCode);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <a href="profile.php?u=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                    <?
                                }
                            }  else {
                                ?>
                                <p>Geen gebruikers gevonden</p>
                                <?php
                            }
                            ?>
                        <?php
                    } else if ($placeType == "GM"){

                        ?>

                                <?php

                                $result = $conn->query("SELECT * FROM users");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $resultA = $conn->query("SELECT * FROM NederlandseWoonplaatsen WHERE id = " . $row['hometown']);
                                        if ($resultA->num_rows > 0) {
                                            while ($rowA = $resultA->fetch_assoc()) {
                                                if ($rowA['gemeenteId'] == $_GET['code']){
                                                    ?>
                                                    <a href="profile.php?u=<?php echo $row['id'] ?>"><p><?php echo $row['name'] ?></p></a>
                                                    <?
                                                }
                                            }
                                        }  else {
                                            ?>
                                            <p>Geen gebruikers gevonden</p>
                                            <?php
                                        }

                                    }
                                }  else {
                                    ?>
                                    <p>Geen gebruikers gevonden</p>
                                    <?php
                                }
                                ?>

                        <?php

                    }  else if ($placeType == "PV"){

                        ?>

                            <?php

                            $result = $conn->query("SELECT * FROM users");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $resultA = $conn->query("SELECT * FROM NederlandseWoonplaatsen WHERE id = " . $row['hometown']);
                                    if ($resultA->num_rows > 0) {
                                        while ($rowA = $resultA->fetch_assoc()) {
                                            $resultB = $conn->query("SELECT * FROM NederlandseGemeenten WHERE gemeenteCode = " . $rowA['gemeenteId']);
                                            if ($resultB->num_rows > 0) {
                                                while ($rowB = $resultB->fetch_assoc()) {
                                                    if ($rowB['provincieCode'] == $_GET['code']){
                                                        ?>
                                                        <a href="profile.php?u=<?php echo $row['id'] ?>"><p><?php echo $row['name'] ?></p></a>
                                                        <?
                                                    }
                                                }
                                            } else {
                                                ?>
                                                    <p>Geen gebruikers gevonden</p>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <p>Geen gebruikers gevonden</p>
                                        <?php
                                    }

                                }
                            }  else {
                                ?>
                                <p>Geen gebruikers gevonden</p>
                                <?php
                            }
                            ?>

                        <?php

                    }
                ?>
                </div>


        </div>
        <?php
            include "script/placeMap.php";
        ?>
        <script src="script/place.js"></script>
    </body>
</html>
