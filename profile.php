<?php
session_start();
include 'include/config.php';
include 'include/head.php';
include 'include/header.php';

if(isset($_GET['u']) ){

    $result = $conn->query("SELECT * FROM users WHERE id = " . $_GET['u']);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userId = $row['id'];
            $userNaam = $row['name'];
            $userEmail = $row['email'];
            $userHometown= $row['hometown'];
            if (isset($_SESSION['status'])){
                $profileLogin = 'true';
            }
        }
    }

} else if (isset($_SESSION['userId'])) {
    $result = $conn->query("SELECT * FROM users WHERE id = " . $_SESSION['userId']);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userId = $row['id'];
            $userNaam = $row['name'];
            $userEmail = $row['email'];
            $profileLogin = 'true';
            $userHometown= $row['hometown'];
        }
    }
}
$result = $conn->query("SELECT * FROM NederlandseWoonplaatsen WHERE id = " . $userHometown);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $placeCode = $row['gemeenteId'];
            $placeType = 'GM';
            }
    }


?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="stylesheet/profile.css">
    </head>
    <body>

        <div id="container">

            <div>
                <div id="profileContainer">
                    <h2><?php echo $userNaam ?></h2>
                        <?php

                            $result = $conn->query("SELECT * FROM NederlandseWoonplaatsen WHERE id = " . $userHometown);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <a href="place.php?type=WP&code=<?php echo $userHometown ?>" style="color: unset; text-decoration: none">
                                    <?php
                                    echo $row['woonplaatsNaam'];

                                    $resultA = $conn->query("SELECT * FROM NederlandseGemeenten WHERE gemeenteCode = " . $row['gemeenteId']);
                                    if ($resultA->num_rows > 0) {
                                        while ($rowA = $resultA->fetch_assoc()) {

                                            echo ", " . $rowA['gemeenteNaam'];

                                            $resultB = $conn->query("SELECT * FROM NederlandseProvincies WHERE provincieCode = " . $rowA['provincieCode']);
                                            if ($resultB->num_rows > 0) {
                                                while ($rowB = $resultB->fetch_assoc()) {
                                                    echo ", " . $rowB['provincieNaam'];
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                        </a>
                                    <?php
                                }
                            }

                        ?>
                        <div class="infoContainer">

                            <p class="infoContainerNumber"><?php

                                $result = $conn->query("SELECT COUNT(*) AS 'count' FROM userReviews WHERE userId = " . $userId);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo $row['count'];
                                    }
                                }

                                ?></p>
                                <p>Reviews geplaatst</p>

                        </div>
                </div>
            </div>
            <div>
                <div id="map"></div>
                <div>
                    <h2>Geplaatste reviews</h2>

                        <?php

                        $result = $conn->query("SELECT * FROM userReviews WHERE userId = " . $userId);
                        if ($result->num_rows > 0) {
                            ?>
                                <div id="reviewGrid">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                    <div class="reviewPost">
                                        <?php

                                            if ($row['locationType'] == 'GM'){
                                                $resultA = $conn->query("SELECT * FROM NederlandseGemeenten WHERE gemeenteCode = " . $row['location']);
                                                if ($resultA->num_rows > 0) {
                                                    while ($rowA = $resultA->fetch_assoc()) {
                                                        echo "<a href='place.php?type=GM&code=" . $rowA['gemeenteCode'] . "'><h4 >Gemeente " . $rowA['gemeenteNaam'] . "</h4></a>";
                                                    }
                                                }
                                            } else if ($row['locationType'] == 'PV'){
                                                $resultA = $conn->query("SELECT * FROM NederlandseProvincies WHERE provincieCode = " . $row['location']);
                                                if ($resultA->num_rows > 0) {
                                                    while ($rowA = $resultA->fetch_assoc()) {
                                                        echo "<a href='place.php?type=PV&code=" . $rowA['provincieCode'] . "'><h4>Provincie " . $rowA['provincieNaam'] . "</h4></a>";
                                                    }
                                                }
                                            }  else if ($row['locationType'] == 'WP'){
                                                $resultA = $conn->query("SELECT * FROM NederlandseWoonplaatsen WHERE id = " . $row['location']);
                                                if ($resultA->num_rows > 0) {
                                                    while ($rowA = $resultA->fetch_assoc()) {
                                                        echo "<a href='place.php?type=WP&code=" . $rowA['id'] . "'><h4>" . $rowA['woonplaatsNaam'] . "</h4></a>";
                                                    }
                                                }
                                            }

                                            ?>
                                        <p><?php echo $row['content'] ?></p>
                                    </div>
                                <?php
                            }
                            ?>
                                </div>
                                        <?php
                        } else {
                            ?>
                                <p>Geen reviews gevonden!</p>
                            <?php
                        }

                        ?>
                    </div>
                </div>
            </div>

        </div>

    </body>
        <?php
            include "script/placeMap.php";
        ?>

</html>
