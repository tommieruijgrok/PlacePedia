<?php
session_start();

include 'include/config.php';
include 'include/head.php';
include 'include/header.php';

$cityID = $_GET['id'];
$sql = "SELECT * FROM NederlandseGemeenten WHERE id = " . $_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $gemeenteCode = $row['gemeenteCode'];
        $gemeenteNaam = $row['gemeenteNaam'];
        $provincieCode = $row['provincieCode'];
    }
}
?>

<html>
    <head>
        <title>Gemeente <?php echo $gemeenteNaam ?> | PlacePedia</title>
        <link rel="stylesheet" href="stylesheet/place.css">
    </head>
    <body>
        <div id="map"></div>
        <div id="container">
            <div id="headerParent">
                <h1>Gemeente
                    <?php
                    echo $gemeenteNaam;
                    ?>
                </h1>
                <div id="starRating">
                    <?php
                    $sql = "SELECT AVG(rating) 'gemiddelde' FROM userRatings WHERE location = " . $gemeenteCode . " AND locationType = 'GM'";
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

                <div id="reviewsGrid">
                    <?php
                    $sql = "SELECT * FROM userReviews WHERE locationType = 'GM' AND location = " . $gemeenteCode;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="review">
                                <div class="flex flexAlign flexSpaceBetween">
                                    <div style="width: 100%">
                                        <div class="flex flexAlign flexSpaceBetween" style="width: 100%">
                                            <p>
                                                <b>
                                                    <?php

                                                    $sqlA = "SELECT * FROM users WHERE id = " . $row['userId'];
                                                    $resultA = $conn->query($sqlA);

                                                    if ($resultA->num_rows > 0) {
                                                        // output data of each row
                                                        while ($rowA = $resultA->fetch_assoc()) {
                                                            echo $rowA['name'];
                                                        }
                                                    }

                                                    ?>
                                                </b>
                                            </p>
                                            <?php

                                            if ($row['userId'] == $_SESSION['userId']){
                                                ?>

                                                    <div class="flex flexSpaceBetween flexAlign" style="gap: 7px">
                                                        <form method="POST" action="process/deleteReview.php" style="margin: 0px">
                                                            <input type="hidden" value="<?php echo $row['id']  ?>" name="reviewId">
                                                            <input type="hidden" value="<?php echo $row['locationType']  ?>" name="locationType">
                                                            <input type="hidden" value="<?php echo $cityID  ?>" name="location">
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
                                                <input type="hidden" value="<?php echo $cityID  ?>" name="location">
                                                <input type="hidden" value="<?php echo $row['id'] ?>" name="reviewId">
                                                <textarea name="textarea"><?php echo $row['content'] ?></textarea>
                                                <div class="saveButtonEditReview" onclick="this.parentElement.submit()">
                                                    <p>Wijziging opslaan</p>
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
        <?php
            include "script/placeMap.php";
        ?>
        <script src="script/place.js"></script>
    </body>
</html>
