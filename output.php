<?php
include 'include/config.php';

$json = json_decode(file_get_contents('https://placepedia.tommieruijgrok.nl/json/GemeentenNL.geojson'));

//echo json_encode(get_object_vars(get_object_vars(get_object_vars($json)[features][0])[geometry])[coordinates]);

?>
<table>

    <?php


    $sql = "SELECT * FROM NederlandseGemeenten";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['gemeenteCode'] ?></td>
                        <td><?php echo $row['gemeenteNaam'] ?></td>
                        <?php

                            $sqlA = "SELECT * FROM GeoInfo WHERE code = " . $row['gemeenteCode'] . " AND type = 'GM'";
                            $resultA = $conn->query($sqlA);

                            if ($resultA->num_rows > 0) {
                                // output data of each row
                                while ($rowA = $resultA->fetch_assoc()) {
                                    ?>
                                        <td><?php echo "CHECK" ?></td>
                                    <?php
                                }
                            } else {
                                ?>
                                    <td>
                                        <form action="uploadGeo.php" method="post" target="_blank">
                                            <input type="hidden" value="<?php echo $row['gemeenteCode'] ?>" name="gemeenteCode">
                                            <input type="hidden" value="<?php echo $row['gemeenteNaam'] ?>" name="gemeenteNaam">
                                            <textarea name="input">
                                                <?php

                                                    for ($i=0; $i < 394; $i++){

                                                        if (get_object_vars(get_object_vars(get_object_vars($json)[features][$i])[properties])[name] == $row['gemeenteNaam']){
                                                            echo json_encode(get_object_vars(get_object_vars(get_object_vars($json)[features][$i])[geometry])[coordinates]);
                                                        }

                                                    }

                                                ?>
                                            </textarea>
                                            <input type="submit">
                                        </form>
                                    </td>
                                    <?php
                            }
                        ?>
                    </tr>
                <?php
            }
        }

    ?>

</table>
<style type="text/css">


</style>

