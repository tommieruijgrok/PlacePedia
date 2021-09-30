<?php
include 'include/config.php';

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

                            $sqlA = "SELECT * FROM NederlandseGemeentenGeo WHERE gemeenteCode = " . $row['gemeenteCode'];
                            $resultA = $conn->query($sqlA);

                            if ($resultA->num_rows > 0) {
                                // output data of each row
                                while ($rowA = $resultA->fetch_assoc()) {
                                    ?>
                                        <td><?php echo $rowA['geoJson'] ?></td>
                                    <?php
                                }
                            } else {
                                ?>
                                    <td>
                                        <form action="uploadGeo.php" method="post">
                                            <input type="hidden" value="<?php echo $row['gemeenteCode'] ?>" name="gemeenteCode">
                                            <input type="hidden" value="<?php echo $row['gemeenteNaam'] ?>" name="gemeenteNaam">
                                            <textarea name="input">

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
<script>
    alert("DOORWERKEN QUINTEN");
</script>
